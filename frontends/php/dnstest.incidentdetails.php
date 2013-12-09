<?php
/*
** Zabbix
** Copyright (C) 2001-2013 Zabbix SIA
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
**/


require_once dirname(__FILE__).'/include/config.inc.php';
require_once dirname(__FILE__).'/include/incidentdetails.inc.php';

$page['title'] = _('Incidents details');
$page['file'] = 'dnstest.incidentdetails.php';
$page['hist_arg'] = array('groupid', 'hostid');
$page['scripts'] = array('class.calendar.js');

require_once dirname(__FILE__).'/include/page_header.php';

//		VAR			TYPE	OPTIONAL FLAGS	VALIDATION	EXCEPTION
$fields = array(
	'host' =>					array(T_ZBX_STR, O_MAND,	P_SYS,	null,		null),
	'eventid' =>				array(T_ZBX_INT, O_MAND,	P_SYS,	null,		null),
	'slvItemId' =>				array(T_ZBX_INT, O_MAND,	P_SYS,	DB_ID,		null),
	'availItemId' =>			array(T_ZBX_INT, O_MAND,	P_SYS,	DB_ID,		null),
	'original_from' =>			array(T_ZBX_INT, O_OPT,		null,	null,		null),
	'original_to' =>			array(T_ZBX_INT, O_OPT,		null,	null,		null),
	// filter
	'filter_set' =>				array(T_ZBX_STR, O_OPT,		P_ACT,	null,		null),
	'filter_from' =>			array(T_ZBX_INT, O_OPT,		null,	null,		null),
	'filter_to' =>				array(T_ZBX_INT, O_OPT,		null,	null,		null),
	'filter_rolling_week' =>	array(T_ZBX_INT, O_OPT,		null,	null,		null),
	'filter_failing_tests' =>	array(T_ZBX_INT, O_OPT,		null,	IN('0,1'),	null),
	// ajax
	'favobj'=>					array(T_ZBX_STR, O_OPT,	P_ACT,	NULL,		NULL),
	'favref'=>					array(T_ZBX_STR, O_OPT,	P_ACT,  NOT_EMPTY,	'isset({favobj})'),
	'favstate'=>				array(T_ZBX_INT, O_OPT,	P_ACT,  NOT_EMPTY,	'isset({favobj})&&("filter"=={favobj})')
);
check_fields($fields);

validate_sort_and_sortorder('name', ZBX_SORT_UP);

if (isset($_REQUEST['favobj'])) {
	if('filter' == $_REQUEST['favobj']){
		CProfile::update('web.dnstest.incidents.filter.state', get_request('favstate'), PROFILE_TYPE_INT);
	}
}

if ((PAGE_TYPE_JS == $page['type']) || (PAGE_TYPE_HTML_BLOCK == $page['type'])) {
	require_once dirname(__FILE__).'/include/page_footer.php';
	exit();
}

$data = array();
$data['tests'] = array();
$data['host'] = get_request('host');
$data['eventid'] = get_request('eventid');
$data['slvItemId'] = get_request('slvItemId');
$data['availItemId'] = get_request('availItemId');

// check
if (!$data['eventid'] || !$data['slvItemId'] || !$data['availItemId'] || !$data['host']) {
	access_deny();
}
/*
 * Filter
 */
if (get_request('filter_rolling_week')) {
	$data['filter_from'] = date('YmdHis', time() - SEC_PER_WEEK);
	$data['filter_to'] = date('YmdHis', time());
}
else {
	if (get_request('filter_from') == get_request('original_from')) {
		$data['filter_from'] = date('YmdHis', get_request('filter_from', time() - SEC_PER_WEEK));
	}
	else {
		$data['filter_from'] = get_request('filter_from', date('YmdHis', time() - SEC_PER_WEEK));
	}
	if (get_request('filter_to') == get_request('original_to')) {
		$data['filter_to'] = date('YmdHis', get_request('filter_to', time()));
	}
	else {
		$data['filter_to'] = get_request('filter_to', date('YmdHis', time()));
	}
}

$data['filter_failing_tests'] = get_request('filter_failing_tests');

$data['sid'] = get_request('sid');

// get TLD
$tld = API::Host()->get(array(
	'tlds' => true,
	'output' => array('hostid', 'host', 'name'),
	'filter' => array(
		'host' => $data['host']
	)
));

// get slv item
$slvItems = API::Item()->get(array(
	'itemids' => $data['slvItemId'],
	'output' => array('name', 'key_', 'lastvalue')
));

