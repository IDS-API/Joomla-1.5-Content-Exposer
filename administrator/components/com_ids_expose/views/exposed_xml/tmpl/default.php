<?php
/**
 * @version     1.0.0
 * @package     com_movies
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

$document = & JFactory::getDocument();
$document->addScript( JURI::base() . 'components/com_ids_expose/assets/scripts/jquery-1.8.3.min.js');
$document->addScript( JURI::base() . 'components/com_ids_expose/assets/scripts/ajax.js');

$db = JFactory::getDbo();

?>

<div style="font-size:14px;font-weight:bold;">
	<p>Congratulations! You have successfully exposed your data as an XML file for IDS Knowledge Services.</p>
	<p>If email has been configured on your server, an email informing IDS Knowledge Services that your data is available has already been sent.</p>
	<p>If you do not have email sending configured on your server then you will need to send the following url ( <a href="#"><?php echo JURI::root().'exposed_data.xml'; ?></a> ) to <a href="#">eldis@ids.ac.uk</a></p>
</div>
<div style="font-size:16px;font-weight:bold;">
	<p><a href="<?php echo JURI::root().'exposed_data.xml'; ?>" target="_blank">View XML file</a></p>
</div>
<form name="adminForm" id="adminForm" method="post">
	<input type="hidden" name="option" value="com_ids_expose" />
	<input type="hidden" name="task" value="" />	
	<input type="hidden" name="view" value="exposed_xml" />
</form>