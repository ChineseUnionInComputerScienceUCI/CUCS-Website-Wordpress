<?php
/**
 * Register Client menu in admin area.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Add Clients Menu to Admin
---------------------------------------------------------------------------------- */
function thinkup_register_clientpost() {
	$labels = array(
		'name'               => _x( 'Clients', 'post type general name', 'ryan' ),
		'singular_name'      => _x( 'Client', 'post type singular name', 'ryan' ),
		'add_new'            => _x( 'Add New', 'client', 'ryan' ),
		'add_new_item'       => __( 'Add New Client', 'ryan' ),
		'edit_item'          => __( 'Edit Client', 'ryan' ),
		'new_item'           => __( 'New Client', 'ryan' ),
		'view_item'          => __( 'View Client', 'ryan' ),
		'search_items'       => __( 'Search Clients', 'ryan' ),
		'not_found'          => __( 'No clients found', 'ryan' ),
		'not_found_in_trash' => __( 'No clients found in Trash', 'ryan' ),
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Clients', 'ryan' ),
	);
	  
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'clients' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies'         => array('category'),
		'menu_icon'          => 'dashicons-businessman'
	);

	/* Register Client menu */
	register_post_type( 'client', $args );


	/* Fixes redirect to 404 error template */
	flush_rewrite_rules();
}
add_action('init', 'thinkup_register_clientpost');
	

/* ----------------------------------------------------------------------------------
	Custom Client Messages
---------------------------------------------------------------------------------- */
function thinkup_register_clientmessages( $messages ) {
global $post, $post_ID;

	$messages[ 'client' ] = array(
		0 => '',
		1 => sprintf( 'Client updated. <a href="%s">View client</a>', esc_url( get_permalink( $post_ID ) ) ),
		2 => 'Custom field updated.',
		3 => 'Custom field deleted.',
		4 => 'Client updated.',
		5 => isset($_GET[ 'revision' ]) ? sprintf( 'Client restored to revision from %s', wp_post_revision_title( (int) 

$_GET[ 'revision' ], false ) ) : false,
		6 => sprintf( 'Client published. <a href="%s">View client</a>', esc_url( get_permalink( $post_ID ) ) ),
		7 => 'Client saved.',
		8 => sprintf( 'Client submitted. <a target="_blank" href="%s">Preview client</a>', esc_url( add_query_arg( 'preview', 

'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( 'Client scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview client</a>',
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( 'Client draft updated. <a target="_blank" href="%s">Preview client</a>', esc_url( add_query_arg( 'preview', 

'true', get_permalink( $post_ID ) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'thinkup_register_clientmessages' );