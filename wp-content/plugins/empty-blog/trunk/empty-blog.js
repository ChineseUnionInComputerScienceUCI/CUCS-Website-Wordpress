jQuery(document).ready( function () {
	jQuery( '#empty_blog_select_all_post_types' ).click( function() {
		jQuery( '.post_type' ).attr( 'checked', this.checked );
	} );
} );
