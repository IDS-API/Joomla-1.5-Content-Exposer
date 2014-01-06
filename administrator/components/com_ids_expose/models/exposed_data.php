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
class Ids_exposeModelexposed_data extends JModel
{
	function __construct() {
		parent::__construct();
    }
	
	function getPreviewExposedContent(){
		$params = JRequest::get('post');
		$db =& JFactory::getDBO();
		
		$search_limit = $params['search_limit'];
		$published = $params['published'];
		$source = $params['source'];
		$category = $params['category'];
		$author = $params['author'];
		$order = $params['order'];
		$frequency = $params['frequency'];

		switch ($source) {
		    case "article":
		    	if($published == 0){
		    		$query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__content` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `state`=0
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}else{
		    		$query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__content` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `state`=1
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}
		        
		        break;
		    case "k2":
		        if($published == 0){
		    		$query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__k2_items` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `published`=0
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}else{
		    		$query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__k2_items` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `published`=1
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}

		        break;
		    case "docman":
		        if($published == 0){
		    		$query = "SELECT `id`,`dmname` as title,`dmdescription` as introtext,`catid`,`dmdate_published` as created,`dmsubmitedby` as created_by,`dmlastupdateon` as modified
		        		  FROM `#__docman` 
		        		  WHERE `catid`='$category' AND `published`=0
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}else{
		    		$query = "SELECT `id`,`dmname` as title,`dmdescription` as introtext,`catid`,`dmdate_published` as created,`dmsubmitedby` as created_by,`dmlastupdateon` as modified
		        		  FROM `#__docman` 
		        		  WHERE `catid`='$category' AND `published`=1
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}

		        break;
		    default:
		       $query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__content` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `state`=1
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		}
		
		$db->setQuery($query);
		$result_set = $db->LoadObjectList();

		$domain = JURI::base();
		foreach ($result_set as $asset) {
			$asset->introtext = str_replace('<img src="images/', '<img src="'.$domain.'/images/', $asset->introtext);
		}

		$source = array('source' => $source);

		$result_set = array_merge($result_set, $source);

		return $result_set;
	}

}