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
require_once('include/images.inc.php');
require_once('include/regexp.inc.php');
require_once('include/forms.inc.php');


$page['title'] = 'S_CONFIGURATION_OF_ZABBIX';
$page['file'] = 'config.php';
$page['hist_arg'] = array('config');

include_once('include/page_header.php');
?>
<?php
	$fields=array(
		// VAR					        TYPE	OPTIONAL FLAGS	VALIDATION	EXCEPTION
		'config'=>				array(T_ZBX_INT, O_OPT,	null,	IN('0,3,5,6,7,8,9,10,11,12,13'),	null),
		// other form
		'alert_history'=>		array(T_ZBX_INT, O_NO,	null,	BETWEEN(0,65535),	'isset({config})&&({config}==0)&&isset({save})'),
		'event_history'=>		array(T_ZBX_INT, O_NO,	null,	BETWEEN(0,65535),	'isset({config})&&({config}==0)&&isset({save})'),
		'work_period'=>			array(T_ZBX_STR, O_NO,	null,	null,			'isset({config})&&({config}==7)&&isset({save})'),
		'refresh_unsupported'=>	array(T_ZBX_INT, O_NO,	null,	BETWEEN(0,65535),	'isset({config})&&({config}==5)&&isset({save})'),
		'alert_usrgrpid'=>		array(T_ZBX_INT, O_NO,	null,	DB_ID,			'isset({config})&&({config}==5)&&isset({save})'),
		'discovery_groupid'=>	array(T_ZBX_INT, O_NO,	null,	DB_ID,			'isset({config})&&({config}==5)&&isset({save})'),

		// image form
		'imageid'=>				array(T_ZBX_INT, O_NO,	P_SYS,	DB_ID,			'isset({config})&&({config}==3)&&(isset({form})&&({form}=="update"))'),
		'name'=>				array(T_ZBX_STR, O_NO,	null,	NOT_EMPTY,		'isset({config})&&({config}==3)&&isset({save})'),
		'imagetype'=>			array(T_ZBX_INT, O_OPT,	null,	IN('1,2'),		'isset({config})&&({config}==3)&&(isset({save}))'),

		// value mapping
		'valuemapid'=>			array(T_ZBX_INT, O_NO,	P_SYS,	DB_ID,			'isset({config})&&({config}==6)&&(isset({form})&&({form}=="update"))'),
		'mapname'=>				array(T_ZBX_STR, O_OPT,	null,	NOT_EMPTY, 		'isset({config})&&({config}==6)&&isset({save})'),
		'valuemap'=>			array(T_ZBX_STR, O_OPT,	null,	null,	null),
		'rem_value'=>			array(T_ZBX_INT, O_OPT,	null,	BETWEEN(0,65535), null),
		'add_value'=>			array(T_ZBX_STR, O_OPT,	null,	NOT_EMPTY, 'isset({add_map})'),
		'add_newvalue'=>		array(T_ZBX_STR, O_OPT,	null,	NOT_EMPTY, 'isset({add_map})'),

		// actions
		'add_map'=>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	null),
		'del_map'=>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	null),
		'save'=>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	null),
		'delete'=>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	null),
		'cancel'=>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	null),

		// GUI
		'event_ack_enable'=>		array(T_ZBX_INT, O_OPT, P_SYS|P_ACT,	IN('1'),	null),
		'event_expire'=> 			array(T_ZBX_INT, O_OPT, P_SYS|P_ACT,	BETWEEN(1,99999),	'isset({config})&&({config}==8)&&isset({save})'),
		'event_show_max'=> 			array(T_ZBX_INT, O_OPT, P_SYS|P_ACT,	BETWEEN(1,99999),	'isset({config})&&({config}==8)&&isset({save})'),
		'dropdown_first_entry'=>	array(T_ZBX_INT, O_OPT, P_SYS|P_ACT,	IN('0,1,2'),		'isset({config})&&({config}==8)&&isset({save})'),
		'dropdown_first_remember'=>	array(T_ZBX_INT, O_OPT, P_SYS|P_ACT,	IN('1'),	null),
		'max_in_table' => 			array(T_ZBX_INT, O_OPT, P_SYS|P_ACT,	BETWEEN(1,99999),	'isset({config})&&({config}==8)&&isset({save})'),
		'search_limit' => 			array(T_ZBX_INT, O_OPT, P_SYS|P_ACT,	BETWEEN(1,999999),	'isset({config})&&({config}==8)&&isset({save})'),

		// Macros
		'macros_rem'=>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	null),
		'macros'=>				array(T_ZBX_STR, O_OPT, P_SYS,			null,	null),
		'macro_new'=>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	'isset({macro_add})'),
		'value_new'=>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	'isset({macro_add})'),
		'macro_add' =>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	null),
		'macros_del' =>			array(T_ZBX_STR, O_OPT, P_SYS|P_ACT,	null,	null),

		// Themes
		'default_theme'=>		array(T_ZBX_STR, O_OPT,	null,	NOT_EMPTY,			'isset({config})&&({config}==9)&&isset({save})'),

		// regexp
		'regexpids'=>			array(T_ZBX_INT, O_OPT,	P_SYS,	DB_ID,		null),
		'regexpid'=>			array(T_ZBX_INT, O_OPT,	P_SYS,	DB_ID,			'isset({config})&&({config}==10)&&(isset({form})&&({form}=="update"))'),
		'rename'=>				array(T_ZBX_STR, O_OPT,	null,	NOT_EMPTY,		'isset({config})&&({config}==10)&&isset({save})', S_NAME),
		'test_string'=>			array(T_ZBX_STR, O_OPT,	null,	NOT_EMPTY,		'isset({config})&&({config}==10)&&isset({save})', S_TEST_STRING),
		'delete_regexp'=>		array(T_ZBX_STR, O_OPT,	null,	null,		null),

		'g_expressionid'=>			array(T_ZBX_INT, O_OPT,	null,	DB_ID,		null),
		'expressions'=>				array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==10)&&isset({save})'),
		'new_expression'=>			array(T_ZBX_STR, O_OPT,	null,	null,		null),
		'cancel_new_expression'=>	array(T_ZBX_STR, O_OPT,	null,	null,		null),

		'clone'=>					array(T_ZBX_STR, O_OPT,	null,	null,		null),
		'add_expression'=>			array(T_ZBX_STR, O_OPT,	null,	null,		null),
		'edit_expressionid'=>		array(T_ZBX_STR, O_OPT,	null,	null,		null),
		'delete_expression'=>		array(T_ZBX_STR, O_OPT,	null,	null,		null),

		// Trigger severities
		'severity_name_0' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_color_0' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_name_1' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_color_1' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_name_2' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_color_2' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_name_3' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_color_3' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_name_4' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_color_4' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_name_5' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),
		'severity_color_5' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==12)&&isset({save})'),

		// Trigger displaying options
		'problem_unack_color' =>	array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==13)&&isset({save})'),
		'problem_ack_color' =>		array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==13)&&isset({save})'),
		'ok_unack_color' =>		    array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==13)&&isset({save})'),
		'ok_ack_color' =>		    array(T_ZBX_STR, O_OPT,	null,	null,		'isset({config})&&({config}==13)&&isset({save})'),
		'problem_unack_style' =>	array(T_ZBX_INT, O_OPT,	null,	IN('1'),	 null),
		'problem_ack_style' =>		array(T_ZBX_INT, O_OPT,	null,	IN('1'),	 null),
		'ok_unack_style' =>		    array(T_ZBX_INT, O_OPT,	null,	IN('1'),	 null),
		'ok_ack_style' =>		    array(T_ZBX_INT, O_OPT,	null,	IN('1'),	 null),
		'ok_period' =>		        array(T_ZBX_INT, O_OPT,	null,	null,		'isset({config})&&({config}==13)&&isset({save})'),
		'blink_period' =>		    array(T_ZBX_INT, O_OPT,	null,	null,		'isset({config})&&({config}==13)&&isset({save})'),

		'form' =>			        array(T_ZBX_STR, O_OPT, P_SYS,	null,	null),
		'form_refresh' =>	        array(T_ZBX_INT, O_OPT,	null,	null,	null)
	);
