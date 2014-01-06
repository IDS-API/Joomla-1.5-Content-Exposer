jQuery.noConflict();

/* START Load categories and authors */

jQuery(function() {
	jQuery('#source').change(function() {
		var source = jQuery(this).val();

		var k2_authors = '';
		var joomla_authors = '';
		var k2_categories = '';
		var joomla_categories = '';
		var docman_categories = '';

		if (source == 'k2') {
			jQuery('#load_authors').append('<img src="components/com_ids_expose/assets/images/loading.gif" title="Loading" id="loading" />');
		 	jQuery.get("index.php?option=com_ids_expose&task=getK2Authors&format=raw", function(k2_authors){
				jQuery('#author').empty().html(k2_authors);
				jQuery('#loading').fadeOut(500, function() {
					jQuery(this).remove();
				});
		    });

		    jQuery('#load_categories').append('<img src="components/com_ids_expose/assets/images/loading.gif" title="Loading" id="categories_loading" />');
		 	jQuery.get("index.php?option=com_ids_expose&task=getK2Categories&format=raw", function(k2_categories){
				jQuery('#category').empty().html(k2_categories);
				jQuery('#categories_loading').fadeOut(500, function() {
					jQuery(this).remove();
				});
		    });

		    jQuery('#author_tr').show();

		}else if(source == 'docman'){
			jQuery('#load_categories').append('<img src="components/com_ids_expose/assets/images/loading.gif" title="Loading" id="docman_categories_loading" />');
		 	jQuery.get("index.php?option=com_ids_expose&task=getDocmanCategories&format=raw", function(docman_categories){
				jQuery('#category').empty().html(docman_categories);
				jQuery('#docman_categories_loading').fadeOut(500, function() {
					jQuery(this).remove();
				});
		    });

		    jQuery('#author_tr').hide();
		
		} else{
			jQuery('#load_authors').append('<img src="components/com_ids_expose/assets/images/loading.gif" title="Loading" id="loading" />');
			jQuery.get("index.php?option=com_ids_expose&task=getJoomlaAuthors&format=raw", function(joomla_authors){
				jQuery('#author').empty().html(joomla_authors);
				jQuery('#loading').fadeOut(500, function() {
					jQuery(this).remove();
				});
		    });

		    jQuery('#load_categories').append('<img src="components/com_ids_expose/assets/images/loading.gif" title="Loading" id="categories_loading" />');
			jQuery.get("index.php?option=com_ids_expose&task=getJoomlaCategories&format=raw", function(joomla_categories){
				jQuery('#category').empty().html(joomla_categories);
				jQuery('#categories_loading').fadeOut(500, function() {
					jQuery(this).remove();
				});
		    });

		    jQuery('#author_tr').show();
			
		};
	});
});

/* END Load categories and authors */