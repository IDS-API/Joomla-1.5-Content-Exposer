<?php
/**
 * Joomla! 1.5 component ids_expose
 *
 * @version $Id: view.html.php 2013-05-28 04:55:13 svn $
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

// Import Joomla! libraries
jimport( 'joomla.application.component.view');
class Ids_exposeViewDefault extends JView {
    function display($tpl = null) {
        parent::display($tpl);
    }
}
?>