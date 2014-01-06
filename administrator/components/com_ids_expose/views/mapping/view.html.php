<?php
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
class Ids_exposeViewmapping extends JView
{
	
	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{

		$this->joomla_fields = $this->get('JoomlaArticleFields');
		$this->ids_fields = $this->get('IDSFields');
		$this->k2_extra_fields = $this->get('K2ExtraFields');
		
		$this->addToolbar();
		
		parent::display($tpl);
		
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{
		

		$user		= JFactory::getUser();

		JToolBarHelper::title(JText::_('Exposed Data Fields Mapping'), 'expose.png');
	
		JToolBarHelper::save('mappedFields', 'Proceed', 'JTOOLBAR_SAVE');
	
		JToolBarHelper::cancel('cancel', 'Cancel');
		

	}
}