?>
<?php
	$_REQUEST['config'] = get_request('config', CProfile::get('web.config.config', 0));

	check_fields($fields);

	CProfile::update('web.config.config' ,$_REQUEST['config'], PROFILE_TYPE_INT);

	$orig_config = select_config(false, get_current_nodeid(false));

	$result = 0;
	if($_REQUEST['config']==3){
// IMAGES ACTIONS
		if(isset($_REQUEST['save'])){

			$file = isset($_FILES['image']) && $_FILES['image']['name'] != '' ? $_FILES['image'] : null;
			if(!is_null($file)){
				if($file['error'] != 0 || $file['size']==0){
					error(S_INCORRECT_IMAGE);
					return false;
				}

				if($file['size'] < ZBX_MAX_IMAGE_SIZE){
					$image = fread(fopen($file['tmp_name'],'r'),filesize($file['tmp_name']));
				}
				else{
					error(S_IMAGE_SIZE_MUST_BE_LESS_THAN_MB);
					return false;
				}

				$image = base64_encode($image);
			}

			if(isset($_REQUEST['imageid'])){
				$val = array(
					'imageid' => $_REQUEST['imageid'],
					'name' => $_REQUEST['name'],
					'imagetype' => $_REQUEST['imagetype'],
					'image' => is_null($file) ? null : $image
				);
				$result = API::Image()->update($val);

				$msg_ok = S_IMAGE_UPDATED;
				$msg_fail = S_CANNOT_UPDATE_IMAGE;
				$audit_action = 'Image ['.$_REQUEST['name'].'] updated';
			}
			else{
				if(is_null($file)){
					error(S_SELECT_IMAGE_TO_DOWNLOAD);
					return false;
				}

				if(!count(get_accessible_nodes_by_user($USER_DETAILS,PERM_READ_WRITE,PERM_RES_IDS_ARRAY))){
					access_deny();
				}

				$val = array(
					'name' => $_REQUEST['name'],
					'imagetype' => $_REQUEST['imagetype'],
					'image' => $image
				);
				$result = API::Image()->create($val);

				$msg_ok = S_IMAGE_ADDED;
				$msg_fail = S_CANNOT_ADD_IMAGE;
				$audit_action = 'Image ['.$_REQUEST['name'].'] added';
			}

			show_messages($result, $msg_ok, $msg_fail);
			if($result){
				add_audit(AUDIT_ACTION_UPDATE,AUDIT_RESOURCE_IMAGE,$audit_action);
				unset($_REQUEST['form']);
			}
		}
		else if(isset($_REQUEST['delete'])&&isset($_REQUEST['imageid'])) {
			$image = get_image_by_imageid($_REQUEST['imageid']);

			$result = API::Image()->delete($_REQUEST['imageid']);

			show_messages($result, S_IMAGE_DELETED, S_CANNOT_DELETE_IMAGE);
			if($result){
				add_audit(AUDIT_ACTION_UPDATE,AUDIT_RESOURCE_IMAGE,'Image ['.$image['name'].'] deleted');
				unset($_REQUEST['form']);
				unset($image, $_REQUEST['imageid']);
			}
		}
	}
	else if(isset($_REQUEST['save']) && ($_REQUEST['config'] == 8)){ // GUI
		if(!count(get_accessible_nodes_by_user($USER_DETAILS,PERM_READ_WRITE,PERM_RES_IDS_ARRAY)))
			access_deny();

		$configs = array(
			'default_theme' => get_request('default_theme'),
			'event_ack_enable' => (is_null(get_request('event_ack_enable')) ? 0 : 1),
			'event_expire' => get_request('event_expire'),
			'event_show_max' => get_request('event_show_max'),
			'dropdown_first_entry' => get_request('dropdown_first_entry'),
			'dropdown_first_remember' => (is_null(get_request('dropdown_first_remember')) ? 0 : 1),
			'max_in_table' => get_request('max_in_table'),
			'search_limit' => get_request('search_limit'),
		);

		$result = update_config($configs);

		show_messages($result, S_CONFIGURATION_UPDATED, S_CONFIGURATION_WAS_NOT_UPDATED);

		if($result){
			$msg = array();
			if(!is_null($val = get_request('default_theme')))
				$msg[] = S_DEFAULT_THEME.' ['.$val.']';
			if(!is_null($val = get_request('event_ack_enable')))
				$msg[] = S_EVENT_ACKNOWLEDGES.' ['.($val?(S_DISABLED):(S_ENABLED)).']';
			if(!is_null($val = get_request('event_expire')))
				$msg[] = _('Show events not older than (in days)').' ['.$val.']';
			if(!is_null($val = get_request('event_show_max')))
				$msg[] = S_SHOW_EVENTS_MAX.' ['.$val.']';
			if(!is_null($val = get_request('dropdown_first_entry')))
				$msg[] = S_DROPDOWN_FIRST_ENTRY.' ['.$val.']';
			if(!is_null($val = get_request('dropdown_first_remember')))
				$msg[] = S_DROPDOWN_REMEMBER_SELECTED.' ['.$val.']';
			if(!is_null($val = get_request('max_in_table')))
				$msg[] = S_MAX_IN_TABLE.' ['.$val.']';

			add_audit(AUDIT_ACTION_UPDATE,AUDIT_RESOURCE_ZABBIX_CONFIG,implode('; ',$msg));
		}
	}
	else if(isset($_REQUEST['save'])&&uint_in_array($_REQUEST['config'],array(0,5,7))){

		if(!count(get_accessible_nodes_by_user($USER_DETAILS,PERM_READ_WRITE,PERM_RES_IDS_ARRAY)))
			access_deny();

/* OTHER ACTIONS */
		$configs = array(
				'event_history' => get_request('event_history'),
				'alert_history' => get_request('alert_history'),
				'refresh_unsupported' => get_request('refresh_unsupported'),
				'work_period' => get_request('work_period'),
				'alert_usrgrpid' => get_request('alert_usrgrpid'),
				'discovery_groupid' => get_request('discovery_groupid'),
			);
		$result=update_config($configs);

		show_messages($result, S_CONFIGURATION_UPDATED, S_CONFIGURATION_WAS_NOT_UPDATED);
		if($result){
			$msg = array();
			if(!is_null($val = get_request('event_history')))
				$msg[] = _('Do not keep events older than (in days)').' ['.$val.']';
			if(!is_null($val = get_request('alert_history')))
				$msg[] = _('Do not keep actions older than (in days)').' ['.$val.']';
			if(!is_null($val = get_request('refresh_unsupported')))
				$msg[] = _('Refresh unsupported items (in sec)').' ['.$val.']';
			if(!is_null($val = get_request('work_period')))
				$msg[] = _('Working time').' ['.$val.']';
			if(!is_null($val = get_request('discovery_groupid'))){
				$val = API::HostGroup()->get(array(
					'groupids' => $val,
					'editable' => 1,
					'output' => API_OUTPUT_EXTEND
				));

				if(!empty($val)){
					$val = array_pop($val);
					$msg[] = _('Group for discovered hosts').' ['.$val['name'].']';

					if(bccomp($val['groupid'],$orig_config['discovery_groupid']) !=0 ){
						setHostGroupInternal($orig_config['discovery_groupid'], ZBX_NOT_INTERNAL_GROUP);
						setHostGroupInternal($val['groupid'], ZBX_INTERNAL_GROUP);
					}
				}
			}
			if(!is_null($val = get_request('alert_usrgrpid'))){
				if(0 == $val) {
					$val = S_NONE;
				}
				else{
					$val = DBfetch(DBselect('SELECT name FROM usrgrp WHERE usrgrpid='.$val));
					$val = $val['name'];
				}

				$msg[] = _('User group for database down message').' ['.$val.']';
			}

			add_audit(AUDIT_ACTION_UPDATE,AUDIT_RESOURCE_ZABBIX_CONFIG,implode('; ',$msg));
		}
	}
