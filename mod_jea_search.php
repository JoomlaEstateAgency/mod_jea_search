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

$app = JFactory::getApplication();

// Retrieve user request saved in session
foreach ($states as $name => $defaultValue) {
    $states[$name] = $app->getUserStateFromRequest('module_jea_search.'. $name, $name, $defaultValue);
}

// Load component language
JFactory::getLanguage()->load('com_jea', JPATH_BASE.'/components/com_jea');


require(JModuleHelper::getLayoutPath('mod_jea_search'));
