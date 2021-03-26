// Add button into Elementor system
jQuery( document ).ready(function($) {
	$('#elementor-preview-iframe').load(function(){
		if(!ELUCached){ var ELUCached = null; }
        if(!insertIndex){ var insertIndex = null; }
        var refreshId = setInterval( function(){
			// If menu exists then continue
			if( $('#elementor-template-library-header-menu').length){
				if(!$('#wpkoi-templates-for-elementor-get-more').length){
				/* Add Button */
				$('#elementor-template-library-header-menu').append("<div id='wpkoi-templates-for-elementor-get-more' class='elementor-template-library-menu-item'><a href='https://wpkoi.com/wpkoi-templates-for-elementor' target='_blank'>More WPKoi templates!</a></div>");
				} /* Modal not open */
			} /* Library tab already exists */
		}, 250); 
	});
});