// VALUE MAPS
	else if($_REQUEST['config']==6){
		$_REQUEST['valuemap'] = get_request('valuemap',array());
		if(isset($_REQUEST['add_map'])){
			$added = 0;
			$cnt = count($_REQUEST['valuemap']);
			for($i=0; $i < $cnt; $i++){
				if($_REQUEST['valuemap'][$i]['value'] != $_REQUEST['add_value'])	continue;
				$_REQUEST['valuemap'][$i]['newvalue'] = $_REQUEST['add_newvalue'];
				$added = 1;
				break;
			}

			if($added == 0){
				if(!ctype_digit($_REQUEST['add_value']) || !is_string($_REQUEST['add_newvalue'])){
					info(S_VALUE_MAPS_CREATE_NUM_STRING);
					show_messages(false,null,S_CANNNOT_ADD_VALUE_MAP);
				}
				else{
					array_push($_REQUEST['valuemap'],array(
						'value'		=> $_REQUEST['add_value'],
						'newvalue'	=> $_REQUEST['add_newvalue']));
				}
			}
		}
		else if(isset($_REQUEST['del_map'])&&isset($_REQUEST['rem_value'])){

			$_REQUEST['valuemap'] = get_request('valuemap',array());
			foreach($_REQUEST['rem_value'] as $val)
				unset($_REQUEST['valuemap'][$val]);
		}
		else if(isset($_REQUEST['save'])){

			$mapping = get_request('valuemap',array());
			if(isset($_REQUEST['valuemapid'])){
				$result		= update_valuemap($_REQUEST['valuemapid'],$_REQUEST['mapname'], $mapping);
				$audit_action	= AUDIT_ACTION_UPDATE;
				$msg_ok		= S_VALUE_MAP_UPDATED;
				$msg_fail	= S_CANNNOT_UPDATE_VALUE_MAP;
				$valuemapid	= $_REQUEST['valuemapid'];
			}
			else{
				if(!count(get_accessible_nodes_by_user($USER_DETAILS,PERM_READ_WRITE,PERM_RES_IDS_ARRAY))){
					access_deny();
				}
				$result		= add_valuemap($_REQUEST['mapname'], $mapping);
				$audit_action	= AUDIT_ACTION_ADD;
				$msg_ok		= S_VALUE_MAP_ADDED;
				$msg_fail	= S_CANNNOT_ADD_VALUE_MAP;
				$valuemapid	= $result;
			}

			if($result){
				add_audit($audit_action, AUDIT_RESOURCE_VALUE_MAP,
					S_VALUE_MAP.' ['.$_REQUEST['mapname'].'] ['.$valuemapid.']');
				unset($_REQUEST['form']);
			}
			show_messages($result,$msg_ok, $msg_fail);
		}
		else if(isset($_REQUEST['delete']) && isset($_REQUEST['valuemapid'])){
			$result = false;

			$sql = 'SELECT * FROM valuemaps WHERE '.DBin_node('valuemapid').' AND valuemapid='.$_REQUEST['valuemapid'];
			if($map_data = DBfetch(DBselect($sql))){
				$result = delete_valuemap($_REQUEST['valuemapid']);
			}

			if($result){
				add_audit(AUDIT_ACTION_DELETE, AUDIT_RESOURCE_VALUE_MAP,
					S_VALUE_MAP.' ['.$map_data['name'].'] ['.$map_data['valuemapid'].']');
				unset($_REQUEST['form']);
			}
			show_messages($result, S_VALUE_MAP_DELETED, S_CANNNOT_DELETE_VALUE_MAP);
		}
	}
	else if(isset($_REQUEST['save']) && ($_REQUEST['config']==9)){
		if(!count(get_accessible_nodes_by_user($USER_DETAILS,PERM_READ_WRITE,PERM_RES_IDS_ARRAY)))
			access_deny();

/* OTHER ACTIONS */
		$configs = array(
				'default_theme' => get_request('default_theme')
			);
		$result=update_config($configs);

		show_messages($result, S_CONFIGURATION_UPDATED, S_CONFIGURATION_WAS_NOT_UPDATED);

		if($result){
			$msg = S_DEFAULT_THEME.' ['.get_request('default_theme').']';
			add_audit(AUDIT_ACTION_UPDATE,AUDIT_RESOURCE_ZABBIX_CONFIG,$msg);
		}
	}
	else if($_REQUEST['config'] == 10){
		if(inarr_isset(array('clone','regexpid'))){
			unset($_REQUEST['regexpid']);
			$_REQUEST['form'] = 'clone';
		}
		else if(isset($_REQUEST['cancel_new_expression'])){
			unset($_REQUEST['new_expression']);
		}
		else if(isset($_REQUEST['save'])){
			if(!count(get_accessible_nodes_by_user($USER_DETAILS,PERM_READ_WRITE,PERM_RES_IDS_ARRAY)))
				access_deny();

			$regexp = array('name' => $_REQUEST['rename'],
						'test_string' => $_REQUEST['test_string']
					);

			DBstart();
			if(isset($_REQUEST['regexpid'])){
				$regexpid=$_REQUEST['regexpid'];

				delete_expressions_by_regexpid($_REQUEST['regexpid']);
				$result = update_regexp($regexpid, $regexp);

				$msg1 = S_REGULAR_EXPRESSION_UPDATED;
				$msg2 = S_CANNOT_UPDATE_REGULAR_EXPRESSION;
			}
			else {
				$result = $regexpid = add_regexp($regexp);

				$msg1 = S_REGULAR_EXPRESSION_ADDED;
				$msg2 = S_CANNOT_ADD_REGULAR_EXPRESSION;
			}

			if($result){
				$expressions = get_request('expressions', array());
				foreach($expressions as $id => $expression){
					$expressionid = add_expression($regexpid,$expression);
				}
			}

			$result = Dbend($result);

			show_messages($result,$msg1,$msg2);

			if($result){ // result - OK
				add_audit(!isset($_REQUEST['regexpid'])?AUDIT_ACTION_ADD:AUDIT_ACTION_UPDATE,
					AUDIT_RESOURCE_REGEXP,
					S_NAME.': '.$_REQUEST['rename']);

				unset($_REQUEST['form']);
			}
		}
		else if(isset($_REQUEST['delete'])){
			if(!count(get_accessible_nodes_by_user($USER_DETAILS,PERM_READ_WRITE,PERM_RES_IDS_ARRAY))) access_deny();

			$regexpids = get_request('regexpid', array());
			if(isset($_REQUEST['regexpids']))
				$regexpids = $_REQUEST['regexpids'];

			zbx_value2array($regexpids);

			$regexps = array();
			foreach($regexpids as $id => $regexpid){
				$regexps[$regexpid] = get_regexp_by_regexpid($regexpid);
			}

			DBstart();
			$result = delete_regexp($regexpids);
			$result = Dbend($result);

			show_messages($result,S_REGULAR_EXPRESSION_DELETED,S_CANNOT_DELETE_REGULAR_EXPRESSION);
			if($result){
				foreach($regexps as $regexpid => $regexp){
					add_audit(AUDIT_ACTION_DELETE,AUDIT_RESOURCE_REGEXP,'Id ['.$regexpid.'] '.S_NAME.' ['.$regexp['name'].']');
				}

				unset($_REQUEST['form']);
				unset($_REQUEST['regexpid']);
			}
		}
		else if(inarr_isset(array('add_expression','new_expression'))){
			$new_expression = $_REQUEST['new_expression'];

			if(!isset($new_expression['case_sensitive']))		$new_expression['case_sensitive'] = 0;

			$result = false;
			if(zbx_empty($new_expression['expression'])) {
				info(S_INCORRECT_EXPRESSION);
			}
			else{
				$result = true;
			}

			if($result){
				if(!isset($new_expression['id'])){
					if(!isset($_REQUEST['expressions'])) $_REQUEST['expressions'] = array();

					if(!str_in_array($new_expression,$_REQUEST['expressions']))
						array_push($_REQUEST['expressions'],$new_expression);
				}
				else{
					$id = $new_expression['id'];
					unset($new_expression['id']);
					$_REQUEST['expressions'][$id] = $new_expression;
				}

				unset($_REQUEST['new_expression']);
			}
		}
		else if(inarr_isset(array('delete_expression','g_expressionid'))){
			$_REQUEST['expressions'] = get_request('expressions',array());
			foreach($_REQUEST['g_expressionid'] as $val){
				unset($_REQUEST['expressions'][$val]);
			}
		}
		else if(inarr_isset(array('edit_expressionid'))){
			$_REQUEST['edit_expressionid'] = array_keys($_REQUEST['edit_expressionid']);
			$edit_expressionid = $_REQUEST['edit_expressionid'] = array_pop($_REQUEST['edit_expressionid']);
			$_REQUEST['expressions'] = get_request('expressions',array());

			if(isset($_REQUEST['expressions'][$edit_expressionid])){
				$_REQUEST['new_expression'] = $_REQUEST['expressions'][$edit_expressionid];
				$_REQUEST['new_expression']['id'] = $edit_expressionid;
			}
		}
	}

	else if($_REQUEST['config'] == 11){ // Macros
		if(isset($_REQUEST['save'])){
			try{
				DBstart();

				$newMacros = get_request('macros', array());
				foreach($newMacros as $mnum => $nmacro){
					if(zbx_empty($nmacro['value'])) unset($newMacros[$mnum]);
				}

				$global_macros = API::UserMacro()->get(array(
					'globalmacro' => 1,
					'output' => API_OUTPUT_EXTEND
				));
				$global_macros = zbx_toHash($global_macros, 'macro');

				$newMacroMacros = zbx_objectValues($newMacros, 'macro');
				$newMacroMacros = zbx_toHash($newMacroMacros, 'macro');

				// Delete
				$macrosToDelete = array();
				foreach($global_macros as $gmacro){
					if(!isset($newMacroMacros[$gmacro['macro']])){
						$macrosToDelete[] = $gmacro['macro'];
					}
				}

				// Update
				$macrosToUpdate = array();
				foreach($newMacros as $mnum => $nmacro){
					if(isset($global_macros[$nmacro['macro']])){
						$macrosToUpdate[] = $nmacro;
						unset($newMacros[$mnum]);
					}
				}

				if(!empty($macrosToDelete)){
					if(!API::UserMacro()->deleteGlobal($macrosToDelete))
						throw new Exception(_('Cannot remove macro'));
				}

				if(!empty($macrosToUpdate)){
					if(!API::UserMacro()->updateGlobal($macrosToUpdate))
						throw new Exception(_('Cannot update macro'));
				}

				if(!empty($newMacros)){
					$macrosToAdd = array_values($newMacros);
					$new_macroids = API::UserMacro()->createGlobal($macrosToAdd);
					if(!$new_macroids)
						throw new Exception('Cannot add macro');
				}

				if(!empty($macrosToAdd)){
					$new_macros = API::UserMacro()->get(array(
						'globalmacroids' => $new_macroids['globalmacroids'],
						'globalmacro' => 1,
						'output' => API_OUTPUT_EXTEND
					));
					$new_macros = zbx_toHash($new_macros, 'globalmacroid');
					foreach($macrosToDelete as $delm){
						add_audit_ext(AUDIT_ACTION_DELETE, AUDIT_RESOURCE_MACRO,
							$delm['globalmacroid'],
							$global_macros[$delm['globalmacroid']]['macro'],
							null,null,null);
					}
					foreach($new_macroids['globalmacroids'] as $newid){
						add_audit_ext(AUDIT_ACTION_ADD, AUDIT_RESOURCE_MACRO,
							$newid,
							$new_macros[$newid]['macro'],
							null,null,null);
					}
				}

				DBend(true);
				show_messages(true, S_MACROS_UPDATED, S_CANNOT_UPDATE_MACROS);
			}
			catch(Exception $e){
				DBend(false);
				error($e->getMessage());
				show_messages(false, S_MACROS_UPDATED, S_CANNOT_UPDATE_MACROS);
			}
		}

	}
	// Trigger severities
	else if(($_REQUEST['config'] == 12) && (isset($_REQUEST['save']))){
		$configs = array(
			'severity_name_0' => get_request('severity_name_0', _('Not classified')),
			'severity_color_0' => get_request('severity_color_0', ''),
			'severity_name_1' => get_request('severity_name_1', _('Information')),
			'severity_color_1' => get_request('severity_color_1', ''),
			'severity_name_2' => get_request('severity_name_2', _('Warning')),
			'severity_color_2' => get_request('severity_color_2', ''),
			'severity_name_3' => get_request('severity_name_3', _('Average')),
			'severity_color_3' => get_request('severity_color_3', ''),
			'severity_name_4' => get_request('severity_name_4', _('High')),
			'severity_color_4' => get_request('severity_color_4', ''),
			'severity_name_5' => get_request('severity_name_5', _('Disaster')),
			'severity_color_5' => get_request('severity_color_5', ''),
		);

		$result = update_config($configs);

		show_messages($result, S_CONFIGURATION_UPDATED, S_CONFIGURATION_WAS_NOT_UPDATED);
	}
	// Trigger displaying options
	else if(($_REQUEST['config'] == 13) && (isset($_REQUEST['save']))){
		$configs = array(
			'ok_period' => get_request('ok_period'),
			'blink_period' => get_request('blink_period'),
			'problem_unack_color' => get_request('problem_unack_color'),
			'problem_ack_color' => get_request('problem_ack_color'),
			'ok_unack_color' => get_request('ok_unack_color'),
			'ok_ack_color' => get_request('ok_ack_color'),
			'problem_unack_style' => get_request('problem_unack_style', 0),
			'problem_ack_style' => get_request('problem_ack_style', 0),
			'ok_unack_style' => get_request('ok_unack_style', 0),
			'ok_ack_style' => get_request('ok_ack_style', 0)
		);

		$result = update_config($configs);

		show_messages($result, S_CONFIGURATION_UPDATED, S_CONFIGURATION_WAS_NOT_UPDATED);
	}
