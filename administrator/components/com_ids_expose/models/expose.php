<?php

error_reporting(0);
/**
 * @version     1.0.0
 * @package     com_ids_expose
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Emman <eatwa@strathmore.edu> - http://
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

/**
 * Ids_expose model.
 */
class Ids_exposeModelexpose extends JModel
{
	function __construct() {
		parent::__construct();
    }
	
	function getJoomlaArticleCategories(){
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT `id`,`title` FROM `#__categories` WHERE `section` > 0 ORDER BY `title` ASC");
		//$select_categories[] = JHTML::_('select.option', ' ', '- '.JText::_('Select').' -', 'id', 'title');
		$categories = $db->LoadObjectList();
		//$categories = array_merge($select_categories, $categories);

		return $categories;
	}

	function getAuthors(){
		$db =& JFactory::getDBO();
		$query = "SELECT DISTINCT `created_by`,`name` FROM `#__content`,`#__users` WHERE `created_by`=`#__users`.`id` ORDER BY `name` ASC";
		$db->setQuery($query);
		$authors = $db->LoadObjectList();

		return $authors;
		
	}

	function getPreviewExposedContent($result_set){
		return $result_set;
	}

}