<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_jea_search
 * @copyright   Copyright (C) 2008 - 2023 PHILIP Sylvain. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Application\SiteApplication;

defined('_JEXEC') or die;

assert($params instanceof Registry);
assert($app instanceof SiteApplication);

/**
 * @var $module stdClass
 * @var $params Joomla\Registry\Registry
 */

 HTMLHelper::addIncludePath(JPATH_ROOT . '/administrator/components/com_jea/helpers/html');
 HTMLHelper::addIncludePath(JPATH_ROOT . '/components/com_jea/helpers/html');

$uid = uniqid();

// Load component language
$app->getLanguage()->load('com_jea', JPATH_BASE . '/components/com_jea');

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

// Retrieve user request saved in session
foreach ($states as $name => $defaultValue)
{
	$states[$name] = $app->getUserStateFromRequest('module_jea_search.' . $module->id . '.' . $name, $name, $defaultValue);
}

$useAjax = $params->get('use_ajax', 0);
$transactionType = $params->get('transaction_type');

$showLocalization = $params->get('show_departments', 1) || $params->get('show_towns', 1) || $params->get('show_areas', 0) ||
					$params->get('show_zip_codes', 0);

$showOtherFilters = $params->get('show_number_of_rooms') || $params->get('show_number_of_bedrooms') ||
					$params->get('show_number_of_bathrooms') || $params->get('show_floor') || $params->get('show_hotwatertypes') ||
					$params->get('show_heatingtypes') || $params->get('show_conditions') || $params->get('show_orientation');

$states['filter_transaction_type'] = $transactionType;

$itemid = $params->get('search_itemid', 0);

$formURL = $itemid ? Route::_('index.php?option=com_jea&task=properties.search&Itemid=' . $itemid) :
			Route::_('index.php?option=com_jea&task=properties.search');

require ModuleHelper::getLayoutPath('mod_jea_search', $params->get('layout', 'default'));