?>

<?php
	$form = new CForm();

	$cmbConfig = new CCombobox('configDropDown', $_REQUEST['config'], 'javascript: redirect("config.php?config="+this.options[this.selectedIndex].value);');
	$cmbConfig->addItems(array(
		8 => _('GUI'),
		0 => _('Housekeeper'),
		3 => _('Images'),
		10 => _('Regular expressions'),
		11 => _('Macros'),
		6 => _('Value mapping'),
		7 => _('Working time'),
		12 => _('Trigger severities'),
		13 => _('Trigger displaying options'),
		5 => _('Other'),
	));
	$form->addItem($cmbConfig);

	if(!isset($_REQUEST['form'])){
		switch($_REQUEST['config']){
			case 3:
				$form->addItem(new CSubmit('form', _('Create image')));
				break;
			case 6:
				$form->addItem(new CSubmit('form', _('Create value map')));
				break;
			case 10:
				$form->addItem(new CSubmit('form', _('New regular expression')));
				break;
		}
	}

	$cnf_wdgt = new CWidget();
	$cnf_wdgt->addPageHeader(S_CONFIGURATION_OF_ZABBIX_BIG, $form);


	if(isset($_REQUEST['config'])){
		$config = select_config(false, get_current_nodeid(false));
	}

/////////////////////////////////
//  config = 0 // Housekeeper  //
/////////////////////////////////
	if($_REQUEST['config'] == 0){
		$data = array();
		$data['form'] = get_request('form', 1);
		$data['form_refresh'] = get_request('form_refresh', 0);

		if($data['form_refresh']){
			$data['config']['alert_history'] = get_request('alert_history');
			$data['config']['event_history'] = get_request('event_history');
		}
		else{
			$data['config'] = select_config(false);
		}

		$houseKeeperForm = new CView('administration.general.housekeeper.edit', $data);
		$cnf_wdgt->addItem($houseKeeperForm->render());
	}
