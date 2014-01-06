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
 * View class for a list of Ids_expose.
 */
class Ids_exposeViewExposes extends JView
{
	

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		
		$this->addToolbar();
        
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{

		JToolBarHelper::title('IDS Knowledge Services Exposer Component', 's_exposes.png');

        JToolBarHelper::addNew('exposeNew','Expose/Export data to IDS');


	}
}
