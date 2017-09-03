
jQuery(function($){
	var selection = false;
	var thinkupshortcodesShortcodePanel = $('#thinkupshortcodes-shortcode-panel-tmpl').html();

	$('body').append(thinkupshortcodesShortcodePanel);
	$('.media-modal-backdrop, .media-modal-close').on('click', function(){
		thinkupshortcodes_hideModal();
	})
	$(document).keyup(function(e) {
		if (e.keyCode == 27) {
			thinkupshortcodes_hideModal();
		}
	});

	// show modal
	$('#thinkupshortcodes-shortcodeinsert').click(function(){

		if($(this).data('shortcode')){
			window.send_to_editor('['+$(this).data('shortcode')+']');
			return;
		}
				
		// autoload item
		var autoload = $('.thinkupshortcodes-autoload');
		if(autoload.length){
			thinkupshortcodes_loadtemplate(autoload.data('shortcode'));
		}
		$('#thinkupshortcodes-category-selector').on('change', function(){
			thinkupshortcodes_loadtemplate('');
			$('.thinkupshortcodes-elements-selector').hide();
			$('#thinkupshortcodes-elements-selector-'+this.value).show().val('');
		});

		$('.thinkupshortcodes-elements-selector').on('change', function(){
			thinkupshortcodes_loadtemplate(this.value);
		});

		if(typeof tinyMCE !== 'undefined'){
			if(tinyMCE.activeEditor !== null){
				selection = tinyMCE.activeEditor.selection.getContent();
			}else{
				selection = false;
			}
		}else{
			selection = false;
		}
		if(selection.length > 0){
			$('#thinkupshortcodes-content').html(selection);
		}
		$('#thinkupshortcodes-shortcode-panel').show();
	});
	$('#thinkupshortcodes-insert-shortcode').on('click', function(){
		thinkupshortcodes_sendCode();
	})
	// modal tabs
	$('#thinkupshortcodes-shortcode-config').on('click', '.thinkupshortcodes-shortcode-config-nav li a', function(){
		$('.thinkupshortcodes-shortcode-config-nav li').removeClass('current');
		$('.group').hide();
		$(''+$(this).attr('href')+'').show();
		$(this).parent().addClass('current');
		return false;
	});


});

function thinkupshortcodes_loadtemplate(shortcode){
	var target = jQuery('#thinkupshortcodes-shortcode-config');
	if(shortcode.length <= 0){
		target.html('');
	}
	target.html(jQuery('#thinkupshortcodes-'+shortcode+'-config-tmpl').html());
}

function thinkupshortcodes_sendCode(){

	var shortcode = jQuery('#thinkupshortcodes-shortcodekey').val(),
		output = '['+shortcode,
		ctype = '',
		fields = {};
	
	if(shortcode.length <= 0){return; }

	if(jQuery('#thinkupshortcodes-shortcodetype').val() === '2'){
		ctype = jQuery('#thinkupshortcodes-default-content').val()+'[/'+shortcode+']';
	}
	jQuery('#thinkupshortcodes-shortcode-config input,#thinkupshortcodes-shortcode-config select,#thinkupshortcodes-shortcode-config textarea').not('.configexclude').each(function(){
		if(this.value){
			// see if its a checkbox
			var thisinput = jQuery(this),
				attname = this.name;

			if(thisinput.prop('type') == 'checkbox'){
				if(!thisinput.prop('checked')){
					return;
				}
			}
			if(thisinput.prop('type') == 'radio'){
				if(!thisinput.prop('checked')){
					return;
				}
			}

			if(attname.indexOf('[') > -1){
				attname = attname.split('[')[0];
				var newloop = {};
				newloop[attname] = this.value;
				if(!fields[attname]){
					fields[attname] = [];
				}
				fields[attname].push(newloop);
			}else{
				var newfield = {};
				fields[attname] = this.value;
			}
		}
	});
	for( var field in fields){
		if(typeof fields[field] == 'object'){
			for(i=0;i<fields[field].length; i++){
				output += ' '+field+'_'+(i+1)+'="'+fields[field][i][field]+'"';
			}
		}else{
			output += ' '+field+'="'+fields[field]+'"';
		}
	}
	thinkupshortcodes_hideModal();
	window.send_to_editor(output+']'+ctype);

}
function thinkupshortcodes_hideModal(){
	jQuery('#thinkupshortcodes-shortcode-panel').hide();
	thinkupshortcodes_loadtemplate('');
	jQuery('#thinkupshortcodes-elements-selector').show();
	jQuery('.thinkupshortcodes-elements-selector').val('');	
	jQuery('#thinkupshortcodes-category-selector').val('');
}
