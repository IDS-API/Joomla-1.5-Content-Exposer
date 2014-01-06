<?php
/**
 * Joomla! 1.5 component ids_expose
 *
 * @version $Id: ids_expose.php 2013-05-28 04:55:13 svn $
 * @author @iLabAfrica
 * @package Joomla
 * @subpackage ids_expose
 * @license GNU/GPL
 *
 * This component searches the joomla content and exposes it to the IDS data sets
 *
 * This component file was created using the Joomla Component Creator by Not Web Design
 * http://www.notwebdesign.com/joomla_component_creator/
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include library dependencies
jimport('joomla.filter.input');

/**
* Table class
*
* @package          Joomla
* @subpackage		ids_expose
*/
class TableItem extends JTable {

	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;


    /**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__ids_expose', 'id', $db);
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 */
	function check() {
		return true;
	}

}
?>