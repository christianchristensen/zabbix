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

$regExpForm = new CForm();
$regExpForm->setName('regularExpressionsForm');
$regExpForm->addVar('form', $this->data['form']);
$regExpForm->addVar('form_refresh', $this->data['form_refresh']);
$regExpForm->addVar('config', get_request('config', 10));
$regExpForm->addVar('regexpid', get_request('regexpid'));

$regExpLeftTable = new CTable();
$regExpLeftTable->addRow(create_hat(_('Regular expression'), get_regexp_form(), null, 'hat_regexp'));

$regExpRightTable = new CTable();
$regExpRightTable->addRow(create_hat(_('Expressions'), get_expressions_tab(), null, 'hat_expressions'));

if(isset($_REQUEST['new_expression'])){
	$regExpRightTable->addRow(create_hat(_('New expression'), get_expression_form(), null, 'hat_new_expression'));
}

$regExpLeftColumn = new CCol($regExpLeftTable);
$regExpLeftColumn->setAttribute('valign','top');

$regExpRightColumn = new CCol($regExpRightTable);
$regExpRightColumn->setAttribute('valign','top');

$regExpOuterTable = new CTable();
$regExpOuterTable->addRow(array($regExpLeftColumn, $regExpRightColumn));

$regExpTab = new CTabView();
$regExpTab->addTab('regularExpressions', _('Regular expression'), $regExpOuterTable);

$regExpForm->addItem($regExpTab);

show_messages();

return $regExpForm;
?>
