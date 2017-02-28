<?php
/**
 * @version     $Id$
 * @package     Joomla.Site
 * @subpackage  mod_jea_search
 * @copyright   Copyright (C) 2012 PHILIP Sylvain. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_ROOT.'/administrator/components/com_jea/helpers/html');
JHtml::addIncludePath(JPATH_ROOT.'/components/com_jea/helpers/html');

// Load component language
JFactory::getLanguage()->load('com_jea', JPATH_BASE.'/components/com_jea');

$states = array(
        'filter_search' => '',
        'filter_transaction_type' => '',
        'filter_type_id' => 0,
        'filter_department_id' => 0,
        'filter_town_id' => 0,
        'filter_area_id' => 0,
        'filter_zip_codes' => '',
        'filter_budget_min' => 0,
        'filter_budget_max' => 0,
        'filter_living_space_min' => 0,
        'filter_living_space_max' => 0,
        'filter_land_space_min' => 0,
        'filter_land_space_max' => 0,
        'filter_rooms_min' => 0,
        'filter_bedrooms_min' => 0,
        'filter_bathrooms_min' => 0,
        'filter_floor' => '',
        'filter_hotwatertype' => 0,
        'filter_heatingtype' => 0,
        'filter_condition' => 0,
        'filter_orientation' => 0,
        'filter_amenities' => array()
);

$uid = uniqid();

$app = JFactory::getApplication();

// Retrieve user request saved in session
foreach ($states as $name => $defaultValue) {
    $states[$name] = $app->getUserStateFromRequest('module_jea_search.' . $module->id . '.' . $name, $name, $defaultValue);
}

$useAjax        = $params->get('use_ajax', 0);
$transationType = $params->get('transaction_type');

$showLocalization = $params->get('show_departments',1)
                  || $params->get('show_towns',1)
                  || $params->get('show_areas',0)
                  || $params->get('show_zip_codes',0);

$showOtherFilters = $params->get('show_number_of_rooms')
                  || $params->get('show_number_of_bedrooms')
                  || $params->get('show_number_of_bathrooms')
                  || $params->get('show_floor')
                  || $params->get('show_hotwatertypes')
                  || $params->get('show_heatingtypes')
                  || $params->get('show_conditions')
                  || $params->get('show_orientation');

if (empty($transationType) && empty($states['filter_transaction_type'])) {
    // Set SELLING as default transaction_type state
    $states['filter_transaction_type'] = 'SELLING';
} elseif (!empty($transationType) && empty($states['filter_transaction_type'])) {
    $states['filter_transaction_type'] = $transationType;
}

$itemid = $params->get('search_itemid', 0);
if ($itemid) {
    $formURL = JRoute::_('index.php?option=com_jea&task=properties.search&Itemid='.$itemid);
} else {
    $formURL = JRoute::_('index.php?option=com_jea&task=properties.search');
}

require(JModuleHelper::getLayoutPath('mod_jea_search', $params->get('layout', 'default')));
