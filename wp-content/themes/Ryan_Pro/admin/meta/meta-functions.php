<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'thinkup_input_meta' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function thinkup_input_meta( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_thinkup_';

	$meta_boxes[] = array(
		'id'         => 'thinkup_productsettings',
		'title'      => 'ThinkUpThemes.com - Product Options',
		'pages'      => array( 'product' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Meta Content',
				'desc' => 'Choose which meta content to display on this product page.',
				'id' => $prefix . 'meta_woocommercecontentcheckproduct',
				'type' => 'multicheck',
				'options' => array(
					'option1' => 'Default (overrides below options)',
					'option2' => 'Enable likes.',
//					'option3' => 'Enable social sharing.',
				)
			),
			array(
				'name' => 'Variation Style',
				'desc' => 'Choose a variation style.',
				'id'   => $prefix . 'meta_woocommercevariation',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default',  'value' => 'option1', true ),
					array( 'name' => 'Dropdown', 'value' => 'option2', true ),
					array( 'name' => 'Buttons',  'value' => 'option3', true ),
				),
			),
			array(
				'name' => 'Hide Variation Title',
				'desc' => 'Check to hide variation titles.',
				'id'   => $prefix . 'meta_woocommercevariationtitle',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default',  'value' => 'option1', true ),
					array( 'name' => 'Show', 'value' => 'option2', true ),
					array( 'name' => 'Hide',  'value' => 'option3', true ),
				),
			),
			array(
				'name' => 'Hide SKU ID',
				'desc' => 'Check to hide SKU ID.',
				'id'   => $prefix . 'meta_woocommerceskuswitch',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default',  'value' => 'option1', true ),
					array( 'name' => 'Show', 'value' => 'option2', true ),
					array( 'name' => 'Hide',  'value' => 'option3', true ),
				),
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_teaminfo',
		'title'      => 'ThinkUpThemes.com - Team Options',
		'pages'      => array( 'team' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Position in Company',
				'desc' => 'Add your position in the company. Will display on main team page.',
				'id'   => $prefix . 'meta_teamposition',
				'type' => 'text',
			),
			array(
				'name' => 'Email Address',
				'desc' => 'Add your email address so visitors can send a message. Will display on main team page.',
				'id'   => $prefix . 'meta_teamemail',
				'type' => 'text',
			),
			array(
				'name' => 'Facebook',
				'desc' => 'Add link to facebook profile page.',
				'id'   => $prefix . 'meta_teamfacebook',
				'type' => 'text',
			),
			array(
				'name' => 'Twitter',
				'desc' => 'Add link to Twitter profile page.',
				'id'   => $prefix . 'meta_teamtwitter',
				'type' => 'text',
			),
			array(
				'name' => 'Google+',
				'desc' => 'Add Link to Google+ profile page.',
				'id'   => $prefix . 'meta_teamgoogle',
				'type' => 'text',
			),
			array(
				'name' => 'LinkedIn',
				'desc' => 'Add link to LinkedIn profile page.',
				'id'   => $prefix . 'meta_teamlinkedin',
				'type' => 'text',
			),
			array(
				'name' => 'Instagram',
				'desc' => 'Add link to Instagram profile page.',
				'id'   => $prefix . 'meta_teaminstagram',
				'type' => 'text',
			),
			array(
				'name' => 'Dribbble',
				'desc' => 'Add link to Dribbble profile page.',
				'id'   => $prefix . 'meta_teamdribbble',
				'type' => 'text',
			),
			array(
				'name' => 'Flickr',
				'desc' => 'Add link to Flickr profile page.',
				'id'   => $prefix . 'meta_teamflickr',
				'type' => 'text',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_teamsettings',
		'title'      => 'ThinkUpThemes.com - Team Page Settings',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Team Style',
				'desc' => 'Choose a style for this team page.',
				'id' => $prefix . 'meta_teamstyleswitch',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', true ),
					array( 'name' => 'Style 1', 'value' => 'option2', true ),
					array( 'name' => 'Style 2', 'value' => 'option3', true ),
				),
			),
			array(
				'name' => 'Team Layout',
				'desc' => 'Select a layout for the grid style team page.',
				'id' => $prefix . 'meta_teamlayout',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default',  'value' => 'option1', true ),
					array( 'name' => '1 Column', 'value' => 'option2', true ),
					array( 'name' => '2 Column', 'value' => 'option3', true ),
					array( 'name' => '3 Column', 'value' => 'option4', true ),
					array( 'name' => '4 Column', 'value' => 'option5', true ),
				),
			),
			array(
				'name' => 'Team Links Style',
				'desc' => 'Choose a style for this team hover area. Style 2 takes the theme color scheme.',
				'id' => $prefix . 'meta_teamhoverstyleswitch',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default',                 'value' => 'option1', true ),
					array( 'name' => 'Style 1 (color overlay)', 'value' => 'option2', true ),
					array( 'name' => 'Style 2 (dark overlay)',  'value' => 'option3', true ),
				),
			),			
			array(
				'name' => 'Team Content',
				'id' => $prefix . 'meta_teamcontentcheck',
				'type' => 'multicheck',
				'options' => array(
					'option1' => 'Default (overrides below options)',
					'option2' => 'Show name.',
					'option3' => 'Show position.',
					'option4' => 'Show excerpt.',
					'option5' => 'Show social links.',
				)
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_testimonialinfo',
		'title'      => 'ThinkUpThemes.com - Testimonial Options',
		'pages'      => array( 'testimonial' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Name',
				'desc' => 'Add the name of the person that left the testimonial.',
				'id'   => $prefix . 'meta_testimonialname',
				'type' => 'text',
			),
			array(
				'name' => 'Company / Position',
				'desc' => 'Add the company name / position of the person that left the testimonial.',
				'id'   => $prefix . 'meta_testimonialcompany',
				'type' => 'text',
			),
			array(
				'name' => 'Rating',
				'desc' => 'Add a rating for the testimonial.',
				'id'   => $prefix . 'meta_testimonialrating',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'No Rating', 'value' => '0', ),
					array( 'name' => '1 star',    'value' => '1', ),
					array( 'name' => '2 star',    'value' => '2', ),
					array( 'name' => '3 star',    'value' => '3', ),
					array( 'name' => '4 star',    'value' => '4', ),
					array( 'name' => '5 star',    'value' => '5', ),
				),
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_testimonialsettings',
		'title'      => 'ThinkUpThemes.com - Testimonial Page Settings',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Testimonial Style',
				'desc' => 'Choose a style for this testimonals page.',
				'id' => $prefix . 'meta_testimonalstyleswitch',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', true ),
					array( 'name' => 'Style 1', 'value' => 'option2', true ),
					array( 'name' => 'Style 2', 'value' => 'option3', true ),
				),
			),
			array(
				'name' => 'Show Ratings',
				'desc' => 'Choose a style for this testimonals page.',
				'id' => $prefix . 'meta_testimonalratingswitch',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', true ),
					array( 'name' => 'On',      'value' => 'option2', true ),
					array( 'name' => 'Off',     'value' => 'option3', true ),
				),
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_bloginfo',
		'title'      => 'ThinkUpThemes.com - Blog Options',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => 'Blog Style',
				'desc' => 'Select a style for the blog page. This will only be applied to this blog page.',
				'id'      => $prefix . 'meta_blogstyle',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', true ),
					array( 'name' => 'Style 1', 'value' => 'option2', true ),
					array( 'name' => 'Style 2', 'value' => 'option3', true ),
				),
			),
			array(
				'name'    => 'Blog Layout',
				'desc' => 'Choose which filter style to use.',
				'id'      => $prefix . 'meta_blogstyle1layout',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Style 1', 'value' => 'option1', true ),
					array( 'name' => 'Style 2', 'value' => 'option2', true ),
				),
			),
			array(
				'name'    => 'Blog Grid Layout',
				'desc' => 'Choose which filter style to use.',
				'id'      => $prefix . 'meta_blogstyle2layout',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => '1 Column', 'value' => 'option1', true ),
					array( 'name' => '2 Column', 'value' => 'option2', true ),
					array( 'name' => '3 Column', 'value' => 'option3', true ),
					array( 'name' => '4 Column', 'value' => 'option4', true ),
				),
			),
			array(
				'name' => 'Post Date',
				'desc' => 'Check to display post date.',
				'id'   => $prefix . 'meta_blogdate',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Post Author',
				'desc' => 'Check to display post author.',
				'id'   => $prefix . 'meta_blogauthor',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Total Comments',
				'desc' => 'Check to display total comments.',
				'id'   => $prefix . 'meta_blogcomment',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Post Categories',
				'desc' => 'Check to display post categories.',
				'id'   => $prefix . 'meta_blogcategory',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Post Tags',
				'desc' => 'Check to display post tags.',
				'id'   => $prefix . 'meta_blogtags',
				'type' => 'checkbox',
			),
			array(
					'name' => 'Excerpt Length',
					'desc' => 'Specify the number of words in post excerpt. Only works if excerpt option selected from theme options panel.',
					'id'   => $prefix . 'meta_blogpostexcerpts',
					'type' => 'excerpt_select',
			),
			array(
					'name' => 'Posts Per Page',
					'desc' => 'Specify the number of posts on this blog page.',
					'id'   => $prefix . 'meta_blogpostcount',
					'type' => 'excerpt_select',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_portfolioinfo',
		'title'      => 'ThinkUpThemes.com - Portfolio Options',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => 'Portfolio Layout',
				'desc' => 'Select Portfolio page layout. This will only be applied to this portfolio page.',
				'id'      => $prefix . 'meta_portfoliolayout',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', true ),
					array( 'name' => '1 Column', 'value' => 'option2', true ),
					array( 'name' => '2 Column', 'value' => 'option3', true ),
					array( 'name' => '3 Column', 'value' => 'option4', true ),
					array( 'name' => '4 Column', 'value' => 'option5', true ),
				),
			),

			array(
				'name'    => 'Portfolio Filter',
				'desc'    => 'Choose which filter style to use.',
				'id'      => $prefix . 'meta_portfoliofilter',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', ),
					array( 'name' => 'Style 1 (with dropdown)', 'value' => 'option2', ),
					array( 'name' => 'Style 2 (without dropdown)', 'value' => 'option3', ),
				),
			),
			array(
				'name'    => 'Portfolio Content Style',
				'desc'    => 'Choose a style for the portfolio content area.',
				'id'      => $prefix . 'meta_portfoliocontentswitch',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', ),
					array( 'name' => 'Style 1', 'value' => 'option2', ),
					array( 'name' => 'Style 2', 'value' => 'option3', ),
				),
			),
			array(
				'name' => 'Portfolio Links',
				'desc' => 'Choose which links to show on the project hover.',
				'id' => $prefix . 'meta_portfoliolinks',
				'type' => 'multicheck',
				'options' => array(
					'option1' => 'Default (overrides below options)',
					'option2' => 'Check to show lightbox link',
					'option3' => 'Check to show project link',
				)
			),
			array(
				'name' => 'Portfolio Content',
				'desc' => 'Choose which content to display below the project image.',
				'id' => $prefix . 'meta_portfoliocontent',
				'type' => 'multicheck',
				'options' => array(
					'option1' => 'Default (overrides below options)',
					'option2' => 'Check to show project title',
					'option3' => 'Check to show project excerpt',
				)
			),
			array(
					'name' => 'Excerpt Length',
					'desc' => 'Specify the number of words in project excerpt. Only works if excerpt option is selected above.',
					'id'   => $prefix . 'meta_portfolioexcerpts',
					'type' => 'excerpt_select',
			),
			array(
				'name' => 'Enable Portfolio Slider',
				'desc' => 'Check to enable portfolio slider.',
				'id'   => $prefix . 'meta_portfoliosliderswitch',
				'type' => 'checkbox',
			),
			array(
					'name' => 'Slider Categories',
					'desc' => 'Select the project category for slides.',
					'id'   => $prefix . 'meta_portfolioslidercategory',
					'type' => 'category_select',
			),
			array(
				'name'     => 'Slider Height (Max)	',
				'desc'     => 'Specify the maximum slider height (px).',
				'id'       => $prefix . 'meta_portfoliosliderheight',
				'type'     => 'text',
			),
			array(
				'name' => 'Enable Featured Projects',
				'desc' => 'Switch on to enable featured projects.',
				'id'   => $prefix . 'meta_portfoliofeaturedswitch',
				'type' => 'checkbox',
			),
			array(
				'name'     => 'Featured Categories',
				'desc'     => 'Select the project category for carousel.',
				'id'       => $prefix . 'meta_portfoliofeaturedcategory',
					'type' => 'category_select',
			),
			array(
				'name'    => 'Visible Projects',
				'desc'    => 'Specify number of visible projects in carousel.',
				'id'      => $prefix . 'meta_portfoliofeatureditems',
				'type'    => 'select',
				'options' => array(
					array( 'name' => '2', 'value' => '2', ),
					array( 'name' => '3', 'value' => '3', ),
					array( 'name' => '4', 'value' => '4', ),
					array( 'name' => '5', 'value' => '5', ),
				),
			),
			array(
				'name'    => 'Scroll Projects',
				'desc'    => 'Specify number of visible projects in carousel.',
				'id'      => $prefix . 'meta_portfoliofeaturedscroll',
				'type'    => 'select',
				'options' => array(
					array( 'name' => '1', 'value' => '1', ),
					array( 'name' => '2', 'value' => '2', ),
					array( 'name' => '3', 'value' => '3', ),
					array( 'name' => '4', 'value' => '4', ),
				),
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_metaboxgeneraloptions_page',
		'title'      => 'ThinkUpThemes.com - General Page Options Panel',
		'pages'      => array( 'page', 'post', 'portfolio', 'product', 'client', 'team', 'testimonial' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => 'Header Style',
				'desc'    => 'Select a header style for this page.<br />Choose the default option to use the layout chosen in the main options panel.',
				'id'      => $prefix . 'meta_headerstyle',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', ),
					array( 'name' => 'Style 1', 'value' => 'option2', ),
					array( 'name' => 'Style 2', 'value' => 'option3', ),
					array( 'name' => 'Style 3', 'value' => 'option4', ),
				),
			),
			array(
				'name'    => 'Header Location',
				'desc'    => 'Choose whether to display the header links above or below the page slider.',
				'id'      => $prefix . 'meta_headerlocation',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Above Slider', 'value' => 'option1', ),
					array( 'name' => 'Below Slider', 'value' => 'option2', ),
				),
			),
			array(
				'name'    => 'Page Intro',
				'desc'    => 'Select whether to display page intro. Select default to use the options set in the Theme Options panel.',
				'id'      => $prefix . 'meta_intro',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', ),
					array( 'name' => 'Enable', 'value' => 'option2', ),
					array( 'name' => 'Disable', 'value' => 'option3', ),
				),
			),
			array(
				'name'    => 'Enable Breadcrumbs',
				'desc'    => 'Select Default to use the options set in the Theme Options panel.',
				'id'      => $prefix . 'meta_breadcrumbs',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', ),
					array( 'name' => 'Enable', 'value' => 'option2', ),
					array( 'name' => 'Disable', 'value' => 'option3', ),
				),
			),
			array(
				'name' => 'Enable Slider',
				'desc' => 'Check to enable page slider.',
				'id'   => $prefix . 'meta_slider',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Slider Name',
				'desc' => 'Input the shortcode of a slider you would like to use.',
				'id'   => $prefix . 'meta_slidername',
				'type' => 'text',
			),
			array(
				'name'    => 'Boxed Layout',
				'desc'    => 'Select whether to display boxed layout. Select default to use the options set in the Theme Options panel.',
				'id'      => $prefix . 'meta_boxed',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', ),
					array( 'name' => 'Enable', 'value' => 'option2', ),
					array( 'name' => 'Disable', 'value' => 'option3', ),
				),
			),
			array(
				'name'    => 'Page Layout',
				'desc'    => 'Select a layout for this page.<br />Choose the default option to use the layout chosen in the main options panel.',
				'id'      => $prefix . 'meta_layout',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', ),
					array( 'name' => 'Full Width', 'value' => 'option2', ),
					array( 'name' => 'Left Sidebar', 'value' => 'option3', ),
					array( 'name' => 'Right Sidebar', 'value' => 'option4', ),
				),
			),
			array(
				'name' => 'Select a Sidebar',
				'desc' => 'Choose a sidebar to use with the page layout.',
				'id' => $prefix . 'meta_sidebars',
				'type' => 'sidebar_select',
			),
			array(
				'name' => 'Enable Author Bio',
				'desc' => 'Check to enable the author biography on this page.',
				'id'   => $prefix . 'meta_authorbio',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Default', 'value' => 'option1', ),
					array( 'name' => 'Enable', 'value' => 'option2', ),
					array( 'name' => 'Disable', 'value' => 'option3', ),
				),
			),
			array(
				'name' => 'Custom CSS',
				'desc' => 'Developers can use this to apply custom css that will only load on this post/page. Use this to control, by styling of any element on the webpage by targeting id&#39;s and classes.<br /><br />Code written here will load after any custom css written in the main options panel.',
				'id'   => $prefix . 'meta_customcss',
				'type' => 'textarea_small',
			),
			array(
				'name' => 'Custom jQuery',
				'desc' => 'Developers can use this to apply custom css that will only load on this post/page. Use this to control, by styling of any element on the webpage by targeting id&#39;s and classes.<br /><br />Code written here will load after any custom jQuery written in the main options panel.',
				'id'   => $prefix . 'meta_customjava',
				'type' => 'textarea_small',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_metaboxfeaturedmedia_post',
		'title'      => 'Featured Media',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'side',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Featured Media',
				'desc' => 'Paste the URL of a YouTube or Vimeo video to have it display on your blog page. Make sure the post type is set to video.',
				'id'   => $prefix . 'meta_featuredmedia',
				'type' => 'text',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_metaboxfeaturedmedia_portfolio',
		'title'      => 'Featured Media',
		'pages'      => array( 'portfolio' ), // Post type
		'context'    => 'side',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Media URL',
				'desc' => 'Paste the URL of the featured media (e.g. YouTube, Vimeo, Google Map).',
				'id'   => $prefix . 'meta_featuredmedia',
				'type' => 'text',
			),
			array(
				'name'    => 'Media Type',
				'desc'    => 'Specify the media type.',
				'id'      => $prefix . 'meta_featuredmediatype',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'YouTube / Vimeo', 'value' => 'option1', ),
					array( 'name' => 'Google Map',      'value' => 'option2', ),
					array( 'name' => 'Other iframe',    'value' => 'option3', ),
				),
			),
			array(
				'name'    => 'Override featured image?',
				'desc'    => 'Select On to override featured image on ain portfolio page.',
				'id'      => $prefix . 'meta_featuredmediamain',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'On',  'value' => 'option1', ),
					array( 'name' => 'Off', 'value' => 'option2', ),
				),
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'thinkup_metaboxseo',
		'title'      => 'ThinkUpThemes.com - SEO',
		'pages'      => array( 'page', 'post', 'portfolio', 'client', 'team',  'testimonial' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Enable SEO?',
				'desc' => 'Check to enable SEO features on this page.',
				'id'   => $prefix . 'meta_seoswitch',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Page Title',
				'desc' => 'This title will only be shown on the this individual published page / post.',
				'id'   => $prefix . 'meta_seotitle',
				'type' => 'text',
			),
			array(
				'name' => 'Page Description',
				'desc' => 'Write a short and snappy description about what your webpage is about.',
				'id'   => $prefix . 'meta_seodescription',
				'type' => 'textarea_small',
			),
			array(
				'name' => 'Page Keywords (Comma Separated)',
				'desc' => 'Add keywords that are relevant for your webpage. (e.g. Keyword 1, Keyword 2, Keyword 3, etc...)',
				'id'   => $prefix . 'meta_seokeywords',
				'type' => 'textarea_small',
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}


add_action( 'init', 'thinkup_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function thinkup_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}