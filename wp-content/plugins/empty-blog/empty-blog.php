<?php
/*
Plugin Name: Empty Blog
Plugin URI: http://daryl.learnhouston.com/wordpress/empty-blog/
Description: Empty your blog of posts (you pick which types), tags, and categories.
Version: 0.8
Author: Daryl L. L. Houston
Author URI: http://daryl.learnhouston.com/
License: GPL2
*/

/*  Copyright 2011  Daryl L. L. Houston  (email : daryl@learnhouston.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// TODO: Should you be able to delete tags/cats if no post types selected?
// TODO: More granular cap checks?
// TODO: Is it worth any overhead to echo the post title when deleting?
// TODO: CSS file rather than inline styling?

add_action( 'admin_menu', 'empty_blog_menu' );
add_action( 'admin_enqueue_scripts', 'empty_blog_admin_scripts' );

function empty_blog_menu() {
	add_management_page( __( 'Empty Blog' ), __( 'Empty Blog' ), 'manage_options', 'empty-blog-id', 'empty_blog_options' );
}

function empty_blog_admin_scripts() {
	wp_register_script( 'empty-blog', plugins_url( '/empty-blog/empty-blog.js' ) );
	wp_enqueue_script( 'empty-blog', null, array( 'jquery' ) );
}

function empty_blog_options() {

	// Check that the user can manage options.
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	// Now do the deletion.
	if ( isset( $_POST['empty'] ) ) {
		// Check the nonce
		$nonce = $_REQUEST['_wpnonce'];
		if ( !wp_verify_nonce( $nonce, 'empty-blog' ) ) {
			wp_die( __( "Oops, you can't do that." ) );
		}

		// Delete posts
		echo "<h3>" . __( 'Deleting content' ) . "</h3>\n";

		$options = array(
			'numberposts'     => 50,
			'offset'          => 0,
			'orderby'         => 'post_date',
			'order'           => 'DESC',
			'post_type'       => 'post',
		);

		$statuses = array ( 'publish', 'draft', 'trash', 'inherit' );
		$post_types = array();

		$valid_types = get_post_types( '', 'names' );
		if ( isset( $_POST['post_types'] ) && is_array( $_POST['post_types'] ) ) {
			foreach ( $_POST['post_types'] as $type ) {
				if ( in_array( $type, $valid_types ) ) {
					$post_types[] = $type;
				}
			}
		}

		foreach( $post_types as $type ) {
			printf( __( "Deleting posts of type <em>%s</em>.<br />" ), $type );
			foreach( $statuses as $status ) {
				$options['post_type'] = $type;
				$options['post_status'] = $status;
				delete_posts( $options );
			}
		}

		// Delete categories
		if ( isset( $_POST['delete_categories'] ) && 1 == $_POST['delete_categories'] ) {
			print "<h3>" . __( "Deleting categories." ) . "</h3>\n";
			$cats = get_terms('category', array ('hide_empty' => 0,'fields' => 'ids',) );
			foreach( $cats as $cat ) {
				$cat_name = get_cat_name( $cat );
				wp_delete_category( $cat );
				print __( "Category" ) . ": $cat_name<br />";
			}
		}

		// Tags
		if ( isset( $_POST['delete_tags'] ) && 1 == $_POST['delete_tags'] ) {
			print "<h3>" . __( "Deleting tags." ) . "</h3>\n";
			$tags = get_terms( 'post_tag', array( 'hide_empty' => false, 'fields' => 'all' ) );
			if ( $tags ) {
				foreach ( $tags as $tag ) {
					print __( "Tag" ) . ": $tag->name<br />";
					wp_delete_term( $tag->term_id, 'post_tag' );
				}
			}
		}
		
		// Links
		if ( isset( $_POST['delete_links'] ) && 1 == $_POST['delete_links'] ) {
			print "<h3>" . __( "Deleting links." ) . "</h3>\n";
			$links = get_bookmarks();
			foreach ( $links as $link ) {
				print __( "Link" ) . ": <a href='" . $link->link_url . "'>" . $link->link_name . "</a><br />";
				wp_delete_link( $link->link_id );
			}
			$link_cats = get_terms( 'link_category', array( 'hide_empty' => 0 ) );
			foreach ( $link_cats as $cat ) {
				print sprintf( __( "Link category: %s" ), $cat->name ) . "<br />";
				wp_delete_term( $cat->term_id, 'link_category' );
			}
		}		
		_e( "Blog empty completed." );
	}
	else {
?>
		<style type="text/css">
			div.empty_blog_field{ padding-bottom: 8px; }
			div#empty_blog_controls p.warn {
				border: 1px solid #000;
				padding: 8px;
				width: 60%;
				background-color: #FABECD;
				color: #000;
				font-size: 1.3em;
				line-height: 170%;
				border-radius: 6px 6px 6px 6px;
			}
			div.empty_blog_field_group {
				border: 1px solid #bbb;
				padding: 10px;
				margin-bottom: 8px;
				border-radius: 6px 6px 6px 6px;
				width: 60%;
			}
		</style>
		<div id="empty_blog_controls">
		<h2><?php _e( 'Empty Blog' ); ?></h2>
		<p class="warn"><?php _e( "Pushing the button below will <strong>irretrievably empty your blog</strong> of pages, posts, attachments, comments, categories, and tags. Don't push it unless you really mean it!" ); ?></p>
		<form method="post" onsubmit="return confirm( '<?php esc_attr_e( 'Are you sure?' ); ?>' )">
		<?php wp_nonce_field( 'empty-blog' ); ?>
		<div class="empty_blog_field_group">
			<p><?php _e( 'Select the post types you wish to delete. Then check whether you would like to delete tags and categories.' ); ?></p>	
			<div><input type="checkbox" id="empty_blog_select_all_post_types" value="1" /> <label for="empty_blog_select_all_post_types"><strong><?php _e( 'Select all post types' ); ?></strong></label></div>
			<?php 
			foreach ( get_post_types( '', 'objects' ) as $type  )
				print "<input name='post_types[]' type='checkbox' class='post_type' value='" . esc_attr( $type->name ) . "' /> " . $type->label . "<br />"
			?>
		</div>
		<div class="empty_blog_field"><input type="checkbox" id="delete_tags" name="delete_tags" value="1" /> <label for="delete_tags"><?php _e( 'Delete Tags' ); ?></label></div>
		<div class="empty_blog_field"><input type="checkbox" id="delete_categories" name="delete_categories" value="1" /> <label for="delete_categories"><?php _e( 'Delete Categories' ); ?></label></div>
		<div class="empty_blog_field"><input type="checkbox" id="delete_links" name="delete_links" value="1" /> <label for="delete_links"><?php _e( 'Delete Links' ); ?></label></div>
		<div class="empty_blog_field"><input type="submit" id="empty" name="empty" value="<?php esc_attr_e( 'Empty Blog' ); ?>" /></div>
		</form>
		</div> <!-- empty_blog_controls -->
<?php
	}
}

function delete_posts( $options ) {
	$posts = get_posts( $options );
	$offset = 0;
	while( count( $posts ) > 0 ) {
		if( $offset == 10 ) {
			echo "Bailing<br />\n";
			break;
		}
		$offset++;

		echo "<h3>Cycle $offset</h3>\n";	
		foreach( $posts as $post ) {
			print "Post ID: {$post->ID}<br />\n";
			wp_delete_post( $post->ID, true );
		}	
		$posts = get_posts( $options );
	}
}

?>
