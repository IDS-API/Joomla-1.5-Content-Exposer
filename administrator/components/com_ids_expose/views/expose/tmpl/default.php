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

$id = JRequest::getVar('id');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			Joomla.submitform(task, document.getElementById('item-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('Please Fill in the required fields'));?>');
		}
	}
</script>

		<form action="index.php?option=com_ids_expose&view=exposed_data" method="post" name="adminForm" id="item-form" class="form-validate" enctype="multipart/form-data">
			<div class="width-60 fltlft">
				<fieldset>
					<legend>Search Settings:</legend>
							<table width="100%">
								<tr>
									<td width="30%">
										<img src="components/com_ids_expose/assets/images/tooltip.png" title="This is the number of items that you want to expose in one output" />
										<b>Search limit:</b>
									</td>
									<td><input type="text" name="search_limit" id="search_limit"  value="50"/></td>
								</tr>
								<tr>
									<td>
										<img src="components/com_ids_expose/assets/images/tooltip.png" title="This allows you to select whether you want to expose content that is already published in your Joomla site" />
										<b>Search published:</b>
									</td>
									<td width="">
										<select name="published">
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
									</td>
								</tr>
							</table>
		       
				</fieldset>
				<fieldset>
					<legend>Filtering from your Joomla database:</legend>
							<table width="100%">
								<tr>
									<td width="30%">
										<img src="components/com_ids_expose/assets/images/tooltip.png" title="This allows you to select the content type you want to expose e.g. Joomla Article, K2 Content type" />
										<b>Select Asset Source:</b>
									</td>
									<td>
										<select name="source" id="source">
											<option value="article">Article</option>
			                                 <option value="k2">K2 Content</option>
			                                 <option value="docman">Docman Module</option>
			                            </select>
									</td>
								</tr>
								<tr>
									<td>
										<img src="components/com_ids_expose/assets/images/tooltip.png" title="This allows you to select the Joomla category for your content type e.g. Articles" />
										<b>Content Category:</b></td>
									<td width="">
										<?php echo JHTML::_('select.genericlist',  $this->article_categories, 'category', 'class="inputbox"', 'id', 'title', ''); ?> 
										<div id="load_categories"></div>
									</td>
								</tr>
								<tr>
									<td>
										<img src="components/com_ids_expose/assets/images/tooltip.png" title="This allows you to select a specific author of content to expose" />
										<b>Author:</b>
									</td>
									<td>
										<?php echo JHTML::_('select.genericlist',  $this->authors, 'author', 'class="inputbox"', 'created_by', 'name', ''); ?>
										<div id="load_authors"></div>
									</td>
								</tr>
								<tr>
									<td>
										<img src="components/com_ids_expose/assets/images/tooltip.png" title="This allows you to present the results in ascending or descending order" />
										<b>Sort order of results:</b>
									</td>
									<td width="">
										<select name="order">
											<option value="ASC">Ascending</option>
											<option value="DESC">Descending</option>
										</select>
									</td>
								</tr>
							</table>
		       
				</fieldset>
				<fieldset>
					<legend>Expose Frequency:</legend>
							<table width="100%">
								<tr>
									<td width="30%">
										<img src="components/com_ids_expose/assets/images/tooltip.png" title="This allows you to select the number of days that you refresh the output" />
										<b>Frequency:</b></td>
									<td>
										<input type="text" name="frequency" id="frequency"  value="7"/>
									</td>
								</tr>
							</table>
		       
				</fieldset>
				<fieldset>
					<legend></legend>
							<table width="100%">
								<tr>
									
									<td>
										<!-- <input type="submit" name="submit" id="submit" value="SUBMIT" style="width:150px;height:50px;"/> -->
										<button style="width:150px;height:50px;">SUBMIT</button>
									</td>
								</tr>
							</table>
		       
				</fieldset>
			</div>

			<input type="hidden" name="option" value="com_ids_expose" />
			<input type="hidden" name="task" value="" />	
			<!-- <input type="hidden" name="view" value="expose" /> -->
			<?php echo JHtml::_('form.token'); ?>
			<div class="clr"></div>
		</form>

