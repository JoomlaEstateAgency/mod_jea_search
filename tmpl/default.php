<?php
/**
 * @version     $Id$
 * @package     Joomla.Site
 * @subpackage  mod_jea_search
 * @copyright   Copyright (C) 2012 PHILIP Sylvain. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die();

$fields = json_encode($states);
$ajax = $useAjax? 'true': 'false';
JHtml::_('behavior.framework');
JHtml::script('media/com_jea/js/search.js');
JHtml::stylesheet('modules/mod_jea_search/mod_jea_search.css');
$document = JFactory::getDocument();
$document->addScriptDeclaration("
window.addEvent('domready', function() {
    var jeaSearch = new JEASearch('mod-jea-search-form-$uid', {fields:$fields, useAJAX:$ajax});
    jeaSearch.refresh();

});");
?>

<form action="<?php echo $formURL ?>" method="post" id="mod-jea-search-form-<?php echo $uid ?>" class="mod-jea-search-form">

<?php if ($params->get('show_freesearch')): ?>
  <p>
    <label for="jea-search<?php echo $uid ?>"><?php echo JText::_('COM_JEA_SEARCH_LABEL')?> : </label>
    <input type="text" name="filter_search" id="jea-search<?php echo $uid ?>" value="<?php echo htmlspecialchars($states['filter_search'], ENT_QUOTES, 'UTF-8') ?>" />
    <input type="submit" class="button" value="<?php echo JText::_('JSEARCH_FILTER_SUBMIT')?>" />
  </p>
  <hr />
<?php endif ?>

  <p>
  <?php echo JHtml::_('features.types', $states['filter_type_id'], 'filter_type_id', array('id' => 'type_id'.$uid)) ?>
  </p>

  <p>
  <?php if ($transationType == 'RENTING'): ?>
    <input type="hidden" name="filter_transaction_type" value="RENTING" />
  <?php elseif($transationType == 'SELLING'): ?>
    <input type="hidden" name="filter_transaction_type" value="SELLING" />
  <?php else: ?>
    <input type="radio" name="filter_transaction_type" id="jea-search-selling<?php echo $uid ?>" value="SELLING"
           <?php if ($states['filter_transaction_type'] == 'SELLING') echo 'checked="checked"' ?> />
    <label for="jea-search-selling<?php echo $uid ?>"><?php echo JText::_('COM_JEA_OPTION_SELLING') ?></label>

    <input type="radio" name="filter_transaction_type" id="jea-search-renting<?php echo $uid ?>" value="RENTING"
           <?php if ($states['filter_transaction_type'] == 'RENTING') echo 'checked="checked"' ?> />
    <label for="jea-search-renting<?php echo $uid ?>"><?php echo JText::_('COM_JEA_OPTION_RENTING') ?></label>
  <?php endif ?>
  </p>

<?php if ($showLocalization): ?>
  <p><strong><?php echo JText::_('COM_JEA_LOCALIZATION') ?> :</strong></p>

  <p>
    <?php if ($params->get('show_departments', 1)): ?>
    <?php echo JHtml::_('features.departments', $states['filter_department_id'], 'filter_department_id', array('id' => 'department_id'.$uid)) ?>
    <?php endif ?><br />

    <?php if ($params->get('show_towns', 1)): ?>
    <?php echo JHtml::_('features.towns', $states['filter_town_id'], 'filter_town_id', array('id' => 'town_id'.$uid )) ?>
    <?php endif ?><br />

    <?php if ($params->get('show_areas', 1)): ?>
    <?php echo JHtml::_('features.areas', $states['filter_area_id'], 'filter_area_id', array('id' => 'area_id'.$uid )) ?>
    <?php endif ?><br />
  </p>

  <?php if ($params->get('show_zip_codes', 1)): ?>
  <p>
    <label for="jea-search-zip-codes<?php echo $uid ?>"><?php echo JText::_('COM_JEA_SEARCH_ZIP_CODES') ?> : </label>
    <input id="jea-search-zip-codes<?php echo $uid ?>" type="text" name="filter_zip_codes" size="20" value="<?php echo $states['filter_zip_codes'] ?>" />
    <em><?php echo JText::_('COM_JEA_SEARCH_ZIP_CODES_DESC') ?></em>
  </p>
  <?php endif ?>
<?php endif ?>

<?php if ($params->get('show_budget', 1)): ?>
  <p><strong><?php echo JText::_('COM_JEA_BUDGET') ?> :</strong></p>
  <dl class="col-left">
    <dt><label for="jea-search-budget-min<?php echo $uid ?>"><?php echo JText::_('COM_JEA_MIN') ?> : </label></dt>
    <dd><input id="jea-search-budget-min<?php echo $uid ?>" type="text" name="filter_budget_min"
               size="5" value="<?php echo $states['filter_budget_min'] ?>" />
    <?php echo $params->get('currency_symbol', '&euro;') ?></dd>
  </dl>
  <dl class="col-right">
    <dt><label for="jea-search-budget-max<?php echo $uid ?>"><?php echo JText::_('COM_JEA_MAX') ?> : </label></dt>
    <dd><input id="jea-search-budget-max<?php echo $uid ?>" type="text" name="filter_budget_max"
               size="5" value="<?php echo $states['filter_budget_max'] ?>" />
    <?php echo $params->get('currency_symbol', '&euro;') ?></dd>
  </dl>
<?php endif ?>

<?php if ($params->get('show_living_space', 1)): ?>
  <p><strong><?php echo JText::_('COM_JEA_FIELD_LIVING_SPACE_LABEL') ?> :</strong></p>
  <dl class="col-left">
    <dt><label for="jea-search-living-space-min<?php echo $uid ?>"><?php echo JText::_('COM_JEA_MIN') ?> : </label></dt>
    <dd><input id="jea-search-living-space-min<?php echo $uid ?>" type="text" name="filter_living_space_min"
               size="5" value="<?php echo $states['filter_living_space_min'] ?>" />
    <?php echo $params->get( 'surface_measure' ) ?></dd>
  </dl>
  <dl class="col-right">
    <dt><label for="jea-search-living-space-max<?php echo $uid ?>"><?php echo JText::_('COM_JEA_MAX') ?> : </label></dt>
    <dd><input id="jea-search-living-space-max<?php echo $uid ?>" type="text" name="filter_living_space_max"
               size="5" value="<?php echo $states['filter_living_space_max'] ?>" />
    <?php echo $params->get( 'surface_measure' ) ?></dd>
  </dl>
<?php endif ?>

<?php if ($params->get('show_land_space', 1)): ?>
  <p><strong><?php echo JText::_('COM_JEA_FIELD_LAND_SPACE_LABEL') ?> :</strong></p>
  <dl class="col-left">
    <dt><label for="jea-search-land-space-min<?php echo $uid ?>"><?php echo JText::_('COM_JEA_MIN') ?> : </label></dt>
    <dd><input id="jea-search-land-space-min<?php echo $uid ?>" type="text" name="filter_land_space_min"
               size="5" value="<?php echo $states['filter_land_space_min'] ?>" />
    <?php echo $params->get( 'surface_measure' ) ?></dd>
  </dl>
  <dl class="col-right">
    <dt><label for="jea-search-land-space-max<?php echo $uid ?>"><?php echo JText::_('COM_JEA_MAX') ?> : </label></dt>
    <dd><input id="jea-search-land-space-max<?php echo $uid ?>" type="text" name="filter_land_space_max"
               size="5" value="<?php echo $states['filter_land_space_max'] ?>" />
    <?php echo $params->get( 'surface_measure' ) ?></dd>
  </dl>
<?php endif ?>

<?php if ($showOtherFilters): ?>
  <p><strong><?php echo JText::_('COM_JEA_SEARCH_OTHER') ?> :</strong></p>

  <ul class="jea-search-other">
      <?php if ($params->get('show_number_of_rooms', 1)): ?>
    <li>
      <label for="jea-search-rooms<?php echo $uid ?>"><?php echo JText::_('COM_JEA_NUMBER_OF_ROOMS_MIN') ?> : </label>
      <input id="jea-search-rooms<?php echo $uid ?>" type="text" name="filter_rooms_min"
             size="2" value="<?php echo $states['filter_rooms_min'] ?>" />
    </li>
    <?php endif?>

    <?php if ($params->get('show_number_of_bedrooms', 1)): ?>
    <li>
      <label for="jea-search-bedrooms<?php echo $uid ?>"><?php echo JText::_('COM_JEA_NUMBER_OF_BEDROOMS_MIN') ?> : </label>
      <input id="jea-search-bedrooms<?php echo $uid ?>" type="text" name="filter_bedrooms_min"
             size="2" value="<?php echo $states['filter_bedrooms_min'] ?>" />
    </li>
    <?php endif?>

    <?php if ($params->get('show_number_of_bathrooms', 0)): ?>
    <li>
      <label for="jea-search-bathrooms<?php echo $uid ?>"><?php echo JText::_('COM_JEA_NUMBER_OF_BATHROOMS_MIN') ?> : </label>
      <input id="jea-search-bathrooms<?php echo $uid ?>" type="text" name="filter_bathrooms_min"
             size="2" value="<?php echo $states['filter_bathrooms_min'] ?>" />
    </li>
    <?php endif?>

    <?php if ($params->get('show_floor', 1)): ?>
    <li>
      <label for="jea-search-floor<?php echo $uid ?>"><?php echo JText::_('COM_JEA_FIELD_FLOOR_LABEL') ?> : </label>
      <input id="jea-search-floor<?php echo $uid ?>" type="text" name="filter_floor" size="2" value="<?php echo $states['filter_floor'] ?>" />
      <em><?php echo JText::_('COM_JEA_SEARCH_FLOOR_DESC') ?></em>
    </li>
    <?php endif?>

    <?php if ($params->get('show_hotwatertypes', 0)): ?>
    <li><?php echo JHtml::_('features.hotwatertypes', $states['filter_hotwatertype'], 'filter_hotwatertype', array('id' => 'hotwatertype'.$uid ) ) ?></li>
    <?php endif?>

    <?php if ($params->get('show_heatingtypes', 0)): ?>
    <li><?php echo JHtml::_('features.heatingtypes', $states['filter_heatingtype'], 'filter_heatingtype', array('id' => 'heatingtype'.$uid ) ) ?></li>
    <?php endif?>

    <?php if ($params->get('show_conditions', 0)): ?>
    <li><?php echo JHtml::_('features.conditions', $states['filter_condition'], 'filter_condition', array('id' => 'condition'.$uid ) ) ?></li>
    <?php endif?>

    <?php if ($params->get('show_orientation', 1)): ?>
    <li>
    <?php
        $options = array(
            JHTML::_('select.option', '0',  ' - ' . JText::_('COM_JEA_FIELD_ORIENTATION_LABEL') . ' - ' ),
            JHTML::_('select.option', 'N',  JText::_('COM_JEA_OPTION_NORTH')),
            JHTML::_('select.option', 'NW', JText::_('COM_JEA_OPTION_NORTH_WEST')),
            JHTML::_('select.option', 'NE', JText::_('COM_JEA_OPTION_NORTH_EAST')),
            JHTML::_('select.option', 'NS', JText::_('COM_JEA_OPTION_NORTH_SOUTH')),
            JHTML::_('select.option', 'E',  JText::_('COM_JEA_OPTION_EAST')),
            JHTML::_('select.option', 'EW',  JText::_('COM_JEA_OPTION_EAST_WEST')),
            JHTML::_('select.option', 'W',  JText::_('COM_JEA_OPTION_WEST')),
            JHTML::_('select.option', 'S',  JText::_('COM_JEA_OPTION_SOUTH')),
            JHTML::_('select.option', 'SW', JText::_('COM_JEA_OPTION_SOUTH_WEST')),
            JHTML::_('select.option', 'SE', JText::_('COM_JEA_OPTION_SOUTH_EAST'))
        );
        echo JHTML::_('select.genericlist', $options, 'filter_orientation', 'size="1"', 'value', 'text',  $states['filter_orientation'], array('id' => 'filter_orientation'.$uid))
    ?>
    </li>
    <?php endif?>
  </ul>
<?php endif ?>

<?php if ($params->get('show_amenities', 1)): ?>
  <p><strong><?php echo JText::_('COM_JEA_AMENITIES') ?> :</strong></p>
  <div class="amenities">
    <?php echo JHtml::_('amenities.checkboxes', $states['filter_amenities'], 'filter_amenities', $uid ) ?>
    <?php // In order to prevent nul post for this field ?>
    <input type="hidden" name="filter_amenities[]" value="0" />
  </div>
<?php endif ?>

<?php if ($useAjax): ?>
  <p class="jea-counter"><span class="jea-counter-result">0</span> <?php echo JText::_('COM_JEA_FOUND_PROPERTIES')?></p>
<?php endif ?>

  <p>
    <input type="reset" class="button" value="<?php echo JText::_('JSEARCH_FILTER_CLEAR') ?>" />
    <input type="submit" class="button" value="<?php echo $useAjax ? JText::_('COM_JEA_LIST_PROPERTIES') : JText::_('JSEARCH_FILTER_SUBMIT')?>" />
  </p>

</form>
