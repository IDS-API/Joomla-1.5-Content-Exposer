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

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Initialize the controller
$controller = new Ids_exposeController();
$controller->execute( null );

// Redirect if set by the controller
$controller->redirect();
?>