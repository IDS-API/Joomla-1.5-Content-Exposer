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

/*
 * Define constants for all pages
 */
define( 'COM_IDS_EXPOSE_DIR', 'images'.DS.'ids_expose'.DS );
define( 'COM_IDS_EXPOSE_BASE', JPATH_ROOT.DS.COM_IDS_EXPOSE_DIR );
define( 'COM_IDS_EXPOSE_BASEURL', JURI::root().str_replace( DS, '/', COM_IDS_EXPOSE_DIR ));

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Require the base controller
require_once JPATH_COMPONENT.DS.'helpers'.DS.'helper.php';

// Initialize the controller
$controller = new Ids_exposeController( );

// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();
?>