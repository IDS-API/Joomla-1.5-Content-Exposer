<?php

error_reporting(0);
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

$cid = JRequest::getVar( 'cid' , array() , '' , 'array' );
JArrayHelper::toInteger($cid);
$cids = implode( ',', $cid );

$source = JRequest::getVar('source');

?>

<div style="font-size:14px;font-weight:bold;"><p>If you have any additional fields that we cannot automatically map to our data, please select one of our fields that matches closest to your content to ensure we understand your data.</p></div>

<?php 
if($source == 'k2' && $this->k2_extra_fields != null){
?>
	<form name="adminForm" id="adminForm" method="post">
		<table width="100%" class="adminlist">
			<thead>
				<tr>
					<th width="25%"></th>
					<th>Map to</th>
					<th>IDS tag/field</th>
				</tr>	
			</thead>

			<?php
				$i = 1;
				foreach ($this->k2_extra_fields as $extra_field) {
			?>
					<tr>
						
						<td align="center"><?php echo JHTML::_('select.genericlist',$this->k2_extra_fields,'mapped_value'.$i,'class="inputbox"' ,'k2_extra_field','field_title'); ?></td>
						<td align="center">---></td>
						<td align="center"><?php echo JHTML::_('select.genericlist',$this->ids_fields,'ids_field'.$i,'class="inputbox"' ,'ids_field','field_title'); ?></td>
					</tr>
			<?php
				$i++;
				}

			?>
	
		</table>
			<input type="hidden" name="items" value="<?php echo $cids;?>" />
			<input type="hidden" name="option" value="com_ids_expose" />
			<input type="hidden" name="task" value="mappedFields" />	
			<input type="hidden" name="view" value="mapping" />
			<input type="hidden" name="source" value="<?php echo $source; ?>" />
	</form>
<?php
}else{
?>
<form name="adminForm" id="adminForm" method="post">
		<table width="100%" class="adminlist">
			<thead>
				<tr>
					<th width="25%"></th>
					<th>Map to</th>
					<th>IDS tag/field</th>
				</tr>	
			</thead>

			<?php
				$i = 1;
				foreach ($this->ids_fields as $ids_field) {
			?>
					<tr>
						<td><input type="text" name="mapped_value<?php echo $i; ?>" size="40" /></td>
						<td align="center">---></td>
						<td align="center"><?php echo JHTML::_('select.genericlist',$this->ids_fields,'ids_field'.$i,'class="inputbox"' ,'ids_field','field_title'); ?></td>
					</tr>
			<?php
				$i++;
				}

			?>
	
		</table>
			<input type="hidden" name="items" value="<?php echo $cids;?>" />
			<input type="hidden" name="option" value="com_ids_expose" />
			<input type="hidden" name="task" value="mappedFields" />	
			<input type="hidden" name="view" value="mapping" />
			<input type="hidden" name="source" value="<?php echo $source; ?>" />
	</form>

<?php
}
?>