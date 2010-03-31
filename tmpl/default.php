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

// no direct access
defined('_JEXEC') or die('Restricted access');

$use_ajax = $params->get('use_ajax', 0);
$document =& JFactory::getDocument();
$document->addStyleDeclaration("
	#jea_search_form select {
		width:12em;
	}");

if ($use_ajax ) {
	JHTML::script('search.js', 'media/com_jea/js/', true);
	
	//initialize the form when the page load
	$document->addScriptDeclaration("
		window.addEvent('domready', function() {
			refreshForm(); 
		});");
}

?>

<form action="index.php?option=com_jea&amp;task=search" method="post" id="jea_search_form" enctype="application/x-www-form-urlencoded" >

	<p>
    <input type="radio" name="cat" id="renting" value="renting" checked="checked" <?php echo $use_ajax ? 'onclick="refreshForm()"' : '' ?> />
    <label for="renting"><?php echo JText::_('Renting') ?></label>
    <input type="radio" name="cat" id="selling" value="selling" <?php echo $use_ajax ? 'onclick="refreshForm()"' : '' ?> />
    <label for="selling"><?php echo JText::_('Selling') ?></label>
    </p>
    
<?php if ( $use_ajax ): ?>
    <p>
    <select id="type_id" name="type_id" onchange="updateList(this)" class="inputbox"><option value="0"> </option></select>
    <select id="department_id"  name="department_id" onchange="updateList(this)" class="inputbox" ><option value="0"> </option></select>
    <select id="town_id" name="town_id" onchange="updateList(this)" class="inputbox"><option value="0"> </option></select>
    </p>
    
<?php else: ?> 

   	<p>
	<?php echo getHtmlList('#__jea_types', '--'.JText::_( 'Property type' ).'--', 'type_id' ) ?>
	<?php echo getHtmlList('#__jea_departments', '--'.JText::_( 'Department' ).'--', 'department_id' ) ?>
  	<?php echo getHtmlList('#__jea_towns', '--'.JText::_( 'Town' ).'--', 'town_id' ) ?>
  	</p>
  	
<?php endif ?>
  	<p><input type="submit" class="button" value="<?php echo JText::_('Search') ?>" />
    <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
    <?php echo JHTML::_( 'form.token' ) // Do not remove this ?>
    </p>
</form>
