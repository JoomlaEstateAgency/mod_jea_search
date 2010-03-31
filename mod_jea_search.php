<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 * 
 * @version     $Id$
 * @package		Jea.module.search
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.txt
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 * 
 */

defined('_JEXEC') or die('Restricted access');

function getHtmlList($table, $title, $id ){

	$sql = "SELECT `id` AS value ,`value` AS text FROM {$table} ORDER BY ordering" ;

	$db = & JFactory::getDBO();
	$db->setQuery($sql);
	$rows = $db->loadObjectList();

	if ( $db->getErrorNum() ) {
		JError::raiseWarning( 200, $db->getErrorMsg() );
	}

	//unshift default option
	array_unshift($rows, JHTML::_('select.option', '0', $title ));

	return JHTML::_('select.genericlist', $rows , $id, 'class="inputbox" size="1" ' , 'value', 'text', 0);
}

//conflict between component searchform and module searchform because both use same id's
$conflict = JRequest::getVar('option') == 'com_jea' && JRequest::getVar('layout') == 'search' ;
$conflict2 = JRequest::getVar('option') == 'com_jea' && JRequest::getVar('layout') == 'form' ;
if(!$conflict && !$conflict2 ){
	require(JModuleHelper::getLayoutPath('mod_jea_search'));
}

