<?php
error_reporting(0);
/**
 * @version     1.0.0
 * @package     com_ids_expose
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Emman <eatwa@strathmore.edu> - http://
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to edit
 */
class Ids_exposeViewExpose extends JView
{
	
	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
	
		$this->article_categories = $this->get('JoomlaArticleCategories');
		$this->authors = $this->get('Authors');
		$this->preview_data = $this->get('PreviewExposedContent');
		
		$this->addToolbar();
		
		parent::display($tpl);
		
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{
		

		$user		= JFactory::getUser();

		JToolBarHelper::title(JText::_('Follow these few simple steps to filter the content you want to expose to IDS'), 'expose.png');

		
		//JToolBarHelper::save('expose', 'JTOOLBAR_SAVE');
	
		JToolBarHelper::cancel('cancel', 'Cancel');
		

	}
}