////////////////////////////
//  config = 3 // Images  //
////////////////////////////
	elseif($_REQUEST["config"] == 3){
		if(isset($_REQUEST["form"])){
			$frmImages = new CFormTable(S_IMAGE, 'config.php', 'post', 'multipart/form-data');
			$frmImages->setHelp('web.config.images.php');
			$frmImages->addVar('config', get_request('config',3));

			if(isset($_REQUEST['imageid'])){
				$sql = 'SELECT imageid,imagetype,name '.
						' FROM images '.
						' WHERE imageid='.$_REQUEST['imageid'];
				$result=DBselect($sql);
				$row=DBfetch($result);

				$frmImages->setTitle(S_IMAGE.' "'.$row['name'].'"');
				$frmImages->addVar('imageid', $_REQUEST['imageid']);
			}

			if(isset($_REQUEST['imageid']) && !isset($_REQUEST['form_refresh'])){
				$name		= $row['name'];
				$imagetype	= $row['imagetype'];
				$imageid	= $row['imageid'];
			}
			else{
				$name		= get_request('name','');
				$imagetype	= get_request('imagetype',1);
				$imageid	= get_request('imageid',0);
			}

			$frmImages->addRow(S_NAME,new CTextBox('name',$name,64));

			$cmbImg = new CComboBox('imagetype',$imagetype);
			$cmbImg->addItem(IMAGE_TYPE_ICON,S_ICON);
			$cmbImg->addItem(IMAGE_TYPE_BACKGROUND,S_BACKGROUND);

			$frmImages->addRow(S_TYPE,$cmbImg);

			$frmImages->addRow(S_UPLOAD,new CFile('image'));

			if($imageid > 0){
				$frmImages->addRow(S_IMAGE,new CLink(
					new CImg('imgstore.php?iconid='.$imageid,'no image',null),'image.php?imageid='.$row['imageid']));
			}

			$frmImages->addItemToBottomRow(new CSubmit('save',S_SAVE));
			if(isset($_REQUEST['imageid'])){
				$frmImages->addItemToBottomRow(SPACE);
				$frmImages->addItemToBottomRow(new CButtonDelete(S_DELETE_SELECTED_IMAGE,
					url_param('form').url_param('config').url_param('imageid')));
			}

			$frmImages->addItemToBottomRow(SPACE);
			$frmImages->addItemToBottomRow(new CButtonCancel(url_param('config')));

			$cnf_wdgt->addItem($frmImages);
		}
		else{
			$cnf_wdgt->addItem(BR());

			$imagetype = get_request('imagetype',IMAGE_TYPE_ICON);

			$r_form = new CForm();

			$cmbImg = new CComboBox('imagetype',$imagetype,'submit();');
			$cmbImg->addItem(IMAGE_TYPE_ICON,S_ICON);
			$cmbImg->addItem(IMAGE_TYPE_BACKGROUND,S_BACKGROUND);

			$r_form->addItem(S_TYPE.SPACE);
			$r_form->addItem($cmbImg);

			$cnf_wdgt->addHeader(S_IMAGES_BIG,$r_form);

			$table = new CTable(S_NO_IMAGES_DEFINED, 'header_wide');

			$tr = 0;
			$row = new CRow();

			$options = array(
				'filter'=> array('imagetype'=> $imagetype),
				'output'=> API_OUTPUT_EXTEND,
				'sortfield'=> 'name'
			);
			$images = API::Image()->get($options);
			foreach($images as $inum => $image){
				switch($image['imagetype']){
					case IMAGE_TYPE_ICON:
						$imagetype = S_ICON;
						$img = new CImg('imgstore.php?iconid='.$image['imageid'],'no image');
					break;
					case IMAGE_TYPE_BACKGROUND:
						$imagetype = S_BACKGROUND;
						$img = new CImg('imgstore.php?iconid='.$image['imageid'],'no image',200);
					break;
					default: $imagetype=S_UNKNOWN;
				}

				$name = new CLink($image['name'],'config.php?form=update'.url_param('config').'&imageid='.$image['imageid']);
				$action = new CLink($img, 'image.php?imageid='.$image['imageid']);

				$img_td = new CCol();
				$img_td->setAttribute('align', 'center');
				$img_td->addItem(array($action, BR(), $name), 'center');

				$row->addItem($img_td);
				$tr++;
				if(($tr % 4) == 0){
					$table->addRow($row);
					$row = new CRow();
				}
			}

			if($tr > 0){
				while(($tr % 4) != 0){ $tr++; $row->addItem(SPACE);}
				$table->addRow($row);
			}

			$cnf_wdgt->addItem($table);
		}
	}