$slvItem = $slvItems ? reset($slvItems) : null;

// get start event
$mainEvent = API::Event()->get(array(
	'eventids' => $data['eventid'],
	'selectTriggers' => API_OUTPUT_REFER,
	'output' => API_OUTPUT_EXTEND
));

if ($mainEvent) {
	$mainEvent = reset($mainEvent);
	$eventTrigger = reset($mainEvent['triggers']);

	$mainEventFromTime = $mainEvent['clock'];

	// get host with calculated items
	$dnstest = API::Host()->get(array(
		'output' => array('hostid'),
		'filter' => array(
			'host' => DNSTEST_HOST
		)
	));

	if ($dnstest) {
		$dnstest = reset($dnstest);
	}
	else {
		show_error_message(_s('No permissions to referred host "%1$s" or it does not exist!', DNSTEST_HOST));
		require_once dirname(__FILE__).'/include/page_footer.php';
		exit;
	}

	switch ($slvItem['key_']) {
		case DNSTEST_SLV_DNS_ROLLWEEK:
			$keys = array(CALCULATED_ITEM_DNS_FAIL, CALCULATED_ITEM_DNS_RECOVERY, CALCULATED_ITEM_DNS_DELAY);
			$data['type'] = 0;
			break;
		case DNSTEST_SLV_DNSSEC_ROLLWEEK:
			$keys = array(CALCULATED_ITEM_DNSSEC_FAIL, CALCULATED_ITEM_DNSSEC_RECOVERY, CALCULATED_ITEM_DNSSEC_DELAY);
			$data['type'] = 1;
			break;
		case DNSTEST_SLV_RDDS_ROLLWEEK:
			$keys = array(CALCULATED_ITEM_RDDS_FAIL, CALCULATED_ITEM_RDDS_RECOVERY, CALCULATED_ITEM_RDDS_DELAY);
			$data['type'] = 2;
			break;
	}

	$items = API::Item()->get(array(
		'hostids' => $dnstest['hostid'],
		'output' => array('itemid', 'key_'),
		'filter' => array(
			'key_' => $keys
		)
	));

	if (count($items) != 3) {
		show_error_message(_s('Missed items for host "%1$s"!', DNSTEST_HOST));
		require_once dirname(__FILE__).'/include/page_footer.php';
		exit;
	}

	foreach ($items as $item) {
		if ($item['key_'] == CALCULATED_ITEM_DNS_FAIL || $item['key_'] == CALCULATED_ITEM_DNSSEC_FAIL
				|| $item['key_'] == CALCULATED_ITEM_RDDS_FAIL) {
			$failCount = getOldValue($item['itemid'], $mainEventFromTime);

		}
		elseif ($item['key_'] == CALCULATED_ITEM_DNS_RECOVERY || $item['key_'] == CALCULATED_ITEM_DNSSEC_RECOVERY
				|| $item['key_'] == CALCULATED_ITEM_RDDS_RECOVERY) {
			$recoveryCount = getOldValue($item['itemid'], $mainEventFromTime);
		}
		else {
			$delayTime = getOldValue($item['itemid'], $mainEventFromTime);
		}
	}

	$mainEventFromTime -= $failCount * $delayTime;

	if (get_request('filter_set')) {
		$fromTime = ($mainEventFromTime >= zbxDateToTime($data['filter_from']))
			? $mainEventFromTime
			: zbxDateToTime($data['filter_from']);
	}
	else {
		$fromTime = $mainEventFromTime;
	}

	// get end event
	$endEvent = API::Event()->get(array(
		'triggerids' => $eventTrigger['triggerid'],
		'output' => API_OUTPUT_EXTEND,
		'time_from' => $mainEvent['clock'],
		'time_till' => get_request('filter_set') ? zbxDateToTime($data['filter_to']) : null,
		'filter' => array(
			'value' => TRIGGER_VALUE_FALSE,
			'value_changed' => TRIGGER_VALUE_CHANGED_YES
		),
		'limit' => 1,
		'sortorder' => ZBX_SORT_UP
	));

	if ($endEvent) {
		$endEvent = reset($endEvent);

		$endEventToTime = $endEvent['clock'] + ($recoveryCount * $delayTime);
		if (get_request('filter_set')) {
			$toTime = ($endEventToTime >= zbxDateToTime($data['filter_to']))
				? zbxDateToTime($data['filter_to'])
				: $endEventToTime;
		}
		else {
			$toTime = $endEventToTime;
		}
	}
	else {
		$toTime = get_request('filter_set') ? zbxDateToTime($data['filter_to']) : time();
	}
}

