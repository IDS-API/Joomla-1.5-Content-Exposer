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

$db = JFactory::getDbo();

$source = $this->preview_data['source'];
array_pop($this->preview_data);
?>

<div style="font-size:14px;font-weight:bold;"><p>Your filtering has produced the following results. Please deselect any articles that you do not want to expose.</p></div>

<form name="adminForm" id="adminForm" method="post" action="index.php?option=com_ids_expose&view=mapping">
		<table width="100%" class="adminlist">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox" name="toggle" value="" checked onclick="checkAll(<?php echo count($this->preview_data); ?>);" /></th>
					<th>Title</th>
					<th>Date Created</th>
					<th>Date By</th>
					<th>Category</th>
					<th>Description</th>
				</tr>	
			</thead>
			<?php
			$k = 0;
			for ($i=0, $n=count( $this->preview_data ); $i < $n; $i++)	{ 
				$preview_data = &$this->preview_data[$i];
				$checked = JHTML::_('grid.id',   $i, $preview_data->id );
				$created_by = JFactory::getUser($preview_data->created_by);

				//get category
				if($source == 'k2'){
					$db->setQuery("SELECT `name` FROM `#__k2_categories` WHERE `id`=$preview_data->catid");
				}else{
					$db->setQuery("SELECT `title` FROM `#__categories` WHERE `id`=$preview_data->catid");
				}
				
				$cat = $db->loadResult();

			?>
			<tr>
				<td><?php echo $checked; ?></td>
				<td>
					<a href="index.php?option=com_content&view=article&id=<?php echo $preview_data->id; ?>" target="_blank"><?php echo $preview_data->title; ?></a>
				</td>
				<td><?php echo $preview_data->created; ?></td>
				<td><?php echo $created_by->name; ?></td>
				<td><?php echo $cat; ?></td>
				<td><?php echo ''; ?></td>
			</tr>
		  <?php
		  $k = 1 - $k;
		  }
		  ?>
	
		</table>
			<input type="hidden" name="option" value="com_ids_expose" />
			<input type="hidden" name="task" value="" />	
			<input type="hidden" name="source" value="<?php echo $source; ?>" />
	</form>

<script type="text/javascript">
	jQuery(document).ready(function () {
         var checked = jQuery(this).is(':checked');            
        jQuery('input[name^=cid]').each(function () {
            var checkBox = jQuery(this);               
            checkBox.prop('checked', true);                
        });

	});
</script>