//////////////////////////////////////
//  config = 5 // Other Parameters  //
//////////////////////////////////////
	elseif($_REQUEST['config'] == 5){
		$data = array();
		$data['form'] = get_request('form', 1);
		$data['form_refresh'] = get_request('form_refresh', 0);

		if($data['form_refresh']){
			$data['config']['discovery_groupid'] = get_request('discovery_groupid');
			$data['config']['alert_usrgrpid'] = get_request('alert_usrgrpid');
			$data['config']['refresh_unsupported'] = get_request('refresh_unsupported');
		}
		else{
			$data['config'] = select_config(false);
		}

		$data['discovery_groups'] = API::HostGroup()->get(array(
										'sortfield'=>'name',
										'editable' => 1,
										'output' => API_OUTPUT_EXTEND
									));
		$data['alert_usrgrps'] = DBfetchArray(DBselect('SELECT usrgrpid, name FROM usrgrp WHERE '.DBin_node('usrgrpid').' order by name'));

		$otherForm = new CView('administration.general.other.edit', $data);
		$cnf_wdgt->addItem($otherForm->render());
	}
///////////////////////////////////
//  config = 6 // Value Mapping  //
///////////////////////////////////
	elseif($_REQUEST['config'] == 6){
		if(isset($_REQUEST['form'])){
			$frmValmap = new CFormTable(S_VALUE_MAP);
			$frmValmap->setHelp("web.mapping.php");
			$frmValmap->addVar("config", 6);

			if(isset($_REQUEST["valuemapid"])){
				$frmValmap->addVar("valuemapid",$_REQUEST["valuemapid"]);
				$db_valuemaps = DBselect("select * FROM valuemaps".
					" WHERE valuemapid=".$_REQUEST["valuemapid"]);

				$db_valuemap = DBfetch($db_valuemaps);

				$frmValmap->setTitle(S_VALUE_MAP.' "'.$db_valuemap["name"].'"');
			}

			if(isset($_REQUEST["valuemapid"]) && !isset($_REQUEST["form_refresh"])){
				$valuemap = array();
				$mapname = $db_valuemap["name"];
				$mappings = DBselect("select * FROM mappings WHERE valuemapid=".$_REQUEST["valuemapid"]);
				while($mapping = DBfetch($mappings)) {
					$valuemap[] = array(
						"value" => $mapping["value"],
						"newvalue" => $mapping["newvalue"]);
				}
			}
			else{
				$mapname = get_request("mapname","");
				$valuemap = get_request("valuemap",array());
			}

			$frmValmap->addRow(S_NAME, new CTextBox("mapname",$mapname,40));

			$i = 0;
			$valuemap_el = array();
			foreach($valuemap as $value){
				array_push($valuemap_el,
					array(
						new CCheckBox("rem_value[]", 'no', null, $i),
						$value["value"].SPACE.RARR.SPACE.$value["newvalue"]
					),
					BR());
				$frmValmap->addVar("valuemap[$i][value]",$value["value"]);
				$frmValmap->addVar("valuemap[$i][newvalue]",$value["newvalue"]);
				$i++;
			}

			$saveButton = new CSubmit('save', S_SAVE);

			if(count($valuemap_el)==0) {
				array_push($valuemap_el, S_NO_MAPPING_DEFINED);
				$saveButton->setAttribute('disabled', 'true');
			}
			else{
				array_push($valuemap_el, new CSubmit('del_map',S_DELETE_SELECTED));
			}

			$frmValmap->addRow(S_MAPPING, $valuemap_el);
			$frmValmap->addRow(S_NEW_MAPPING, array(
				new CTextBox("add_value","",10),
				new CSpan(RARR,"rarr"),
				new CTextBox("add_newvalue","",10),
				SPACE,
				new CSubmit("add_map",S_ADD)
				),'new');

			$buttons = array($saveButton);
			if(isset($_REQUEST["valuemapid"])){
				$sql = 'SELECT COUNT(itemid) as cnt FROM items WHERE valuemapid='.$_REQUEST['valuemapid'];
				$count = DBfetch(DBselect($sql));
				if($count['cnt']){
					$confirmMessage = _n('Delete selected value mapping? It is used for %d item!',
						'Delete selected value mapping? It is used for %d items!', $count['cnt']);
				}
				else{
					$confirmMessage = _s('Delete selected value mapping?');
				}

				$buttons[] = new CButtonDelete($confirmMessage,
					url_param("form").url_param("valuemapid").url_param("config"));
			}
			$buttons[] = new CButtonCancel(url_param("config"));

			$frmValmap->addItemToBottomRow($buttons);
			$cnf_wdgt->addItem($frmValmap);
		}
		else{
			$cnf_wdgt->addItem(BR());
			$cnf_wdgt->addHeader(S_VALUE_MAPPING_BIG);

			$table = new CTableInfo();
			$table->setHeader(array(S_NAME, S_VALUE_MAP));

			$valueamaps = array();
// get value maps
			$db_valuemaps = DBselect('SELECT valuemapid, name FROM valuemaps WHERE '.DBin_node('valuemapid'));
			while($db_valuemap = DBfetch($db_valuemaps)){
				$valueamaps[$db_valuemap['valuemapid']] = $db_valuemap;
				$valueamaps[$db_valuemap['valuemapid']]['maps'] = array();
			}

			$db_maps = DBselect('SELECT valuemapid, value, newvalue FROM mappings WHERE '.DBin_node('mappingid'));
			while($db_map = DBfetch($db_maps)){
				$valueamaps[$db_map['valuemapid']]['maps'][] = array(
					'value' => $db_map['value'],
					'newvalue' => $db_map['newvalue']
				);
			}


			order_result($valueamaps, 'name');
			foreach($valueamaps as $valuemap){
				$mappings_row = array();

				$maps = $valuemap['maps'];
				order_result($maps, 'value');
				foreach($maps as $map){
					array_push($mappings_row,
						$map['value'],
						SPACE.RARR.SPACE,
						$map['newvalue'],
						BR()
					);
				}
				$table->addRow(array(
					new CLink($valuemap['name'],'config.php?form=update&valuemapid='.$valuemap['valuemapid'].url_param('config')),
					empty($mappings_row) ? SPACE : $mappings_row
				));
			}

			$cnf_wdgt->addItem($table);
		}
	}