if ($tld && $mainEvent && $slvItem) {
	$data['tld'] = reset($tld);
	$data['slvItem'] = $slvItem;
	$data['slv'] = $data['slvItem']['lastvalue'];
	if ($mainEvent['false_positive']) {
		$data['incidentType'] = INCIDENT_FALSE_POSITIVE;
	}
	else {
		$data['incidentType'] = $endEvent ? INCIDENT_RESOLVED : INCIDENT_ACTIVE;
	}
	$data['active'] = $endEvent ? true : false;

	$failingTests = $data['filter_failing_tests'] ? ' AND h.value=0' : null;

	$tests = DBselect(
		'SELECT h.value, h.clock'.
		' FROM history_uint h'.
		' WHERE h.itemid='.zbx_dbstr($data['availItemId']).
			' AND h.clock>='.$fromTime.
			' AND h.clock<='.$toTime.
			$failingTests
	);

	$mainEventClock = mktime(
		date('H', $mainEvent['clock']),
		date('i', $mainEvent['clock']),
		0,
		date('n', $mainEvent['clock']),
		date('j', $mainEvent['clock']),
		date('Y', $mainEvent['clock'])
	);

	if ($endEvent) {
		$endEventClock = mktime(
			date('H', $endEvent['clock']),
			date('i', $endEvent['clock']),
			0,
			date('n', $endEvent['clock']),
			date('j', $endEvent['clock']),
			date('Y', $endEvent['clock'])
		);
	}


	while ($test = DBfetch($tests)) {
		$data['tests'][] = array(
			'clock' => $test['clock'],
			'value' => $test['value']
		);
	}
	$slvs = DBselect(
		'SELECT h.value,h.clock'.
		' FROM history_uint h'.
		' WHERE h.itemid='.zbx_dbstr($data['slvItemId']).
			' AND h.clock>='.$fromTime.
			' AND h.clock<='.$toTime
	);

	$tempTests = $data['tests'];

	$startEventExist = false;
	$endEventExist = false;
	while ($slv = DBfetch($slvs)) {
		foreach ($tempTests as $key => $test) {
			$newClock = mktime(
				date('H', $test['clock']),
				date('i', $test['clock']),
				0,
				date('n', $test['clock']),
				date('j', $test['clock']),
				date('Y', $test['clock'])
			);

			if ($slv['clock'] == $test['clock']) {
				if (!$startEventExist && $mainEventClock == $newClock) {
					$startEventTest = true;
					$startEventExist = true;
				}
				else {
					$startEventTest = false;
				}

				if ($endEvent && !$endEventExist && $endEventClock == $newClock) {
					$endEventTest = true;
					$endEventExist = true;
				}
				else {
					$endEventTest = false;
				}

				$data['tests'][$key]['slv'] = $slv['value'];
				$data['tests'][$key]['startEvent'] = $startEventTest;
				$data['tests'][$key]['endEvent'] = $endEventTest;
				unset($tempTests[$key]);
				continue;
			}
			elseif (isset($old['clock']) && $test['clock'] < $slv['clock']) {
				$newClock = mktime(
					date('H', $old['clock']),
					date('i', $old['clock']),
					0,
					date('n', $old['clock']),
					date('j', $old['clock']),
					date('Y', $old['clock'])
				);

				if (!$startEventExist && $mainEventClock == $newClock) {
					$startEventTest = true;
					$startEventExist = true;
				}
				else {
					$startEventTest = false;
				}

				if ($endEvent && !$endEventExist && $endEventClock == $newClock) {
					$endEventTest = true;
					$endEventExist = true;
				}
				else {
					$endEventTest = false;
				}

				$data['tests'][$key]['slv'] = $old['value'];
				$data['tests'][$key]['startEvent'] = $startEventTest;
				$data['tests'][$key]['endEvent'] = $endEventTest;
				unset($tempTests[$key]);
				continue;
			}

			$old = array(
				'clock' => $slv['clock'],
				'value' => $slv['value']
			);
		}
	}
}
else {
	access_deny();
}

$dnsTestView = new CView('dnstest.incidentdetails.list', $data);

$dnsTestView->render();
$dnsTestView->show();

require_once dirname(__FILE__).'/include/page_footer.php';
