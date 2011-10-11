<?php
/*
** Zabbix
** Copyright (C) 2000-2011 Zabbix SIA
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
**/
?>
<?php
	require_once('include/config.inc.php');
	require_once('include/acknow.inc.php');
	require_once('include/actions.inc.php');
	require_once('include/events.inc.php');
	require_once('include/triggers.inc.php');
	require_once('include/users.inc.php');
	require_once('include/html.inc.php');

	$page['title']		= 'S_EVENT_DETAILS';
	$page['file']		= 'tr_events.php';
	$page['hist_arg'] = array('triggerid', 'eventid');
	$page['scripts'] = array();

	$page['type'] = detect_page_type(PAGE_TYPE_HTML);

	include_once 'include/page_header.php';
?>
<?php
	define('PAGE_SIZE',	100);

//		VAR			TYPE	OPTIONAL FLAGS	VALIDATION	EXCEPTION
	$fields=array(
		'triggerid'=>		array(T_ZBX_INT, O_OPT, P_SYS,	DB_ID,		PAGE_TYPE_HTML.'=='.$page['type']),
		'eventid'=>			array(T_ZBX_INT, O_OPT, P_SYS,	DB_ID,		PAGE_TYPE_HTML.'=='.$page['type']),
		'fullscreen'=>		array(T_ZBX_INT, O_OPT,	P_SYS,	IN('0,1'),		NULL),
/* actions */
		"save"=>		array(T_ZBX_STR,O_OPT,	P_ACT|P_SYS, null,	null),
		"cancel"=>		array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	null),
// ajax
		'favobj'=>		array(T_ZBX_STR, O_OPT, P_ACT,	IN("'filter','hat'"),		NULL),
		'favref'=>		array(T_ZBX_STR, O_OPT, P_ACT,  NOT_EMPTY,	'isset({favobj})'),
		'state'=>		array(T_ZBX_INT, O_OPT, P_ACT,	NOT_EMPTY,	'isset({favobj})')
	);

	check_fields($fields);

/* AJAX */
	if(isset($_REQUEST['favobj'])){
		if('hat' == $_REQUEST['favobj']){
			CProfile::update('web.tr_events.hats.'.$_REQUEST['favref'].'.state',$_REQUEST['state'], PROFILE_TYPE_INT);
		}
	}

	if((PAGE_TYPE_JS == $page['type']) || (PAGE_TYPE_HTML_BLOCK == $page['type'])){
		include_once('include/page_footer.php');
		exit();
	}
//--------
	$options = array(
		'triggerids' => $_REQUEST['triggerid'],
		'expandData' => 1,
		'expandDescription' => 1,
// Required for getting visible host name
		'selectHosts' => API_OUTPUT_EXTEND,
		'output' => API_OUTPUT_EXTEND
	);
	$triggers = API::Trigger()->get($options);
	if(empty($triggers)) access_deny();

	$trigger = reset($triggers);

	$options = array(
		'eventids' => $_REQUEST['eventid'],
		'triggerids' => $_REQUEST['triggerid'],
		'select_alerts' => API_OUTPUT_EXTEND,
		'select_acknowledges' => API_OUTPUT_EXTEND,
		'output' => API_OUTPUT_EXTEND,
		'selectHosts' => API_OUTPUT_EXTEND
	);
	$events = API::Event()->get($options);
	$event = reset($events);

	$tr_event_wdgt = new CWidget();
	$tr_event_wdgt->setClass('header');

// Main widget header
	$text = array(S_EVENTS_BIG.': "'.$trigger['description'].'"');

	$fs_icon = get_icon('fullscreen', array('fullscreen' => $_REQUEST['fullscreen']));
	$tr_event_wdgt->addHeader($text, $fs_icon);
//-------

	$left_col = array();

// tr details
	$triggerDetails = new CUIWidget('hat_triggerdetails', make_trigger_details($trigger));
	$triggerDetails->setHeader(S_EVENT.SPACE.S_SOURCE.SPACE.S_DETAILS);
	$left_col[] = $triggerDetails;
//----------------

// event details
	$eventDetails = new CUIWidget('hat_eventdetails', make_event_details($event, $trigger));
	$eventDetails->setHeader(S_EVENT_DETAILS);
	$left_col[] = $eventDetails;
//----------------

	$right_col = array();

// if acknowledges are not disabled in configuration, let's show them
	if ($config['event_ack_enable']) {
		$event_ack = new CUIWidget(
			'hat_eventack',
			make_acktab_by_eventid($event),
			CProfile::get('web.tr_events.hats.hat_eventack.state', 1)
		);
		$event_ack->setHeader(S_ACKNOWLEDGES);
		$right_col[] = $event_ack;
	}

//----------------

// event sms actions
	$actions_sms = new CUIWidget(
		'hat_eventactionmsgs',
		get_action_msgs_for_event($event),
		CProfile::get('web.tr_events.hats.hat_eventactionmsgs.state',1)
	);
	$actions_sms->setHeader(S_MESSAGE_ACTIONS);
	$right_col[] = $actions_sms;
//----------------

// event cmd actions
	$actions_cmd = new CUIWidget(
		'hat_eventactionmcmds',
		get_action_cmds_for_event($event),//null,
		CProfile::get('web.tr_events.hats.hat_eventactioncmds.state',1)
	);
	$actions_cmd->setHeader(S_COMMAND_ACTIONS);
	$right_col[] = $actions_cmd;
//----------------

// event history

	$events_histry = new CUIWidget(
		'hat_eventlist',
		make_small_eventlist($event),
		CProfile::get('web.tr_events.hats.hat_eventlist.state',1)
	);
	$events_histry->setHeader(S_EVENTS.SPACE.S_LIST.SPACE.'['.S_PREVIOUS_EVENTS.' 20]');
	$right_col[] = $events_histry;

//----------------

	$leftDiv = new CDiv($left_col, 'column');
	$middleDiv = new CDiv($right_col, 'column');

	$ieTab = new CTable();
	$ieTab->addRow(array($leftDiv,$middleDiv), 'top');

	$tr_event_wdgt->addItem($ieTab);
	$tr_event_wdgt->show();

?>
<?php

include_once('include/page_footer.php');

?>