/////////////////////////////////
//  config = 7 // Working time //
/////////////////////////////////
	elseif($_REQUEST['config'] == 7){
		$data = array();
		$data['form'] = get_request('form', 1);
		$data['form_refresh'] = get_request('form_refresh', 0);

		if($data['form_refresh']){
			$data['config']['work_period'] = get_request('work_period');
		}
		else{
			$data['config'] = select_config(false);
		}

		$workingTimeForm = new CView('administration.general.workingtime.edit', $data);
		$cnf_wdgt->addItem($workingTimeForm->render());
	}
/////////////////////////
//  config = 8 // GUI  //
/////////////////////////
	elseif($_REQUEST['config'] == 8){
		$data = array();
		$data['form'] = get_request('form', 1);
		$data['form_refresh'] = get_request('form_refresh', 0);

		if($data['form_refresh']){
			$data['config']['default_theme'] = get_request('default_theme');
			$data['config']['event_ack_enable'] = get_request('event_ack_enable');
			$data['config']['dropdown_first_entry'] = get_request('dropdown_first_entry');
			$data['config']['dropdown_first_remember'] = get_request('dropdown_first_remember');
			$data['config']['search_limit'] = get_request('search_limit');
			$data['config']['max_in_table'] = get_request('max_in_table');
			$data['config']['event_expire'] = get_request('event_expire');
			$data['config']['event_show_max'] = get_request('event_show_max');
		}
		else{
			$data['config'] = select_config(false);
		}

		$guiForm = new CView('administration.general.gui.edit', $data);
		$cnf_wdgt->addItem($guiForm->render());
	}
//////////////////////////////////////////
//  config = 10 // Regular Expressions  //
//////////////////////////////////////////
	elseif($_REQUEST['config'] == 10){
		if(isset($_REQUEST['form'])){

			$frmRegExp = new CForm('post','config.php');
			$frmRegExp->setName(S_REGULAR_EXPRESSION);
			$frmRegExp->addVar('form', get_request('form', 1));

			$from_rfr = get_request('form_refresh', 0);
			$frmRegExp->addVar('form_refresh', $from_rfr+1);
			$frmRegExp->addVar('config', get_request('config', 10));

			if(isset($_REQUEST['regexpid']))
				$frmRegExp->addVar('regexpid', $_REQUEST['regexpid']);

			$left_tab = new CTable();

			$left_tab->addRow(create_hat(
					S_REGULAR_EXPRESSION,
					get_regexp_form(),//null,
					null,
					'hat_regexp'
					//CProfile::get('web.config.hats.hat_regexp.state',1)
				));

			$right_tab = new CTable();

			$right_tab->addRow(create_hat(
					S_EXPRESSIONS,
					get_expressions_tab(),//null,
					null,
					'hat_expressions'
				));

			if(isset($_REQUEST['new_expression'])){
				$right_tab->addRow(create_hat(
						S_NEW_EXPRESSION,
						get_expression_form(),//null
						null,
						'hat_new_expression'
					));
			}


			$td_l = new CCol($left_tab);
			$td_l->setAttribute('valign','top');

			$td_r = new CCol($right_tab);
			$td_r->setAttribute('valign','top');

			$outer_table = new CTable();
			$outer_table->addRow(array($td_l,$td_r));

			$frmRegExp->additem($outer_table);

			show_messages();

			$cnf_wdgt->addItem($frmRegExp);
		}
		else{
			$cnf_wdgt->addItem(BR());

			$cnf_wdgt->addHeader(S_REGULAR_EXPRESSIONS);
// ----
			$regexps = array();
			$regexpids = array();

			$sql = 'SELECT re.* '.
					' FROM regexps re '.
					' WHERE '.DBin_node('re.regexpid').
					' ORDER BY re.name';

			$db_regexps = DBselect($sql);
			while($regexp = DBfetch($db_regexps)){
				$regexp['expressions'] = array();

				$regexps[$regexp['regexpid']] = $regexp;
				$regexpids[$regexp['regexpid']] = $regexp['regexpid'];
			}

			$count = array();
			$expressions = array();
			$sql = 'SELECT e.* '.
					' FROM expressions e '.
					' WHERE '.DBin_node('e.expressionid').
						' AND '.DBcondition('e.regexpid',$regexpids).
					' ORDER BY e.expression_type';

			$db_exps = DBselect($sql);
			while($exp = DBfetch($db_exps)){
				if(!isset($expressions[$exp['regexpid']])) $count[$exp['regexpid']] = 1;
				else $count[$exp['regexpid']]++;

				if(!isset($expressions[$exp['regexpid']])) $expressions[$exp['regexpid']] = new CTable();

				$expressions[$exp['regexpid']]->addRow(array($count[$exp['regexpid']], ' &raquo; ', $exp['expression'],' ['.expression_type2str($exp['expression_type']).']'));

				$regexp[$exp['regexpid']]['expressions'][$exp['expressionid']] = $exp;
			}

			$form = new CForm();
			$form->setName('regexp');

			$table = new CTableInfo();
			$table->setHeader(array(
				new CCheckBox('all_regexps',null,"checkAll('".$form->GetName()."','all_regexps','regexpids');"),
				S_NAME,
				S_EXPRESSIONS
				));

			foreach($regexps as $regexpid => $regexp){

				$table->addRow(array(
					new CCheckBox('regexpids['.$regexp['regexpid'].']',null,null,$regexp['regexpid']),
					new CLink($regexp['name'],'config.php?form=update'.url_param('config').'&regexpid='.$regexp['regexpid'].'#form'),
					isset($expressions[$regexpid])?$expressions[$regexpid]:'-'
					));
			}

			$table->setFooter(new CCol(array(
				new CButtonQMessage('delete',S_DELETE_SELECTED,S_DELETE_SELECTED_REGULAR_EXPRESSIONS_Q)
			)));

			$form->addItem($table);

			$cnf_wdgt->addItem($form);
		}
	}
/////////////////////////////
//  config = 11 // Macros  //
/////////////////////////////
	elseif($_REQUEST['config'] == 11){
		$data = array();
		$data['form'] = get_request('form', 1);
		$data['form_refresh'] = get_request('form_refresh', 0);
		$data['macros'] = array();

		if ($data['form_refresh']) {
			$data['macros'] = get_request('macros', array());
		}
		else {
			$data['macros'] = API::UserMacro()->get(array('output' => API_OUTPUT_EXTEND, 'globalmacro' => 1));
			order_result($data['macros'], 'macro');
		}
		if (empty($data['macros'])) {
			$data['macros'] = array(0 => array('macro' => '', 'value' => ''));
		}

		$macrosForm = new CView('administration.general.macros.edit', $data);
		$cnf_wdgt->addItem($macrosForm->render());
	}
/////////////////////////////////////////
//  config = 12 // Trigger severities  //
/////////////////////////////////////////
	elseif($_REQUEST['config'] == 12){
		$data = array();
		$data['form'] = get_request('form', 1);
		$data['form_refresh'] = get_request('form_refresh', 0);

		if($data['form_refresh']){
			$data['config']['severity_name_0'] = get_request('severity_name_0');
			$data['config']['severity_color_0'] = get_request('severity_color_0', '');
			$data['config']['severity_name_1'] = get_request('severity_name_1');
			$data['config']['severity_color_1'] = get_request('severity_color_1', '');
			$data['config']['severity_name_2'] = get_request('severity_name_2');
			$data['config']['severity_color_2'] = get_request('severity_color_2', '');
			$data['config']['severity_name_3'] = get_request('severity_name_3');
			$data['config']['severity_color_3'] = get_request('severity_color_3', '');
			$data['config']['severity_name_4'] = get_request('severity_name_4');
			$data['config']['severity_color_4'] = get_request('severity_color_4', '');
			$data['config']['severity_name_5'] = get_request('severity_name_5');
			$data['config']['severity_color_5'] = get_request('severity_color_5', '');
		}
		else{
			$data['config'] = select_config(false);
		}

		$triggerSeverityForm = new CView('administration.general.triggerSeverity.edit', $data);
		$cnf_wdgt->addItem($triggerSeverityForm->render());
	}
////////////////////////////////////////////////
//  config = 13 // Trigger displaying options //
////////////////////////////////////////////////
	elseif($_REQUEST['config'] == 13){
		$data = array();
		$data['form'] = get_request('form', 1);
		$data['form_refresh'] = get_request('form_refresh', 0);

		// form has been submitted
		if($data['form_refresh']){
			$data['ok_period'] = get_request('ok_period');
			$data['blink_period'] = get_request('blink_period');
			$data['problem_unack_color'] = get_request('problem_unack_color');
			$data['problem_ack_color'] = get_request('problem_ack_color');
			$data['ok_unack_color'] = get_request('ok_unack_color');
			$data['ok_ack_color'] = get_request('ok_ack_color');
			$data['problem_unack_style'] = get_request('problem_unack_style');
			$data['problem_ack_style'] = get_request('problem_ack_style');
			$data['ok_unack_style'] = get_request('ok_unack_style');
			$data['ok_ack_style'] = get_request('ok_ack_style');
		}
		else{
			$config = select_config(false);
			$data['ok_period'] = $config['ok_period'];
			$data['blink_period'] = $config['blink_period'];
			$data['problem_unack_color'] = $config['problem_unack_color'];
			$data['problem_ack_color'] = $config['problem_ack_color'];
			$data['ok_unack_color'] = $config['ok_unack_color'];
			$data['ok_ack_color'] = $config['ok_ack_color'];
			$data['problem_unack_style'] = $config['problem_unack_style'];
			$data['problem_ack_style'] = $config['problem_ack_style'];
			$data['ok_unack_style'] = $config['ok_unack_style'];
			$data['ok_ack_style'] = $config['ok_ack_style'];
		}

		$triggerDisplayingForm = new CView('administration.general.triggerDisplayingOptions.edit', $data);
		$cnf_wdgt->addItem($triggerDisplayingForm->render());
	}

	$cnf_wdgt->show();


include_once('include/page_footer.php');
?>
