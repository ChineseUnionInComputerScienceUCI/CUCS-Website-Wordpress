<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "thinkup_redux_variables";

    // This line is adding in extensions.
//    Redux::setExtensions( $opt_name, dirname(__FILE__).'/../main-extensions');

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'ryan' ),
        'page_title'           => __( 'Theme Options', 'ryan' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer_only'      => false,
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => false,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
//    $args['admin_bar_links'][] = array(
//        'id'    => 'redux-docs',
//        'href'  => 'http://docs.reduxframework.com/',
//        'title' => __( 'Documentation', 'ryan' ),
//    );

//    $args['admin_bar_links'][] = array(
//        //'id'    => 'redux-support',
//        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
//        'title' => __( 'Support', 'ryan' ),
//    );

//    $args['admin_bar_links'][] = array(
//        'id'    => 'redux-extensions',
//        'href'  => 'reduxframework.com/extensions',
//        'title' => __( 'Extensions', 'ryan' ),
//    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
//    $args['share_icons'][] = array(
//        'url'   => 'https://github.com/',
//        'title' => 'Visit us on GitHub',
//        'icon'  => 'el el-github'
//        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
//    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/thinkupthemes',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.twitter.com/thinkupthemes',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
//    $args['share_icons'][] = array(
//        'url'   => 'http://www.linkedin.com/',
//        'title' => 'Find us on LinkedIn',
//        'icon'  => 'el el-linkedin'
//    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
//        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'ryan' ), $v );
    } else {
//        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'ryan' );
    }

    // Add content after the form.
//    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'ryan' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

//    $tabs = array(
//        array(
//            'id'      => 'redux-help-tab-1',
//            'title'   => __( 'Theme Information 1', 'ryan' ),
//            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'ryan' )
//        ),
//        array(
//            'id'      => 'redux-help-tab-2',
//            'title'   => __( 'Theme Information 2', 'ryan' ),
//            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'ryan' )
//        )
//    );
//    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
//    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'ryan' );
//    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

	// -----------------------------------------------------------------------------------
	//	0.	Customizer - Set subsections
	// -----------------------------------------------------------------------------------

	if ( is_customize_preview() ) {

		// Change subtitle text in customizer / options panel
		$thinkup_subtitle_customizer   = 'subtitle';
		$thinkup_subtitle_panel        = NULL;

		// Change section field used in customizer / options panel
		$thinkup_section_field         = 'thinkup_section';

		// Enable sub-sections in customizer
		$thinkup_customizer_subsection = true;

		Redux::setSection( $opt_name, array(
			'title'            => __( 'Theme Options', 'ryan' ),
			'id'               => 'thinkup_theme_options',
			'desc'             => __( 'Use the options below to customize your theme!', 'ryan' ),
			'customizer_width' => '400px',
			'icon'             => 'el el-home',
			'customizer'       => true,
		) );

	} else {

		// Disable sub-sections in theme options panel
		$thinkup_customizer_subsection = false;

		// Change subtitle text in customizer / options panel
		$thinkup_subtitle_customizer   = NULL;
		$thinkup_subtitle_panel        = 'subtitle';

		// Change section field used in customizer / options panel
		$thinkup_section_field         = 'section';

	}
	

	// -----------------------------------------------------------------------------------
	//	1.	General Settings
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('General Settings', 'ryan'),
		'header'     => __('Welcome to the Simple Options Framework Demo', 'ryan'),
		'desc'       => __('<span class="redux-title">Logo & Favicon Settings</span>', 'ryan'),
		'icon_class' => '',
		'icon'       => 'el el-wrench',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Enable Theme Logo Settings', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to control logo settings from theme options panel. Leave off to control using antive WP options', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to control logo settings from theme options panel. Leave off to control using antive WP options', 'ryan'),
				'id'                         => 'thinkup_general_logosetting',
				'type'                       => 'switch',
			),

			array(
				'title'                      => __('Logo Settings', 'ryan'), 
				$thinkup_subtitle_panel      => __('If you have an image logo you can upload it, otherwise you can display a text site title', 'ryan'),
				$thinkup_subtitle_customizer => __('If you have an image logo you can upload it, otherwise you can display a text site title', 'ryan'),
				'id'                         => 'thinkup_general_logoswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Custom Image Logo', 
					'option2' => 'Display Site Title',
				),
				'default'                    => '' 
			),

			array(
				'title'                      => __('Custom Image Logo', 'ryan'),
				$thinkup_subtitle_panel      => __('Upload image logo or specify the image url.<br />Name the logo image logo.png.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload image logo or specify the image url.<br />Name the logo image logo.png.', 'ryan'),
				'id'                         => 'thinkup_general_logolink',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Custom Image Logo (Retina display)', 'ryan'),
				$thinkup_subtitle_panel      => __('Upload a logo image twice the size of logo.png. Name the logo image logo@2x.png.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload a logo image twice the size of logo.png. Name the logo image logo@2x.png.', 'ryan'),
				'id'                         => 'thinkup_general_logolinkretina',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Custom Image Logo (Sticky header)', 'ryan'),
				$thinkup_subtitle_panel      => __('Upload a logo to use in the sticky header.<br />Leave empty to use default logo set above.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload a logo to use in the sticky header.<br />Leave empty to use default logo set above.', 'ryan'),
				'id'                         => 'thinkup_general_logolinksticky',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Site Title', 'ryan'),
				$thinkup_subtitle_panel      => __('Input a message to display as your site title. Leave blank to display your default site title.', 'ryan'),
				$thinkup_subtitle_customizer => __('Input a message to display as your site title. Leave blank to display your default site title.', 'ryan'),
				'id'                         => 'thinkup_general_sitetitle',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option2' ),
					), 
				)
			),

			array(
				'title'                      => __('Site Description', 'ryan'),
				$thinkup_subtitle_panel      => __('Input a message to display as site description. Leave blank to display default site description.', 'ryan'),
				$thinkup_subtitle_customizer => __('Input a message to display as site description. Leave blank to display default site description.', 'ryan'),
				'id'                         => 'thinkup_general_sitedescription',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_general_logoswitch', '=', 
						array( 'option2' ),
					), 
				)
			),

			array(
				'title'                      => __('Custom Favicon', 'ryan'),
				$thinkup_subtitle_panel      => __('Uploads favicon or specify the favicon url.', 'ryan'),
				$thinkup_subtitle_customizer => __('Uploads favicon or specify the favicon url.', 'ryan'),
				'id'                         => 'thinkup_general_faviconlink',
				'type'                       => 'media',
				'url'                        => true,
			),

            array(
                'id'       => 'thinkup_section_general_page',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Page Structure</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Page Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select page layout. This will only be applied to published Pages (I.e. Not posts, blog or home).', 'ryan'),
				$thinkup_subtitle_customizer => __('Select page layout. This will only be applied to published Pages (I.e. Not posts, blog or home).', 'ryan'),
				'id'                         => 'thinkup_general_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the page layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the page layout.', 'ryan'),
				'id'                         => 'thinkup_general_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_general_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Fixed Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Check to enable fixed layout.<br />(i.e. Disable responsive layout)', 'ryan'),
				$thinkup_subtitle_customizer => __('Check to enable fixed layout.<br />(i.e. Disable responsive layout)', 'ryan'),
				'id'                         => 'thinkup_general_fixedlayoutswitch',
				'type'                       => 'switch',
			),

			array(
				'title'                      => __('Enable Boxed Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable boxed layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable boxed layout.', 'ryan'),
				'id'                         => 'thinkup_general_boxlayout',
				'type'                       => 'switch',
				'default'                    => '',
			),

			array(
				'title'                      => __('Background Color For Boxed Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select a custom color to use as background.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a custom color to use as background.', 'ryan'),
				'id'                         => 'thinkup_general_boxbackgroundcolor',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#F1F1F1',
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Background Image For Boxed Layout', 'ryan'),
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				'id'                         => 'thinkup_general_boxbackgroundimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_general_boxedposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_general_boxedrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_general_boxedsize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_general_boxedattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_general_boxlayout', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Intro', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable intro.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable intro.', 'ryan'),
				'id'                         => 'thinkup_general_introswitch',
				'type'                       => 'switch',
				'default'                    => '1',
			),

			array(
				'title'                      => __('Enable Breadcrumbs', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable breadcrumbs.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable breadcrumbs.', 'ryan'),
				'id'                         => 'thinkup_general_breadcrumbswitch',
				'type'                       => 'switch',
				'default'                    => '1', 
				'required'                   => array( 
					array( 'thinkup_general_introswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Breadcrumb Delimiter', 'ryan'),
				$thinkup_subtitle_panel      => __('Specify a custom delimiter to use instead of the default &#40; / &#41; when displaying breadcrumbs.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify a custom delimiter to use instead of the default &#40; / &#41; when displaying breadcrumbs.', 'ryan'),
				'default'                    => '/',
				'id'                         => 'thinkup_general_breadcrumbdelimeter',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_general_breadcrumbswitch', '=', 
						array( '1' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_general_code',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Custom Code</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Google Analytics Code', 'ryan'),
				$thinkup_subtitle_panel      => __('Copy and paste your Google Analytics code here to apply it to all pages on your website.', 'ryan'),
				$thinkup_subtitle_customizer => __('Copy and paste your Google Analytics code here to apply it to all pages on your website.', 'ryan'),
				'id'                         => 'thinkup_general_analyticscode',
				'type'                       => 'textarea',
			),

			array(
				'title'                      => __('Custom CSS', 'ryan'), 
				$thinkup_subtitle_panel      => __('Developers can use this to apply custom css. Use this to control, by styling of any element on the webpage by targeting id&#39;s and classes.', 'ryan'),
				$thinkup_subtitle_customizer => __('Developers can use this to apply custom css. Use this to control, by styling of any element on the webpage by targeting id&#39;s and classes.', 'ryan'),
				'id'                         => 'thinkup_general_customcss',
				'type'                       => 'textarea',
				'validate'                   => 'css',
			),

			array(
				'title'                      => __('Custom jQuery - Front End', 'ryan'),
				$thinkup_subtitle_panel      => __('Developers can use this to apply custom jQuery which will only affect the front end of the website.<br /><br />Use this to control your site by adding great jQuery features.', 'ryan'),
				$thinkup_subtitle_customizer => __('Developers can use this to apply custom jQuery which will only affect the front end of the website.<br /><br />Use this to control your site by adding great jQuery features.', 'ryan'),
				'id'                         => 'thinkup_general_customjavafront',
				'type'                       => 'textarea',
			),

			// Ensures ThinkUpThemes custom code is output
			array(
				'title'    => __('Custom Code', 'ryan'), 
				'subtitle' => __('Custom Code', 'ryan'),
				'id'       => 'thinkup_customization',
				'type'     => 'thinkup_custom_code',
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'type' => 'divide',
	) );


	// -----------------------------------------------------------------------------------
	//	2.1.	Home Settings				
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Homepage', 'ryan'),
		'desc'       => __('<span class="redux-title">Control Homepage Layout</span>', 'ryan'),
		'icon_class' => '',
		'icon'       => 'el el-home',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Homepage Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select page layout. This will only be applied to static homepages (front page) and not to homepage blogs.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select page layout. This will only be applied to static homepages (front page) and not to homepage blogs.', 'ryan'),
				'id'                         => 'thinkup_homepage_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'ryan'),
				'id'                         => 'thinkup_homepage_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_homepage_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_homepage_slider',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Homepage Slider</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Choose Homepage Slider', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable home page slider.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable home page slider.', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderswitch',
				'type'                       => 'button_set',
				'options'                    => array(
					'option1' => 'ThinkUpSlider',
					'option4' => 'Image Slider',
					'option2' => 'Custom Slider',
					'option3' => 'Disable'
				),
				'default' => 'option1'
			),

			array(
				'title'                      => __('Homepage Slider Shortcode', 'ryan'), 
				$thinkup_subtitle_panel      => __('Input the shortcode of the slider you want to display. I.e. [shortcode_name].', 'ryan'),
				$thinkup_subtitle_customizer => __('Input the shortcode of the slider you want to display. I.e. [shortcode_name].', 'ryan'),
				'id'                         => 'thinkup_homepage_slidername',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option2' ),
					), 
				)
			),

			array(
				'title'                      => __('Built-In Slider', 'ryan'),
				$thinkup_subtitle_panel      => __('Unlimited slides with drag and drop sortings.', 'ryan'),
				$thinkup_subtitle_customizer => __('Unlimited slides with drag and drop sortings.', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderpreset',
				'type'                       => 'thinkup_slider_v3',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Slider Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a slider style. HTML, YouTube and Vimeo urls are supported for video layouts.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a slider style. HTML, YouTube and Vimeo urls are supported for video layouts.', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderstyle',
				'type'                       => 'select',
				'options'                    => array(
					'option1' => 'Standard',
					'option2' => 'Video on left',
					'option3' => 'Video on right'
				),
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

			// Add Image Slide 1 - Info
			array(
				'title'                      => __('Slide 1', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage1_info',
				'type'                       => 'raw',
				'content'                    => '',
				'default'                    => '' 
			),

			// Add Image Slide 1 - Image
			array(
				$thinkup_subtitle_panel      => __('Image', 'ryan'),
				$thinkup_subtitle_customizer => __('Image', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage1_image',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 1 - Title
			array(
				$thinkup_subtitle_panel      => __('Title', 'ryan'),
				$thinkup_subtitle_customizer => __('Title', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage1_title',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 1 - Description
			array(
				$thinkup_subtitle_panel      => __('Description', 'ryan'),
				$thinkup_subtitle_customizer => __('Description', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage1_desc',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Slide 1 - Page Link
			array(
				$thinkup_subtitle_panel      => __('URL', 'ryan'),
				$thinkup_subtitle_customizer => __('URL', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage1_link',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 1 - Info
			array(
				'title'                      => __('Slide 2', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage2_info',
				'type'                       => 'raw',
				'content'                    => '',
				'default'                    => '' 
			),

			// Add Image Slide 2 - Image
			array(
				$thinkup_subtitle_panel      => __('Image', 'ryan'),
				$thinkup_subtitle_customizer => __('Image', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage2_image',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 2 - Title
			array(
				$thinkup_subtitle_panel      => __('Title', 'ryan'),
				$thinkup_subtitle_customizer => __('Title', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage2_title',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 2 - Description
			array(
				$thinkup_subtitle_panel      => __('Description', 'ryan'),
				$thinkup_subtitle_customizer => __('Description', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage2_desc',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Slide 2 - Page Link
			array(
				$thinkup_subtitle_panel      => __('URL', 'ryan'),
				$thinkup_subtitle_customizer => __('URL', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage2_link',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 1 - Info
			array(
				'title'                      => __('Slide 3', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage3_info',
				'type'                       => 'raw',
				'content'                    => '',
				'default'                    => '' 
			),

			// Add Image Slide 3 - Image
			array(
				$thinkup_subtitle_panel      => __('Image', 'ryan'),
				$thinkup_subtitle_customizer => __('Image', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage3_image',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 3 - Title
			array(
				$thinkup_subtitle_panel      => __('Title', 'ryan'),
				$thinkup_subtitle_customizer => __('Title', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage3_title',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Image Slide 3 - Description
			array(
				$thinkup_subtitle_panel      => __('Description', 'ryan'),
				$thinkup_subtitle_customizer => __('Description', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage3_desc',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			// Add Slide 3 - Page Link
			array(
				$thinkup_subtitle_panel      => __('URL', 'ryan'),
				$thinkup_subtitle_customizer => __('URL', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderimage3_link',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option4' ),
					), 
				)
			),

			array(
				'title'                      => __('Slider Speed', 'ryan'),
				$thinkup_subtitle_panel      => __('Specify the time it takes to move to the next slide.<br />Tip: Set to 0 to disable automatic transitions.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the time it takes to move to the next slide.<br />Tip: Set to 0 to disable automatic transitions.', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderspeed',
				'type'                       => 'slider', 
				"default"                    => "6",
				"min"                        => "0",
				"step"                       => "1",
				"max"                        => "30",
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1', 'option4' ),
					), 
				)
			),

			array(
				'id'                         => 'thinkup_homepage_sliderpresetheight',
				'type'                       => 'slider', 
				'title'                      => __('Slider Height (Max)', 'ryan'),
				$thinkup_subtitle_panel      => __('Specify the maximum slider height (px).', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the maximum slider height (px).', 'ryan'),
				"default"                    => "350",
				"min"                        => "200",
				"step"                       => "5",
				"max"                        => "1000",
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1', 'option4' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Full-Width Slider', 'ryan'),
				$thinkup_subtitle_panel      => __('Switch on to enable full-width slider.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable full-width slider.', 'ryan'),
				'id'                         => 'thinkup_homepage_sliderpresetwidth',
				'type'                       => 'switch',
				'default'                    => '1',
				'required'                   => array( 
					array( 'thinkup_homepage_sliderswitch', '=', 
						array( 'option1', 'option4' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_homepage_ctaintro',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Call To Action - Intro</span>', 'ryan' ),
                'indent'   => false,
            ),			

			array(
				'title'   => __('Message', 'ryan'), 
				'desc'    => __('Check to enable intro on home page.', 'ryan'),
				'id'      => 'thinkup_homepage_introswitch',
				'type'    => 'checkbox',
				'default' => '1',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'ryan'),
				'id'                         => 'thinkup_homepage_introaction',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'ryan'),
				'id'                         => 'thinkup_homepage_introactionteaser',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Text', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify a text for button 1.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify a text for button 1.', 'ryan'),
				'id'                         => 'thinkup_homepage_introactiontext1',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Link', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'ryan'),
				'id'                         => 'thinkup_homepage_introactionlink1',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Link to a Page',
					'option2' => 'Specify Custom link',
					'option3' => 'Disable Link'
				),
			),

			array(
				'title'                      => __('Button - Link to a page', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select a target page for action button link.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a target page for action button link.', 'ryan'),
				'id'                         => 'thinkup_homepage_introactionpage1',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_introactionlink1', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Button - Custom link', 'ryan'),
				$thinkup_subtitle_panel      => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'ryan'),
				$thinkup_subtitle_customizer => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'ryan'),
				'id'                         => 'thinkup_homepage_introactioncustom1',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_introactionlink1', '=', 
						array( 'option2' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_homepage_ctaoutro',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Call To Action - Outro</span>', 'ryan' ),
                'indent'   => false,
            ),		

			array(
				'title'   => __('Message', 'ryan'), 
				'desc'    => __('Check to enable outro on home page.', 'ryan'),
				'id'      => 'thinkup_homepage_outroswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'ryan'),
				'id'                         => 'thinkup_homepage_outroaction',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'ryan'),
				'id'                         => 'thinkup_homepage_outroactionteaser',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Text', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify a text for button 1.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify a text for button 1.', 'ryan'),
				'id'                         => 'thinkup_homepage_outroactiontext1',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Link', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'ryan'),
				'id'                         => 'thinkup_homepage_outroactionlink1',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Link to a Page',
					'option2' => 'Specify Custom link',
					'option3' => 'Disable Link'
				),
			),

			array(
				'title'                      => __('Button - Link to a page', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select a target page for action button link.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a target page for action button link.', 'ryan'),
				'id'                         => 'thinkup_homepage_outroactionpage1',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_homepage_outroactionlink1', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Button - Custom link', 'ryan'),
				$thinkup_subtitle_panel      => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'ryan'),
				$thinkup_subtitle_customizer => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'ryan'),
				'id'                         => 'thinkup_homepage_outroactioncustom1',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_homepage_outroactionlink1', '=', 
						array( 'option2' ),
					), 
				)
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	2.2.	Homepage (Featured)				
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Homepage (Featured)', 'ryan'),
		'desc'       => __('<span class="redux-title">Display Pre-Designed Homepage Layout</span>', 'ryan'),
		'icon_class' => '',
		'icon'       => 'el el-pencil',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Enable Pre-Made Homepage ', 'ryan'), 
				$thinkup_subtitle_panel      => __('switch on to enable pre-designed homepage layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('switch on to enable pre-designed homepage layout.', 'ryan'),
				'id'                         => 'thinkup_homepage_sectionswitch',
				'type'                       => 'switch',
				'default'                    => '1',
			),

			array(
				'id'       => 'thinkup_homepage_section1_icon',
				'title'    => __('Content Area 1', 'ryan'),
				'desc'     => __('Choose an icon for the section background.', 'ryan'),
				'type'     => 'select',
				'data'     => 'elusive-icons',
			),

			array(
				'id'       => 'thinkup_homepage_section1_title',
				'desc'     => __('Add a title to the section.', 'ryan'),
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section1_desc',
				'desc'     => __('Add some text to featured section 1.', 'ryan'),
				'type'     => 'textarea',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section1_link',
				'desc'     => __('Link to a page', 'ryan'), 
				'type'     => 'select',
				'data'     => 'pages',
			),
			
			array(
				'id'       => 'thinkup_homepage_section1_url',
				'desc'     => __('Link to a custom page.', 'ryan'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section1_button',
				'desc'     => __('Add a custom button text.', 'ryan'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section1_target',
				'desc'     => __('Link target', 'ryan'), 
				'type'     => 'select',
				'options'  => array( 
					'option1' => 'Current tab',
					'option2' => 'New tab',
				),
			),

			array(
				'id'       => 'thinkup_homepage_section2_icon',
				'title'    => __('Content Area 2', 'ryan'),
				'desc'     => __('Choose an icon for the section background.', 'ryan'),
				'type'     => 'select',
				'data'     => 'elusive-icons',
			),

			array(
				'id'       => 'thinkup_homepage_section2_title',
				'desc'     => __('Add a title to the section.', 'ryan'),
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section2_desc',
				'desc'     => __('Add some text to featured section 2.', 'ryan'),
				'type'     => 'textarea',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section2_link',
				'desc'     => __('Link to a page', 'ryan'), 
				'type'     => 'select',
				'data'     => 'pages',
			),

			array(
				'id'       => 'thinkup_homepage_section2_url',
				'desc'     => __('Link to a custom page.', 'ryan'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section2_button',
				'desc'     => __('Add a custom button text.', 'ryan'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section2_target',
				'desc'     => __('Link target', 'ryan'), 
				'type'     => 'select',
				'options'  => array( 
					'option1' => 'Current tab',
					'option2' => 'New tab',
				),
			),

			array(
				'id'       => 'thinkup_homepage_section3_icon',
				'title'    => __('Content Area 3', 'ryan'),
				'desc'     => __('Choose an icon for the section background.', 'ryan'),
				'type'     => 'select',
				'data'     => 'elusive-icons',
			),

			array(
				'id'       => 'thinkup_homepage_section3_title',
				'desc'     => __('Add a title to the section.', 'ryan'),
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section3_desc',
				'desc'     => __('Add some text to featured section 3.', 'ryan'),
				'type'     => 'textarea',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section3_link',
				'desc'     => __('Link to a page', 'ryan'), 
				'type'     => 'select',
				'data'     => 'pages',
			),

			array(
				'id'       => 'thinkup_homepage_section3_url',
				'desc'     => __('Link to a custom page.', 'ryan'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section3_button',
				'desc'     => __('Add a custom button text.', 'ryan'), 
				'type'     => 'text',
				'validate' => 'html',
			),

			array(
				'id'       => 'thinkup_homepage_section3_target',
				'desc'     => __('Link target', 'ryan'), 
				'type'     => 'select',
				'options'  => array( 
					'option1' => 'Current tab',
					'option2' => 'New tab',
				),
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	3.	Header
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Header', 'ryan'),
		'desc'       => __('<span class="redux-title">Pre Header Style</span>', 'ryan'),
		'icon'       => 'el el-chevron-up',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Choose Pre Header Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the pre header style.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the pre header style.', 'ryan'),
				'id'                         => 'thinkup_header_styleswitchpre',
				'type'                       => 'radio',
				'options'                    => array(
					'option1' => 'Style 1 (Dark)',
					'option2' => 'Style 2 (Light)',
				),
			),

            array(
                'id'       => 'thinkup_section_header_style',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Header Style</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Choose Header Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the header layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the header layout.', 'ryan'),
				'id'                         => 'thinkup_header_styleswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
					'option3' => 'Style 3',
				),
				'default'                    => '',
			),

			array(
				'title'                      => __('Choose Header Location', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the header location.<br />Feature only works with header style 2.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the header location.<br />Feature only works with header style 2.', 'ryan'),
				'id'                         => 'thinkup_header_locationswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Above Slider',
					'option2' => 'Below Slider',
				),
				'required'                   => array( 
					array( 'thinkup_header_styleswitch', '=', 
						array( 'option1' ),
				), 
				)
			),

			array(
				'title'                      => __('Sticky Header', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to fix header to top of page.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to fix header to top of page.', 'ryan'),
				'id'                         => 'thinkup_header_stickyswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Header Image', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to add image above header.<br />Note: Image will be centered in the header area.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to add image above header.<br />Note: Image will be centered in the header area.', 'ryan'),
				'id'                         => 'thinkup_header_imageswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Choose header image. <strong>Tip:</strong> Remember you can always crop your images directly from the media library so your image shows only what you want.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose header image. <strong>Tip:</strong> Remember you can always crop your images directly from the media library so your image shows only what you want.', 'ryan'),
				'id'                         => 'thinkup_header_imagelink',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_header_imageswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link header image.<br />Add http:// as the url is an external link.', 'ryan'),
				$thinkup_subtitle_customizer => __('Link header image.<br />Add http:// as the url is an external link.', 'ryan'),
				'id'                         => 'thinkup_header_imageurl',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_header_imageswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Header image width', 'ryan'),
				$thinkup_subtitle_customizer => __('Header image width', 'ryan'),
				'desc'                       => __('Check to restrict header image width to 1170px', 'ryan'),
				'id'                         => 'thinkup_header_imagewidth',
				'type'                       => 'checkbox',
				'default'                    => '0',
				'required'                   => array( 
					array( 'thinkup_header_imageswitch', '=', 
						array( '1' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_header_content',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Control Header Content</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Enable Search (Pre Header)', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable pre header search.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable pre header search.', 'ryan'),
				'id'                         => 'thinkup_header_searchswitchpre',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Enable Search (Main Header)', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable header search.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable header search.', 'ryan'),
				'id'                         => 'thinkup_header_searchswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),
		)
	) );
	
	
	// -----------------------------------------------------------------------------------
	//	4.	Footer
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Footer', 'ryan'),
		'desc'       => __('<span class="redux-title">Control Footer Content</span>', 'ryan'),
		'icon'       => 'el el-chevron-down',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Footer Widgets Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select footer layout. Take complete control of the footer content by adding widgets.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select footer layout. Take complete control of the footer content by adding widgets.', 'ryan'),
				'id'                         => 'thinkup_footer_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option04.png',
					'option5' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option05.png',
					'option6' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option06.png',
					'option7' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option07.png',
					'option8' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option08.png',
					'option9' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option09.png',
					'option10' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option10.png',
					'option11' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option11.png',
					'option12' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option12.png',
					'option13' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option13.png',
					'option14' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option14.png',
					'option15' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option15.png',
					'option16' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option16.png',
					'option17' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option17.png',
					'option18' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/footer/option18.png',
				),
			),

			array(
				'title'   => __('Disable Footer Widgets', 'ryan'), 
				'desc'    => __('Check to disable footer widgets.', 'ryan'),
				'id'      => 'thinkup_footer_widgetswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'                      => __('Enable Scroll To Top', 'ryan'), 
				$thinkup_subtitle_panel      => __('Check to enable scroll to top.', 'ryan'),
				$thinkup_subtitle_customizer => __('Check to enable scroll to top.', 'ryan'),
				'id'                         => 'thinkup_footer_scroll',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Copyright Text', 'ryan'), 
				$thinkup_subtitle_panel      => __('Add custom copyright text.<br />Leave blank to display default message.', 'ryan'),
				$thinkup_subtitle_customizer => __('Add custom copyright text.<br />Leave blank to display default message.', 'ryan'),
				'id'                         => 'thinkup_footer_copyright',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

            array(
                'id'       => 'thinkup_section_subfooter',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Control Sub-Footer Content</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Post-Footer Widgets Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select post-footer layout. Take complete control of the post-footer content by adding widgets.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select post-footer layout. Take complete control of the post-footer content by adding widgets.', 'ryan'),
				'id'                         => 'thinkup_subfooter_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option04.png',
					'option5' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option05.png',
					'option6' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option06.png',
					'option7' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option07.png',
					'option8' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/sub-footer/option08.png',
				),
			),

			array(
				'title'   => __('Disable Post-Footer Widgets', 'ryan'), 
				'desc'    => __('Check to disable post-footer widgets.', 'ryan'),
				'id'      => 'thinkup_subfooter_widgetswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'                      => __('Enable Widget Close Button', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable button to hide post-footer widgets.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable button to hide post-footer widgets.', 'ryan'),
				'id'                         => 'thinkup_subfooter_widgetclose',
				'type'                       => 'switch',
				'default'                    => '0',
			),

            array(
                'id'       => 'thinkup_section_footer_ctaoutro',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Call To Action - Outro Inner Pages</span>', 'ryan' ),
                'indent'   => false,
            ),	

			array(
				'title'   => __('Message', 'ryan'), 
				'desc'    => __('Check to enable outro on all inner pages.', 'ryan'),
				'id'      => 'thinkup_footer_outroswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'ryan'),
				'id'                         => 'thinkup_footer_outroaction',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'ryan'),
				'id'                         => 'thinkup_footer_outroactionteaser',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Text', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify a text for button 1.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify a text for button 1.', 'ryan'),
				'id'                         => 'thinkup_footer_outroactiontext1',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Button - Link', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'ryan'),
				'id'                         => 'thinkup_footer_outroactionlink1',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Link to a Page',
					'option2' => 'Specify Custom link',
					'option3' => 'Disable Link'
				),
			),

			array(
				'title'                      => __('Button - Link to a page', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select a target page for action button link.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a target page for action button link.', 'ryan'),
				'id'                         => 'thinkup_footer_outroactionpage1',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_footer_outroactionlink1', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Button - Custom link', 'ryan'),
				$thinkup_subtitle_panel      => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'ryan'),
				$thinkup_subtitle_customizer => __('Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'ryan'),
				'id'                         => 'thinkup_footer_outroactioncustom1',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_footer_outroactionlink1', '=', 
						array( 'option2' ),
					), 
				)
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	3 & 4.	Social Media
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Social Media', 'ryan'),
		'desc'       => __('<span class="redux-title">Social Media Control</span>', 'ryan'),
		'icon'       => 'el el-facebook',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Enable Social Media Links (Pre Header)', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable links to social media pages.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable links to social media pages.', 'ryan'),
				'id'                         => 'thinkup_header_socialswitchpre',
				'type'                       => 'switch',
				'default'                    => '0',
			),

//			array(
//				'title'                      => __('Enable Social Media Links (Main Header)', 'ryan'), 
//				$thinkup_subtitle_panel      => __('Switch on to enable links to social media pages.', 'ryan'),
//				$thinkup_subtitle_customizer => __('Switch on to enable links to social media pages.', 'ryan'),
//				'id'                         => 'thinkup_header_socialswitchmain',
//				'type'                       => 'switch',
//				'default'                    => '0',
//			),

			array(
				'title'                      => __('Enable Social Media Links (footer)', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable links to social media pages.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable links to social media pages.', 'ryan'),
				'id'                         => 'thinkup_header_socialswitchfooter',
				'type'                       => 'switch',
				'default'                    => '0',
			),

            array(
                'id'       => 'thinkup_section_header_social',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Social Media Content</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Display Message', 'ryan'), 
				$thinkup_subtitle_panel      => __('Add a message here. E.g. &#34;Follow Us&#34;.<br />(Only shown in header)', 'ryan'),
				$thinkup_subtitle_customizer => __('Add a message here. E.g. &#34;Follow Us&#34;.<br />(Only shown in header)', 'ryan'),
				'id'                         => 'thinkup_header_socialmessage',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			// Facebook social settings
			array(
				'title'                      => __('Facebook', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Facebook profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Facebook profile.', 'ryan'),
				'id'                         => 'thinkup_header_facebookswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Facebook page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_facebooklink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_facebookswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Facebook Icon', 'ryan'),
				'id'       => 'thinkup_header_facebookiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_facebookswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_facebookcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_facebookswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Twitter social settings
			array(
				'title'                      => __('Twitter', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Twitter profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Twitter profile.', 'ryan'),
				'id'                         => 'thinkup_header_twitterswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Twitter page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_twitterlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_twitterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Twitter Icon', 'ryan'),
				'id'       => 'thinkup_header_twittericonswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_twitterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_twittercustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_twitterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Google+ social settings
			array(
				'title'                      => __('Google+', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Google+ profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Google+ profile.', 'ryan'),
				'id'                         => 'thinkup_header_googleswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Google+ page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_googlelink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_googleswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Google+ Icon', 'ryan'),
				'id'       => 'thinkup_header_googleiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_googleswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_googlecustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_googleswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Instagram social settings
			array(
				'title'                      => __('Instagram', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Instagram profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Instagram profile.', 'ryan'),
				'id'                         => 'thinkup_header_instagramswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Instagram page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_instagramlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_instagramswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Instagram Icon', 'ryan'),
				'id'       => 'thinkup_header_instagramiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_instagramswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_instagramcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_instagramswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Tumblr social settings
			array(
				'title'                      => __('Tumblr', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Tumblr profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Tumblr profile.', 'ryan'),
				'id'                         => 'thinkup_header_tumblrswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Tumblr page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_tumblrlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_tumblrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Tumblr Icon', 'ryan'),
				'id'       => 'thinkup_header_tumblriconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_tumblrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_tumblrcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_tumblrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// LinkedIn social settings
			array(
				'title'                      => __('LinkedIn', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to LinkedIn profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to LinkedIn profile.', 'ryan'),
				'id'                         => 'thinkup_header_linkedinswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your LinkedIn page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_linkedinlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_linkedinswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom LinkedIn Icon', 'ryan'),
				'id'       => 'thinkup_header_linkediniconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_linkedinswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_linkedincustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_linkedinswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Flickr social settings
			array(
				'title'                      => __('Flickr', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Flickr profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Flickr profile.', 'ryan'),
				'id'                         => 'thinkup_header_flickrswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Flickr page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_flickrlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_flickrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Flickr Icon', 'ryan'),
				'id'       => 'thinkup_header_flickriconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_flickrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_flickrcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_flickrswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Pinterest social settings
			array(
				'title'                      => __('Pinterest', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Pinterest profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Pinterest profile.', 'ryan'),
				'id'                         => 'thinkup_header_pinterestswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Pinterest page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_pinterestlink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_pinterestswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Pinterest Icon', 'ryan'),
				'id'       => 'thinkup_header_pinteresticonswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_pinterestswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_pinterestcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_pinterestswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Xing social settings
			array(
				'title'                      => __('Xing', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Xing profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Xing profile.', 'ryan'),
				'id'                         => 'thinkup_header_xingswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Xing page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_xinglink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_xingswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				'desc'     => __('Use Custom Xing Icon', 'ryan'),
				'id'       => 'thinkup_header_xingiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_xingswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_xingcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_xingswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// PayPal social settings
			array(
				'title'                      => __('PayPal', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to PayPal profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to PayPal profile.', 'ryan'),
				'id'                         => 'thinkup_header_paypalswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your PayPal page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_paypallink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_paypalswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom PayPal Icon', 'ryan'),
				'id'       => 'thinkup_header_paypaliconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_paypalswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_paypalcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_paypalswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// YouTube social settings
			array(
				'title'                      => __('YouTube', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to YouTube profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to YouTube profile.', 'ryan'),
				'id'                         => 'thinkup_header_youtubeswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your YouTube page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_youtubelink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_youtubeswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom YouTube Icon', 'ryan'),
				'id'       => 'thinkup_header_youtubeiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_youtubeswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_youtubecustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_youtubeswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Vimeo social settings
			array(
				'title'                      => __('Vimeo', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Vimeo profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Vimeo profile.', 'ryan'),
				'id'                         => 'thinkup_header_vimeoswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your Vimeo page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_vimeolink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_vimeoswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Vimeo Icon', 'ryan'),
				'id'       => 'thinkup_header_vimeoiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_vimeoswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_vimeocustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_vimeoswitch', '=', 
						array( '1' ),
					),
				)
			),

			// RSS social settings
			array(
				'title'                      => __('RSS', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to RSS profile.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to RSS profile.', 'ryan'),
				'id'                         => 'thinkup_header_rssswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input the url to your RSS page. <strong>Note:</strong> Add http:// as the url is an external link.', 'ryan'),
				'id'       => 'thinkup_header_rsslink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_rssswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				'desc'     => __('Use Custom RSS Icon', 'ryan'),
				'id'       => 'thinkup_header_rssiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_rssswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_rsscustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_rssswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Email social settings
			array(
				'title'                      => __('Email', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enable link to Email.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enable link to Email.', 'ryan'),
				'id'                         => 'thinkup_header_emailswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'desc'     => __('Input your email address. <strong>Note:</strong> Add mailto: as prefix to open link as email.', 'ryan'),
				'id'       => 'thinkup_header_emaillink',
				'type'     => 'text',
				'validate' => 'html',
				'required' => array( 
					array( 'thinkup_header_emailswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Use Custom Email Icon', 'ryan'),
				'id'       => 'thinkup_header_emailiconswitch',
				'type'     => 'checkbox',
				'default'  => '0',
				'required' => array( 
					array( 'thinkup_header_emailswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'desc'     => __('Add a link to the image or upload one from your desktop. The image will be resized.', 'ryan'),
				'id'       => 'thinkup_header_emailcustomicon',
				'type'     => 'media',
				'url'      => true,
				'required' => array( 
					array( 'thinkup_header_emailswitch', '=', 
						array( '1' ),
					), 
				)
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	5.	Blog
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Blog', 'ryan'),
		'desc'       => __('<span class="redux-title">Control Blog (Archive) Pages</span>', 'ryan'),
		'icon'       => 'el el-comment',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => true,
		'fields'     => array(

			array(
				'title'                      => __('Blog Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select blog page layout. Only applied to the main blog page and not individual posts.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select blog page layout. Only applied to the main blog page and not individual posts.', 'ryan'),
				'id'                         => 'thinkup_blog_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'ryan'), 
				$thinkup_subtitle_panel      => __('<strong>Note:</strong> Sidebars will not be applied to homepage Blog. Control sidebars on the homepage from the &#39;Home Settings&#39; option.', 'ryan'),
				$thinkup_subtitle_customizer => __('<strong>Note:</strong> Sidebars will not be applied to homepage Blog. Control sidebars on the homepage from the &#39;Home Settings&#39; option.', 'ryan'),
				'id'                         => 'thinkup_blog_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_blog_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'                      => __('Blog Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select a style for the blog page. This will also be applied to all pages set using the blog template.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a style for the blog page. This will also be applied to all pages set using the blog template.', 'ryan'),
				'id'                         => 'thinkup_blog_style',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
				),
			),

			array(
				'title'                      => __('Blog Traditional Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select a layout for your blog page. This will also be applied to all pages set using the blog template.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a layout for your blog page. This will also be applied to all pages set using the blog template.', 'ryan'),
				'id'                         => 'thinkup_blog_style1layout',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1 (Quarter Width)',
					'option2' => 'Style 2 (Full Width)',
					),
				'required'                   => array( 
					array( 'thinkup_blog_style', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Blog Grid Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select a column layout for your blog page. This will also be applied to all pages set using the blog template.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a column layout for your blog page. This will also be applied to all pages set using the blog template.', 'ryan'),
				'id'                         => 'thinkup_blog_style2layout',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => '1 column',
					'option2' => '2 column',
					'option3' => '3 column',
					'option4' => '4 column',
				),
				'required'                   => array( 
					array( 'thinkup_blog_style', '=', 
						array( 'option2' ),
					), 
				)
			),

			array(
				'title'                      => __('Blog Links', 'ryan'),
				$thinkup_subtitle_panel      => __('Choose which links to show on the post hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose which links to show on the post hover.', 'ryan'),
				'id'                         => 'thinkup_blog_hovercheck',
				'type'                       => 'checkbox',
				'options'                    => array(
					'option1' => 'Check to show lightbox link',
					'option2' => 'Check to show project link',
				),
				'default'                   => array(
					'option1' => '1', 
					'option2' => '1', 
				),
			),

			array(
				'title'   => __('Hide Post Title', 'ryan'), 
				'desc'    => __('Check to disable post title on blog page.', 'ryan'),
				'id'      => 'thinkup_blog_title',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'   => __('Blog Meta Content', 'ryan'), 
				'id'      => 'thinkup_blog_contentcheck',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Hide date posted.',
					'option2' => 'Hide post author.',
					'option3' => 'Hide total comments.',
					'option4' => 'Hide post categories.',
					'option5' => 'Hide post tags.'
				),
			),

			array(
				'title'                      => __('Post Content', 'ryan'), 
				$thinkup_subtitle_panel      => __('Control how much content you want to show from each post on the main blog page. Remember to control the full article content by using the Wordpress <a href="http://en.support.wordpress.com/splitting-content/more-tag/">more</a> tag in your post.', 'ryan'),
				$thinkup_subtitle_customizer => __('Control how much content you want to show from each post on the main blog page. Remember to control the full article content by using the Wordpress <a href="http://en.support.wordpress.com/splitting-content/more-tag/">more</a> tag in your post.', 'ryan'),
				'id'                         => 'thinkup_blog_postswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Show excerpt',
					'option2' => 'Show full article',
					'option3' => 'Hide article',
				),
			),

			array(
				'title'                      => __('Excerpt Length', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify number of words in post excerpt.<br />Default = 55.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify number of words in post excerpt.<br />Default = 55.', 'ryan'),
				'id'                         => 'thinkup_blog_postexcerpt',
				'type'                       => 'select',
				'data'                       => 'excerpt',
				'required'                   => array( 
					array( 'thinkup_blog_postswitch', '=', 
						array( 'option1' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_post_layout',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Control Single Post Page</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Post Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select blog page layout. This will only be applied to individual posts and not the main blog page.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select blog page layout. This will only be applied to individual posts and not the main blog page.', 'ryan'),
				'id'                         => 'thinkup_post_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'ryan'),
				'id'                         => 'thinkup_post_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_post_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'   => __('Post Meta Content', 'ryan'), 
				'id'      => 'thinkup_post_contentcheck',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Hide date posted.',
					'option2' => 'Hide post author.',
					'option3' => 'Hide total comments.',
					'option4' => 'Hide post categories.',
					'option5' => 'Hide post tags.',
				),
			),			

			array(
				'title'                      => __('Show Author Bio', 'ryan'), 
				$thinkup_subtitle_panel      => __('Check to enable the author biography.', 'ryan'),
				$thinkup_subtitle_customizer => __('Check to enable the author biography.', 'ryan'),
				'id'                         => 'thinkup_post_authorbio',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Show Social Sharing', 'ryan'), 
				$thinkup_subtitle_panel      => __('Check to enable social media sharing.', 'ryan'),
				$thinkup_subtitle_customizer => __('Check to enable social media sharing.', 'ryan'),
				'id'                         => 'thinkup_post_share',
				'type'                       => 'switch',
				'default'                    => '0',
			),							

			array(
				'title'                      => __('Sharing Message', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify a message to encourage sharing.<br />Leave blank to display the default message.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify a message to encourage sharing.<br />Leave blank to display the default message.', 'ryan'),
				'id'                         => 'thinkup_post_sharemessage',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_post_share', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'id'      => 'thinkup_post_sharecheck',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Enable sharing on Facebook',
					'option2' => 'Enable sharing on Twitter',
					'option3' => 'Enable sharing on Google+',
					'option4' => 'Enable sharing on LinkedIn',
					'option5' => 'Enable sharing on Tumblr',
					'option6' => 'Enable sharing on Pinterest',
					'option7' => 'Enable sharing on email',
				),
				'required' => array( 
					array( 'thinkup_post_share', '=', 
						array( '1' ),
					), 
				)
			),	
		)
	) );


	// -----------------------------------------------------------------------------------
	//	6.	Portfolio
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Portfolio', 'ryan'),
		'desc'       => __('<span class="redux-title">Portfolio Settings</span>', 'ryan'),
		'icon'       => 'el el-th',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Portfolio Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select Portfolio page layout. This will only be applied to the main portfolio page and not individual projects.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select Portfolio page layout. This will only be applied to the main portfolio page and not individual projects.', 'ryan'),
				'id'                         => 'thinkup_portfolio_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option04.png',
					'option5' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option05.png',
					'option6' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option06.png',
					'option7' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option07.png',
					'option8' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option08.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'ryan'),
				'id'                         => 'thinkup_portfolio_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_portfolio_layout', '=', 
						array( 'option5', 'option6', 'option7', 'option8' ),
					), 
				)
			),

			array(
				'title'                      => __('Portfolio Filter Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose which filter style to use.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose which filter style to use.', 'ryan'),
				'id'                         => 'thinkup_portfolio_filter',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1 (minimal)',
					'option2' => 'Style 2 (button)',
				),
			),

			array(
				'title'                      => __('Portfolio Content Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a style for the portfolio content area.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a style for the portfolio content area.', 'ryan'),
				'id'                         => 'thinkup_portfolio_contentstyleswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
				),
			),

			array(
				'title'                      => __('Portfolio Links', 'ryan'),
				$thinkup_subtitle_panel      => __('Choose which links to show on the project hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose which links to show on the project hover.', 'ryan'),
				'id'                         => 'thinkup_portfolio_hovercheck',
				'type'                       => 'checkbox',
				'options'                    => array(
					'option1' => 'Check to show lightbox link',
					'option2' => 'Check to show project link',
				),
				'default' => array(
					'option1' => '1', 
					'option2' => '1', 
				),
			),

			array(
				'title'                      => __('Portfolio Content', 'ryan'),
				$thinkup_subtitle_panel      => __('Choose which content to display below the project image.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose which content to display below the project image.', 'ryan'),
				'id'                         => 'thinkup_portfolio_check',
				'type'                       => 'checkbox',
				'options'                    => array(
					'option1' => 'Check to show project title',
					'option2' => 'Check to show project excerpt',
				),
			),

			array(
				'title'                      => __('Excerpt Length', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify number of words in project excerpt.<br />Default = Full excerpt.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify number of words in project excerpt.<br />Default = Full excerpt.', 'ryan'),
				'id'                         => 'thinkup_portfolio_excerptlength',
				'type'                       => 'select',
				'data'                       => 'excerpt',
//				'required'                   => array( 
//					array( 'thinkup_portfolio_check', '=', 
//						array( 'option2' ),
//					), 
//				)
			),

			array(
				'title'                      => __('Enable Portfolio Slider', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable portfolio slider.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable portfolio slider.', 'ryan'),
				'id'                         => 'thinkup_portfolio_sliderswitch',
				'type'                       => 'switch',
				'default' 		             => 0,
			),

			array(
				'title'                      => __('Slider Categories', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select the project category for slides.<br />(Leave blank for all).', 'ryan'),
				$thinkup_subtitle_customizer => __('Select the project category for slides.<br />(Leave blank for all).', 'ryan'),
				'id'                         => 'thinkup_portfolio_slidercategory',
				'type'                       => 'select',
				'data'                       => 'category',
				'required'                   => array( 
					array( 'thinkup_portfolio_sliderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'id'                         => 'thinkup_portfolio_sliderheight',
				'type'                       => 'slider', 
				'title'                      => __('Slider Height (Max)', 'ryan'),
				$thinkup_subtitle_panel      => __('Specify the maximum slider height (px).', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the maximum slider height (px).', 'ryan'),
				"default"                    => "300",
				"min"                        => "200",
				"step"                       => "5",
				"max"                        => "600",
				'required' => array( 
					array( 'thinkup_portfolio_sliderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Enable Featured Projects', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable featured projects.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable featured projects.', 'ryan'),
				'id'                         => 'thinkup_portfolio_featuredswitch',
				'type'                       => 'switch',
				'default' 		             => 0,
			),

			array(
				'title'                      => __('Featured Category', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select the project category for carousel.<br />(Leave blank for all).', 'ryan'),
				$thinkup_subtitle_customizer => __('Select the project category for carousel.<br />(Leave blank for all).', 'ryan'),
				'id'                         => 'thinkup_portfolio_featuredcategory',
				'type'                       => 'select',
				'data'                       => 'category',
				'required'                   => array( 
					array( 'thinkup_portfolio_featuredswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Visible Projects', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify number of visible projects in carousel.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify number of visible projects in carousel.', 'ryan'),
				'id'                         => 'thinkup_portfolio_featuredcategoryitems',
				'type'                       => 'select',
				'options'                    => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'default'                    => '2',
				'required'                   => array( 
					array( 'thinkup_portfolio_featuredswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Scroll Projects', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify number of projects to scroll on navigation.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify number of projects to scroll on navigation.', 'ryan'),
				'id'                         => 'thinkup_portfolio_featuredcategoryscroll',
				'type'                       => 'select',
				'options'                    => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				),
				'default'                     => '1',
				'required'                    => array( 
					array( 'thinkup_portfolio_featuredswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'                      => __('Portolio Redirect', 'ryan'), 
				$thinkup_subtitle_panel      => __('Redirect all project pages to the main portfolio page (www.your-site.com/portfolio)', 'ryan'),
				$thinkup_subtitle_customizer => __('Redirect all project pages to the main portfolio page (www.your-site.com/portfolio)', 'ryan'),
				'desc'                       => __('Check to disable individual project pages.', 'ryan'),
				'id'                         => 'thinkup_portfolio_redirect',
				'type'                       => 'checkbox',
				'default'                    => '0',
			),

            array(
                'id'       => 'thinkup_section_project_layout',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Project Settings</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Project Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select project layout. This will only be applied to individual project pages (I.e. Not portfolio page).', 'ryan'),
				$thinkup_subtitle_customizer => __('Select project layout. This will only be applied to individual project pages (I.e. Not portfolio page).', 'ryan'),
				'id'                         => 'thinkup_project_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => 'option1',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),					

			array(
				'title'                      => __('Select a Sidebar', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'ryan'),
				'id'                         => 'thinkup_project_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_project_layout', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'                      => __('Project Navigation', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to allow navigation between projects.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to allow navigation between projects.', 'ryan'),
				'id'                         => 'thinkup_project_navigationswitch',
				'type'                       => 'switch',
				'default' 		             => 0,
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	7.	Contact Page
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Contact Page', 'ryan'),
		'desc'       => __('<span class="redux-title">Contact Us Page</span>', 'ryan'),
		'icon'       => 'el el-envelope',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Map Address', 'ryan'), 
				$thinkup_subtitle_panel      => __('Enter the address for the map position.<br><br>You can also add a shortcode from any Maps plugin you like. Alternatively get the embed code from <a href="https://maps.google.com/" target="_blank" style="text-decoration: none;">Google Maps</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enter the address for the map position.<br><br>You can also add a shortcode from any Maps plugin you like. Alternatively get the embed code from <a href="https://maps.google.com/" target="_blank" style="text-decoration: none;">Google Maps</a>.', 'ryan'),
				'id'                         => 'thinkup_contact_map',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'   => __('Map Position', 'ryan'), 
				'id'      => 'thinkup_contact_mapposition',
				'type'    => 'select',
				'options' => array( 
					'option1' => 'Top.',
					'option2' => 'Bottom.',
				),
			),

			array(
				'title'                      => __('Contact Form Shortcode', 'ryan'), 
				$thinkup_subtitle_panel      => __('Insert contact form shortcode.', 'ryan'),
				$thinkup_subtitle_customizer => __('Insert contact form shortcode.', 'ryan'),
				'id'                         => 'thinkup_contact_form',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Company Information', 'ryan'), 
				$thinkup_subtitle_panel      => __('Add more details about your company.<br />Give more information about what you do.', 'ryan'),
				$thinkup_subtitle_customizer => __('Add more details about your company.<br />Give more information about what you do.', 'ryan'),
				'id'                         => 'thinkup_contact_info',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),

            array(
                'id'       => 'thinkup_section_contact_address',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Contact Details</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				$thinkup_subtitle_panel      => __('Address.', 'ryan'),
				$thinkup_subtitle_customizer => __('Address.', 'ryan'),
				'id'                         => 'thinkup_contact_address',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Phone.', 'ryan'),
				$thinkup_subtitle_customizer => __('Phone.', 'ryan'),
				'id'                         => 'thinkup_contact_phone',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				$thinkup_subtitle_panel      => __('Email.', 'ryan'),
				$thinkup_subtitle_customizer => __('Email.', 'ryan'),
				'msg'                        => 'Check email address is correct.',
				'id'                         => 'thinkup_contact_email',
				'type'                       => 'text',
				'validate'                   => 'email',
			),

			array(
				$thinkup_subtitle_panel      => __('Website.', 'ryan'),
				$thinkup_subtitle_customizer => __('Website.', 'ryan'),
				'id'                         => 'thinkup_contact_website',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Enable Icons', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable contact details icons.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable contact details icons.', 'ryan'),
				'id'                         => 'thinkup_contact_iconswitch',
				'type'                       => 'switch',
				'default' 		             => 0,
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	8.	Special Page
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Special Pages', 'ryan'),
		'desc'       => __('<span class="redux-title">Clients</span>', 'ryan'),
		'icon'       => 'el el-star',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'   => __('Client Redirect', 'ryan'), 
				'desc'    => __('Check to disable individual client pages.', 'ryan'),
				'id'      => 'thinkup_client_redirect',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'                      => __('Client Categories', 'ryan'), 
				$thinkup_subtitle_panel      => __('Display clients in specified categories number only, comma separated. (e.g. 21,37,41&hellip;)', 'ryan'),
				$thinkup_subtitle_customizer => __('Display clients in specified categories number only, comma separated. (e.g. 21,37,41&hellip;)', 'ryan'),
				'id'                         => 'thinkup_client_category',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

            array(
                'id'       => 'thinkup_section_special_team',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Team</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Team Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a style for the team page.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a style for the team page.', 'ryan'),
				'id'                         => 'thinkup_team_styleswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
				),
			),

			array(
				'title'                      => __('Team Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select a layout for the grid style team page.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a layout for the grid style team page.', 'ryan'),
				'id'                         => 'thinkup_team_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option04.png',
				),
			),

//			array(
//				'title'                      => __('Team Links Style', 'ryan'), 
//				$thinkup_subtitle_panel      => __('Choose a style for the team hover area.<br />Style 2 takes the theme color scheme.', 'ryan'),
//				$thinkup_subtitle_customizer => __('Choose a style for the team hover area.<br />Style 2 takes the theme color scheme.', 'ryan'),
//				'id'                         => 'thinkup_team_hoverstyleswitch',
//				'type'                       => 'radio',
//				'options'                    => array( 
//					'option1' => 'Style 1 (color overlay)',
//					'option2' => 'Style 2 (dark overlay)',
//				),
//			),

			array(
				'title'   => __('Team Content', 'ryan'), 
				'id'      => 'thinkup_team_contentcheck',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Hide name.',
					'option2' => 'Hide position.',
					'option3' => 'Hide excerpt.',
					'option4' => 'Hide social links.',
				),
			),

			array(
				'title'   => __('Team Redirect', 'ryan'), 
				'desc'    => __('Check to disable individual team pages.', 'ryan'),
				'id'      => 'thinkup_team_redirect',
				'type'    => 'checkbox',
				'default' => '0',
			),

            array(
                'id'       => 'thinkup_section_special_testimonial',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Testimonials</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Testimonal Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a style for the testimonals page.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a style for the testimonals page.', 'ryan'),
				'id'                         => 'thinkup_testimonal_styleswitch',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Style 1',
					'option2' => 'Style 2',
				),
			),

			array(
				'title'                      => __('Show Ratings', 'ryan'), 
				$thinkup_subtitle_panel      => __('Check to show testimonial ratings.', 'ryan'),
				$thinkup_subtitle_customizer => __('Check to show testimonial ratings.', 'ryan'),
				'id'                         => 'thinkup_testimonial_ratingswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Testimonal Page Links', 'ryan'), 
				$thinkup_subtitle_panel      => __('Control the links on the individual testimonials.', 'ryan'),
				$thinkup_subtitle_customizer => __('Control the links on the individual testimonials.', 'ryan'),
				'desc'                       => __('Check to disable links to individual testimonial pages.', 'ryan'),
				'id'                         => 'thinkup_testimonial_links',
				'type'                       => 'checkbox',
				'default'                    => '0',
			),

			array(
				'title'   => __('Testimonal Redirect', 'ryan'), 
				'desc'    => __('Check to disable individual testimonial pages.', 'ryan'),
				'id'      => 'thinkup_testimonial_redirect',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'                      => __('Testimonial Categories.', 'ryan'),
				$thinkup_subtitle_panel      => __('Display testimonials in specified categories number only, comma separated. (e.g. 21,37,41&hellip;)', 'ryan'),
				$thinkup_subtitle_customizer => __('Display testimonials in specified categories number only, comma separated. (e.g. 21,37,41&hellip;)', 'ryan'),
				'id'                         => 'thinkup_testimonial_category',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

            array(
                'id'       => 'thinkup_section_special_404',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">404 Error Pages</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Custom Content', 'ryan'), 
				$thinkup_subtitle_panel      => __('Overwrite the theme standard 404 error page message by adding your own HTML content.', 'ryan'),
				$thinkup_subtitle_customizer => __('Overwrite the theme standard 404 error page message by adding your own HTML content.', 'ryan'),
				'id'                         => 'thinkup_404_content',
				'type'                       => 'editor',
			),

			array(
				'desc'    => __('Check to disable autoparagraph.', 'ryan'),
				'id'      => 'thinkup_404_contentparagraph',
				'type'    => 'checkbox',
				'default' => '0',
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	9.	Notification Bar
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Notification Bar', 'ryan'),
		'desc'       => __('<span class="redux-title">Control Notification Bar</span>', 'ryan'),
		'icon'       => 'el el-bullhorn',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'   => __('Enable Notification Bar', 'ryan'), 
				'desc'    => __('Check to show notification bar on site.', 'ryan'),
				'id'      => 'thinkup_notification_switch',
				'type'    => 'checkbox',
				'default' => '0',
			),	

			array(
				'title'                      => __('Notification Bar Message', 'ryan'),
				$thinkup_subtitle_panel      => __('Enter a message for your notification bar.<br /><br />This will be one of the first things that visitors see on your site. Make it interesting to make as many visitors as possible convert.', 'ryan'),
				$thinkup_subtitle_customizer => __('Enter a message for your notification bar.<br /><br />This will be one of the first things that visitors see on your site. Make it interesting to make as many visitors as possible convert.', 'ryan'),
				'id'                         => 'thinkup_notification_text',
				'type'                       => 'textarea',
				'validate'                   => 'html',
			),			

			array(
				'title'                      => __('Button Text', 'ryan'),
				$thinkup_subtitle_panel      => __('This is some sample user description text.', 'ryan'),
				$thinkup_subtitle_customizer => __('This is some sample user description text.', 'ryan'),
				'id'                         => 'thinkup_notification_button',
				'type'                       => 'text',
				'validate'                   => 'html',
			),

			array(
				'title'                      => __('Add Button Link', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify whether the notification bar should link to a page on your site, out to external webpage disable the link altogether.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify whether the notification bar should link to a page on your site, out to external webpage disable the link altogether.', 'ryan'),
				'id'                         => 'thinkup_notification_link',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Link to a Page',
					'option2' => 'Specify Custom link',
					'option3' => 'Disable Link',
				),
			),

			array(
				'title'                      => __('Link to a page', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select a target page for action button link.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a target page for action button link.', 'ryan'),
				'id'                         => 'thinkup_notification_linkpage',
				'type'                       => 'select',
				'data'                       => 'pages',
				'required'                   => array( 
					array( 'thinkup_notification_link', '=', 
						array( 'option1' ),
					), 
				)
			),

			array(
				'title'                      => __('Custom Link', 'ryan'),
				$thinkup_subtitle_panel      => __('Input a custom url for the action button link.<br />Add http:// if linking to an external webpage.', 'ryan'),
				$thinkup_subtitle_customizer => __('Input a custom url for the action button link.<br />Add http:// if linking to an external webpage.', 'ryan'),
				'id'                         => 'thinkup_notification_linkcustom',
				'type'                       => 'text',
				'validate'                   => 'html',
				'required'                   => array( 
					array( 'thinkup_notification_link', '=', 
						array( 'option2' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_notification_positioning',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Positioning</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'   => __('Only show on homepage?', 'ryan'), 
				'desc'    => __('Check to only show on homepage.', 'ryan'),
				'id'      => 'thinkup_notification_homeswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'   => __('Fix Bar Position', 'ryan'), 
				'desc'    => __('Check to stick bar to the top of the page.', 'ryan'),
				'id'      => 'thinkup_notification_fixtop',
				'type'    => 'checkbox',
				'default' => '0',
			),

            array(
                'id'       => 'thinkup_section_notification_styling',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Styling</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'   => __('Notification Bar', 'ryan'), 
				'desc'    => __('Use custom color scheme.', 'ryan'),
				'id'      => 'thinkup_notification_backgroundcolourswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'id'       => 'thinkup_notification_backgroundcolour',
				'type'     => 'color',
				'validate' => 'color',
				'default'  => '#FFFFFF',
			),

			array(
				'title'   => __('Main Message', 'ryan'), 
				'desc'    => __('Use custom color scheme.', 'ryan'),
				'id'      => 'thinkup_notification_maintextcolourswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'id'       => 'thinkup_notification_maintextcolour',
				'type'     => 'color',
				'validate' => 'color',
				'default'  => '#FFFFFF',
			),

			array(
				'title'   => __('Button', 'ryan'), 
				'desc'    => __('Use custom color scheme.', 'ryan'),
				'id'      => 'thinkup_notification_buttoncolourswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'id'       => 'thinkup_notification_buttoncolour',
				'type'     => 'color',
				'validate' => 'color',
				'default'  => '#FFFFFF',
			),

			array(
				'title'   => __('Button Text', 'ryan'), 
				'desc'    => __('Use custom color scheme.', 'ryan'),
				'id'      => 'thinkup_notification_buttontextcolourswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'id'       => 'thinkup_notification_buttontextcolour',
				'type'     => 'color',
				'validate' => 'color',
				'default'  => '#FFFFFF',
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	11.	Search Engine Optimisation
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('SEO', 'ryan'),
		'desc'       => __('<span class="redux-title">Control Search Engine Optimization</span>', 'ryan'),
		'icon'       => 'el el-search',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Enable SEO?', 'ryan'), 
				$thinkup_subtitle_panel      => __('Check to enable SEO features.', 'ryan'),
				$thinkup_subtitle_customizer => __('Check to enable SEO features.', 'ryan'),
				'id'                         => 'thinkup_seo_switch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Home Page Title', 'ryan'), 
				$thinkup_subtitle_panel      => __('This title will only be shown on the homepage.<br />Note: Add titles to inner pages individually.', 'ryan'),
				$thinkup_subtitle_customizer => __('This title will only be shown on the homepage.<br />Note: Add titles to inner pages individually.', 'ryan'),
				'id'                         => 'thinkup_seo_sitetitle',
				'type'                       => 'text',
				'validate'                   => 'no_html',
			),

			array(
				'title'                      => __('Homepage Description', 'ryan'), 
				$thinkup_subtitle_panel      => __('Write a short and snappy description about what your site offers. This helps search engines learn more about your site.<br /><br />By default this is displayed on all pages. The description can be overwritten on individual pages.', 'ryan'),
				$thinkup_subtitle_customizer => __('Write a short and snappy description about what your site offers. This helps search engines learn more about your site.<br /><br />By default this is displayed on all pages. The description can be overwritten on individual pages.', 'ryan'),
				'id'                         => 'thinkup_seo_homedescription',
				'type'                       => 'textarea',
				'validate'                   => 'no_html',
			),

			array(
				'title'                      => __('Keywords (Comma Separated)', 'ryan'), 
				$thinkup_subtitle_panel      => __('Add keywords that are relevant for your site. This helps search engines learn more about your site.<br /><br />By default this is displayed on all pages. The keywords can be overwritten on individual pages.', 'ryan'),
				$thinkup_subtitle_customizer => __('Add keywords that are relevant for your site. This helps search engines learn more about your site.<br /><br />By default this is displayed on all pages. The keywords can be overwritten on individual pages.', 'ryan'),
				'id'                         => 'thinkup_seo_sitekeywords',
				'type'                       => 'textarea',
				'validate'                   => 'no_html',
			),

			array(
				'title'   => __('Meta Robot Tags', 'ryan'), 
				'id'      => 'thinkup_seo_metarobots',
				'type'    => 'checkbox',
				'options' => array(
					'option1' => 'Enable sitewide &#39;noodp&#39; meta tag.',
					'option2' => 'Enable sitewide &#39;noydir&#39; meta tag.',
				),
			),

            array(
                'id'       => 'thinkup_section_seo_metainfo',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( 'Learn more about how <strong><u>noodp</u></strong> and <strong><u>noydir</u></strong> tags can influence your SEO and SERP results on <a href="http://en.wikipedia.org/wiki/Meta_element">Wikipedia</a>', 'ryan' ),
                'indent'   => false,
            ),
		)
	) );	


	// -----------------------------------------------------------------------------------
	//	12.	Typography
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Typography', 'ryan'),
		'desc'       => __('<span class="redux-title">Control Font Family</span>', 'ryan'),
		'icon'       => 'el el-font',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'   => __('Body Font', 'ryan'), 
				'desc'    => __('Check to use Google fonts.', 'ryan'),
				'id'      => 'thinkup_font_bodyswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for body text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for body text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'ryan'),
				'id'                         => 'thinkup_font_bodystandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_bodyswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for body text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for body text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'ryan'),
				'id'                         => 'thinkup_font_bodygoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_bodyswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Body Headings', 'ryan'), 
				'desc'    => __('Check to use Google fonts.', 'ryan'),
				'id'      => 'thinkup_font_bodyheadingswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for header text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for header text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'ryan'),
				'id'                         => 'thinkup_font_bodyheadingstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_bodyheadingswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for header text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for header text.<br />This will <strong>NOT</strong> affect text in header or footer areas.', 'ryan'),
				'id'                         => 'thinkup_font_bodyheadinggoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_bodyheadingswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Pre Header Menu', 'ryan'), 
				'desc'    => __('Check to use Google fonts.', 'ryan'),
				'id'      => 'thinkup_font_preheaderswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for pre header text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for pre header text.', 'ryan'),
				'id'                         => 'thinkup_font_preheaderstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_preheaderswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for pre header text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for pre header text.', 'ryan'),
				'id'                         => 'thinkup_font_preheadergoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Main Header Menu', 'ryan'), 
				'desc'    => __('Check to use Google fonts.', 'ryan'),
				'id'      => 'thinkup_font_mainheaderswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for main header text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for main header text.', 'ryan'),
				'id'                         => 'thinkup_font_mainheaderstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_mainheaderswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for main header text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for main header text.', 'ryan'),
				'id'                         => 'thinkup_font_mainheadergoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_mainheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Footer Headings', 'ryan'), 
				'desc'    => __('Check to use Google fonts.', 'ryan'),
				'id'      => 'thinkup_font_footerheadingswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for body text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for body text.', 'ryan'),
				'id'                         => 'thinkup_font_footerheadingstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_footerheadingswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for body text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for body text.', 'ryan'),
				'id'                         => 'thinkup_font_footerheadinggoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_footerheadingswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Main Footer Menu', 'ryan'), 
				'desc'    => __('Check to use Google fonts.', 'ryan'),
				'id'      => 'thinkup_font_mainfooterswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for footer menu text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for footer menu text.', 'ryan'),
				'id'                         => 'thinkup_font_mainfooterstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_mainfooterswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for footer menu text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for footer menu text.', 'ryan'),
				'id'                         => 'thinkup_font_mainfootergoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_mainfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Post Footer Menu', 'ryan'), 
				'desc'    => __('Check to use Google fonts.', 'ryan'),
				'id'      => 'thinkup_font_postfooterswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for post footer text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for post footer text.', 'ryan'),
				'id'                         => 'thinkup_font_postfooterstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_postfooterswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for post footer text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for post footer text.', 'ryan'),
				'id'                         => 'thinkup_font_postfootergoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Slider Title', 'ryan'), 
				'desc'    => __('Check to use Google fonts.', 'ryan'),
				'id'      => 'thinkup_font_slidertitleswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for the slider title.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for the slider title.', 'ryan'),
				'id'                         => 'thinkup_font_slidertitlestandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_slidertitleswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for the slider title.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for the slider title.', 'ryan'),
				'id'                         => 'thinkup_font_slidertitlegoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_slidertitleswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				'title'   => __('Slider Description', 'ryan'), 
				'desc'    => __('Check to use Google fonts.', 'ryan'),
				'id'      => 'thinkup_font_slidertextswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Standard Font" for the slider description.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Standard Font" for the slider description.', 'ryan'),
				'id'                         => 'thinkup_font_slidertextstandard',
				'type'                       => 'select',
				'data'                       => 'standardfont',
				'required'                   => array( 
					array( 'thinkup_font_slidertextswitch', '!=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Select a "Google Font" for the slider description.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select a "Google Font" for the slider description.', 'ryan'),
				'id'                         => 'thinkup_font_slidertextgoogle',
				'type'                       => 'select',
				'data'                       => 'googlefont',
				'required'                   => array( 
					array( 'thinkup_font_slidertextswitch', '=', 
						array( '1' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_font_size',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">Control Font Size</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Body Font', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the body font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the body font size.', 'ryan'),
				'id'                         => 'thinkup_font_bodysize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H1 Heading', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the h1 heading font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the h1 heading font size.', 'ryan'),
				'id'                         => 'thinkup_font_h1size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H2 Heading', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the h2 heading font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the h2 heading font size.', 'ryan'),
				'id'                         => 'thinkup_font_h2size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H3 Heading', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the h3 heading font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the h3 heading font size.', 'ryan'),
				'id'                         => 'thinkup_font_h3size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H4 Heading', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the h4 heading font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the h4 heading font size.', 'ryan'),
				'id'                         => 'thinkup_font_h4size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H5 Heading', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the h5 heading font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the h5 heading font size.', 'ryan'),
				'id'                         => 'thinkup_font_h5size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('H6 Heading', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the h6 heading font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the h6 heading font size.', 'ryan'),
				'id'                         => 'thinkup_font_h6size',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Sidebar Widget Heading', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the sidebar widget heading font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the sidebar widget heading font size.', 'ryan'),
				'id'                         => 'thinkup_font_sidebarsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('Pre Header Menu', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the pre header font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the pre header font size.', 'ryan'),
				'id'                         => 'thinkup_font_preheadersize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Pre Header Menu (Dropdown)', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the pre header dropdown font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the pre header dropdown font size.', 'ryan'),
				'id'                         => 'thinkup_font_preheadersubsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Main Header Menu', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the main header font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the main header font size.', 'ryan'),
				'id'                         => 'thinkup_font_mainheadersize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Main Header Menu (Dropdown)', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the main header dropdown font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the main header dropdown font size.', 'ryan'),
				'id'                         => 'thinkup_font_mainheadersubsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Footer Headings', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the footer heading font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the footer heading font size.', 'ryan'),
				'id'                         => 'thinkup_font_footerheadingsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Main Footer Menu', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the main footer font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the main footer font size.', 'ryan'),
				'id'                         => 'thinkup_font_mainfootersize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),				

			array(
				'title'                      => __('Post Footer Menu', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the post footer font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the post footer font size.', 'ryan'),
				'id'                         => 'thinkup_font_postfootersize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('Slider Title', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the slider title font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the slider title font size.', 'ryan'),
				'id'                         => 'thinkup_font_slidertitlesize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),

			array(
				'title'                      => __('Slider Description', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the slider description font size.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the slider description font size.', 'ryan'),
				'id'                         => 'thinkup_font_slidertextsize',
				'type'                       => 'select',
				'data'                       => 'fontsize',
			),
		)
	) );	


	// -----------------------------------------------------------------------------------
	//	13.	Custom Styling
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Custom Styling', 'ryan'),
		'desc'       => __('<span class="redux-title">Advanced Custom Styling</span>', 'ryan'),
		'icon'       => 'el el-eye-open',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			// Main Content
			array(
				'title'                      => __('Main Content', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable main content area styling.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable main content area styling.', 'ryan'),
				'id'                         => 'thinkup_styles_mainswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				'id'                         => 'thinkup_styles_mainimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_mainposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_mainrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_mainsize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required' => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_mainattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required' => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background color.', 'ryan'),
				'id'                         => 'thinkup_styles_mainbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Headings (h1, h2, h3, etc&hellip;)', 'ryan'),
				$thinkup_subtitle_customizer => __('Headings (h1, h2, h3, etc&hellip;)', 'ryan'),
				'id'                         => 'thinkup_styles_mainheading',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Body text.', 'ryan'),
				$thinkup_subtitle_customizer => __('Body text.', 'ryan'),
				'id'                         => 'thinkup_styles_maintext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Body links.', 'ryan'),
				$thinkup_subtitle_customizer => __('Body links.', 'ryan'),
				'id'                         => 'thinkup_styles_mainlink',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Body links - Hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Body links - Hover.', 'ryan'),
				'id'                         => 'thinkup_styles_mainlinkhover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_mainswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Pre Header Styling
			array(
				'title'                      => __('Pre Header', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom pre-header styling.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom pre-header styling.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_preheadersize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required' => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed" => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Text color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Text color.', 'ryan'),
				'id'                         => 'thinkup_styles_preheadertext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Text color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Text color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_preheadertexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderdropbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderdropbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderdroptext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderdroptexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Border color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Border color.', 'ryan'),
				'id'                         => 'thinkup_styles_preheaderdropborder',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_preheaderswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Main Header Styling
			array(
				'title'                      => __('Header', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom header styling.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom header styling.', 'ryan'),
				'id'                         => 'thinkup_styles_headerswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				'id'                         => 'thinkup_styles_headerimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_headerposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_headerrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_headersize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required' => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_headerattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color.', 'ryan'),
				'id'                         => 'thinkup_styles_headerbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_headerbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Site Title.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Site Title.', 'ryan'),
				'id'                         => 'thinkup_styles_headersitetitle',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Site Description.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Site Description.', 'ryan'),
				'id'                         => 'thinkup_styles_headersitedescription',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Text color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Text color.', 'ryan'),
				'id'                         => 'thinkup_styles_headertext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Text color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Top tier menu - Text color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_headertexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color.', 'ryan'),
				'id'                         => 'thinkup_styles_headerdropbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_headerdropbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color.', 'ryan'),
				'id'                         => 'thinkup_styles_headerdroptext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_headerdroptexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Border color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Border color.', 'ryan'),
				'id'                         => 'thinkup_styles_headerdropborder',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerswitch', '=', 
						array( '1' ),
					), 
				)
			),							

			// Header (Responsive) Styling
			array(
				'title'                      => __('Header (Responsive)', 'alante'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom responsive header styling.', 'alante'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom responsive header styling.', 'alante'),
				'id'                         => 'thinkup_styles_headerresswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color.', 'alante'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color.', 'alante'),
				'id'                         => 'thinkup_styles_headerresbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Background color on hover.', 'alante'),
				$thinkup_subtitle_customizer => __('Top tier menu - Background color on hover.', 'alante'),
				'id'                         => 'thinkup_styles_headerresbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Icon color.', 'alante'),
				$thinkup_subtitle_customizer => __('Top tier menu - Icon color.', 'alante'),
				'id'                         => 'thinkup_styles_headerresbgicon',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Top tier menu - Icon color on hover.', 'alante'),
				$thinkup_subtitle_customizer => __('Top tier menu - Icon color on hover.', 'alante'),
				'id'                         => 'thinkup_styles_headerresbgiconhover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color.', 'alante'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color.', 'alante'),
				'id'                         => 'thinkup_styles_headerresdropbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Background color on hover.', 'alante'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Background color on hover.', 'alante'),
				'id'                         => 'thinkup_styles_headerresdropbghover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color.', 'alante'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color.', 'alante'),
				'id'                         => 'thinkup_styles_headerresdroptext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Text color on hover.', 'alante'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Text color on hover.', 'alante'),
				'id'                         => 'thinkup_styles_headerresdroptexthover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),				

			array(
				$thinkup_subtitle_panel      => __('Dropdown menu - Border color.', 'alante'),
				$thinkup_subtitle_customizer => __('Dropdown menu - Border color.', 'alante'),
				'id'                         => 'thinkup_styles_headerresdropborder',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_headerresswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Page Intro Styling
			array(
				'title'                      => __('Page Intro', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable page intro custom styling.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable page intro custom styling.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintroswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintroimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintroposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintrorepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintrosize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required' => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintroattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background color.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintrobg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Page Title - Text color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Page Title - Text color.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintrotext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Breadcrumbs - Text color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Breadcrumbs - Text color.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintrobreadcrumbtext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Breadcrumbs - Link color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Breadcrumbs - Link color.', 'ryan'),
				'id'                         => 'thinkup_styles_pageintrobreadcrumblink',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_pageintroswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Main Footer Styling
			array(
				'title'                      => __('Footer', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom footer styling.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom footer styling.', 'ryan'),
				'id'                         => 'thinkup_styles_footerswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				'id'                         => 'thinkup_styles_footerimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_footerposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_footerrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_footersize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_footerattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background color.', 'ryan'),
				'id'                         => 'thinkup_styles_footerbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Title color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Title color.', 'ryan'),
				'id'                         => 'thinkup_styles_footertitle',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Text color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Text color.', 'ryan'),
				'id'                         => 'thinkup_styles_footertext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Link color.', 'ryan'),
				'id'                         => 'thinkup_styles_footerlink',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Link color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_footerlinkhover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_footerswitch', '=', 
						array( '1' ),
					), 
				)
			),

			// Post Footer Styling
			array(
				'title'                      => __('Post-Footer', 'ryan'), 
				$thinkup_subtitle_panel      => __('Switch on to enable custom post-footer styling.', 'ryan'),
				$thinkup_subtitle_customizer => __('Switch on to enable custom post-footer styling.', 'ryan'),
				'id'                         => 'thinkup_styles_postfooterswitch',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				$thinkup_subtitle_panel      => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Upload an image to use as background.<br />Leave blank to use custom color.', 'ryan'),
				'id'                         => 'thinkup_styles_postfooterimage',
				'type'                       => 'media',
				'url'                        => true,
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Position. Find out more <a href="http://www.w3schools.com/cssref/pr_background-position.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_postfooterposition',
				'type'                       => 'select',
				'options'                    => array( 
					'left top'      => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom'
				),
				'required' => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Repeat. Find out more <a href="http://www.w3schools.com/cssref/pr_background-repeat.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_postfooterrepeat',
				'type'                       => 'select',
				'options'                    => array( 
					"repeat"    => "repeat",
					"repeat-x"  => "repeat-x",
					"repeat-y"  => "repeat-y",
					"no-repeat" => "no-repeat"
				),
				'required' => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background Size? Find out more <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_postfootersize',
				'type'                       => 'select',
				'options'                    => array( 
					"auto"      => "auto",
					"cover"     => "cover",
					"constrain" => "constrain"
				),
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				$thinkup_subtitle_customizer => __('Fix background or scroll? Find out more <a href="http://www.w3schools.com/cssref/pr_background-attachment.asp">here</a>.', 'ryan'),
				'id'                         => 'thinkup_styles_postfooterattachment',
				'type'                       => 'select',
				'options'                    => array( 
					"scroll" => "scroll",
					"fixed"  => "fixed"
				),
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Background color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Background color.', 'ryan'),
				'id'                         => 'thinkup_styles_postfooterbg',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Text color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Text color.', 'ryan'),
				'id'                         => 'thinkup_styles_postfootertext',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link color.', 'ryan'),
				$thinkup_subtitle_customizer => __('Link color.', 'ryan'),
				'id'                         => 'thinkup_styles_postfooterlink',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),

			array(
				$thinkup_subtitle_panel      => __('Link color on hover.', 'ryan'),
				$thinkup_subtitle_customizer => __('Link color on hover.', 'ryan'),
				'id'                         => 'thinkup_styles_postfooterlinkhover',
				'type'                       => 'color',
				'validate'                   => 'color',
				'default'                    => '#FFFFFF',
				'required'                   => array( 
					array( 'thinkup_styles_postfooterswitch', '=', 
						array( '1' ),
					), 
				)
			),
		)
	) );


	//-----------------------------------------------------------------------------------
	//	14.	Translation
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('Translation', 'ryan'),
		'desc'       => __('<span class="redux-title">Blog Page</span>', 'ryan'),
		'icon'       => 'el el-quotes',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Read More Button', 'ryan'), 
				$thinkup_subtitle_panel      => __('Leave blank to display default: "Read More".', 'ryan'),
				$thinkup_subtitle_customizer => __('Leave blank to display default: "Read More".', 'ryan'),
				'id'                         => 'thinkup_translate_blogreadmore',
				'type'                       => 'text',
				'validate'                   => 'no_html',
			),

//            array(
//                'id'       => 'thinkup_section_translate_contact',
//                'type'     => $thinkup_section_field,
//                'title'    => __( ' ', 'ryan' ),
//                'subtitle' => __( '<span class="redux-title">Template - Contact</span>', 'ryan' ),
//                'indent'   => false,
//            ),

//			array(
//				'title'                      => __('Contact Form Title', 'ryan'), 
//				$thinkup_subtitle_panel      => __('Leave blank to display default: "Send a message".', 'ryan'),
//				$thinkup_subtitle_customizer => __('Leave blank to display default: "Send a message".', 'ryan'),
//				'id'                         => 'thinkup_translate_contactformtitle',
//				'type'                       => 'text',
//				'validate'                   => 'no_html',
//			),

//			array(
//				'title'                      => __('Company Information Title', 'ryan'), 
//				$thinkup_subtitle_panel      => __('Leave blank to display default: "About Us".', 'ryan'),
//				$thinkup_subtitle_customizer => __('Leave blank to display default: "About Us".', 'ryan'),
//				'id'                         => 'thinkup_translate_contactabouttitle',
//				'type'                       => 'text',
//				'validate'                   => 'no_html',
//			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	14.	WooCommerce
	// -----------------------------------------------------------------------------------

	Redux::setSection( $opt_name, array(
		'title'      => __('WooCommerce', 'ryan'),
		'desc'       => __('<span class="redux-title">WooCommerce Settings</span>', 'ryan'),
		'icon'       => 'el el-shopping-cart',
		'icon_class' => '',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

			array(
				'title'                      => __('Enable Theme Specific Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Check to enable theme specific WooCommerce style.', 'ryan'),
				$thinkup_subtitle_customizer => __('Check to enable theme specific WooCommerce style.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_styleswitch',
				'type'                       => 'switch',
				'default'                    => '1',
			),

			array(
				'title'                      => __('Shop Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select shop page layout. This will only be applied to the main shop page and not individual products.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select shop page layout. This will only be applied to the main shop page and not individual products.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_layout',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option03.png',
					'option4' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option04.png',
					'option5' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option05.png',
					'option6' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option06.png',
					'option7' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option07.png',
					'option8' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option08.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the layout.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_sidebars',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_woocommerce_layout', '=', 
						array( 'option5', 'option6', 'option7', 'option8' ),
					), 
				)
			),

			array(
				'title'                      => __('Products Per Page', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the number of products per page on the shop page.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the number of products per page on the shop page.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_countshop',
				'type'                       => 'select',
				'options'                    => array(
					'2'  => '2',
					'3'  => '3',
					'4'  => '4',
					'5'  => '5',
					'6'  => '6',
					'7'  => '7',
					'8'  => '8',
					'9'  => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20',
				),
			),

			array(
				'title'                      => __('Product Meta Content', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose which meta content to display on the shop page.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose which meta content to display on the shop page.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_contentcheck',
				'type'                       => 'checkbox',
				'options'                    => array(
//					'option1' => 'Enable "Quick View".',
					'option2' => 'Enable lightbox.',
					'option3' => 'Enable likes.',
//					'option4' => 'Enable social sharing.',
				),
			),

			array(
				'title'                      => __('Product Excerpt', 'ryan'), 
				$thinkup_subtitle_panel      => __('Check to enable product excerpt.', 'ryan'),
				$thinkup_subtitle_customizer => __('Check to enable product excerpt.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_excerptshop',
				'type'                       => 'switch',
				'default'                    => '0',
			),

			array(
				'title'                      => __('Excerpt Length', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify number of words in product excerpt.<br />Default = Full excerpt.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify number of words in product excerpt.<br />Default = Full excerpt.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_excerptlength',
				'type'                       => 'select',
				'data'                       => 'excerpt',
				'required'                   => array( 
					array( 'thinkup_woocommerce_excerptshop', '=', 
						array( '1' ),
					), 
				)
			),

            array(
                'id'       => 'thinkup_section_woo_products',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">WooCommerce Product Page</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Product Page Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select page layout. This will only be applied to published Pages (I.e. Not posts, blog or home).', 'ryan'),
				$thinkup_subtitle_customizer => __('Select page layout. This will only be applied to published Pages (I.e. Not posts, blog or home).', 'ryan'),
				'id'                         => 'thinkup_woocommerce_layoutproduct',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'default'                    => '0',
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option01.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option02.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/blog/option03.png',
				),
			),

			array(
				'title'                      => __('Select a Sidebar', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a sidebar to use with the page layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a sidebar to use with the page layout.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_sidebarsproduct',
				'type'                       => 'select',
				'data'                       => 'sidebars',
				'required'                   => array( 
					array( 'thinkup_woocommerce_layoutproduct', '=', 
						array( 'option2', 'option3' ),
					), 
				)
			),

			array(
				'title'                      => __('Meta Content', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose which meta content to display on the product page.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose which meta content to display on the product page.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_contentcheckproduct',
				'type'                       => 'checkbox',
				'options'                    => array(
					'option1' => 'Enable likes.',
//					'option2' => 'Enable social sharing.',
				),
			),

			array(
				'title'                      => __('Variation Style', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose a variation style.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose a variation style.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_variation',
				'type'                       => 'radio',
				'options'                    => array( 
					'option1' => 'Dropdown', 
					'option2' => 'Buttons',
				),
			),

			array(
				'title'   => __('Hide Variation Title', 'ryan'), 
				'desc'    => __('Check to hide variation titles.', 'ryan'),
				'id'      => 'thinkup_woocommerce_variationtitle',
				'type'    => 'checkbox',
				'default' => '0',
			),

			array(
				'title'   => __('Hide SKU ID', 'ryan'), 
				'desc'    => __('Check to hide SKU ID.', 'ryan'),
				'id'      => 'thinkup_woocommerce_skuswitch',
				'type'    => 'checkbox',
				'default' => '0',
			),

            array(
                'id'       => 'thinkup_section_woo_related',
                'type'     => $thinkup_section_field,
                'title'    => __( ' ', 'ryan' ),
                'subtitle' => __( '<span class="redux-title">WooCommerce Product Page - Related Products</span>', 'ryan' ),
                'indent'   => false,
            ),

			array(
				'title'                      => __('Related Products Layout', 'ryan'), 
				$thinkup_subtitle_panel      => __('Select related products layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Select related products layout.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_layoutrelated',
				'type'                       => 'image_select',
				'compiler'                   => true,
				'options'                    => array(
					'option1' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option02.png',
					'option2' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option03.png',
					'option3' => trailingslashit( get_template_directory_uri() ) . 'admin/main/assets/img/layout/portfolio/option04.png',
				),
			),

			array(
				'title'                      => __('Number of Related Products', 'ryan'), 
				$thinkup_subtitle_panel      => __('Specify the number of related products to be shown on the products layout.', 'ryan'),
				$thinkup_subtitle_customizer => __('Specify the number of related products to be shown on the products layout.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_countrelated',
				'type'                       => 'select',
				'options'                    => array(
					'2'  => '2',
					'3'  => '3',
					'4'  => '4',
					'5'  => '5',
					'6'  => '6',
					'7'  => '7',
					'8'  => '8',
					'9'  => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12',
				),
			),

			array(
				'title'                      => __('Product Meta Content', 'ryan'), 
				$thinkup_subtitle_panel      => __('Choose which meta content to display for the related products.', 'ryan'),
				$thinkup_subtitle_customizer => __('Choose which meta content to display for the related products.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_contentcheckrelated',
				'type'                       => 'checkbox',
				'options'                    => array(
//					'option1' => 'Enable "Quick View".',
					'option2' => 'Enable lightbox.',
					'option3' => 'Enable likes.',
//					'option4' => 'Enable social sharing.',
				),
			),

			array(
				'title'                      => __('Product Excerpt', 'ryan'), 
				$thinkup_subtitle_panel      => __('Check to enable product excerpt.', 'ryan'),
				$thinkup_subtitle_customizer => __('Check to enable product excerpt.', 'ryan'),
				'id'                         => 'thinkup_woocommerce_excerptrelated',
				'type'                       => 'switch',
				'default'                    => '0',
			),
		)
	) );


	// -----------------------------------------------------------------------------------
	//	15.	Support
	// -----------------------------------------------------------------------------------

    Redux::setSection( $opt_name, array(
		'title'      => __('Support', 'ryan'),
		'desc'       => __('<span class="redux-title">Documentation</span><p>We&#39;ve produced a detailed demo of each theme where most of the common questions can be found such as how to use shortcodes and setup basic page layouts. To find out more visit us at <a href="http://www.thinkupthemes.com/" target="_blank">www.thinkupthemes.com</a> and check the information pages of the demo theme your using.</p><p>This theme also comes with a detailed user manual which should help answer all your common questions.</p>', 'ryan'),
		'icon'       => 'el el-user',
		'icon_class' => '',
        'id'         => 'thinkup_section_support',
        'subsection' => $thinkup_customizer_subsection,
        'customizer' => false,
		'fields'     => array(

            array(
                'id'                         => 'thinkup_section_support_info',
                'type'                       => $thinkup_section_field,
				$thinkup_subtitle_panel      => __('<span class="redux-title">Ticket Support</span><p>Don&#39;t panic! If you can&#39;t find the answer in the theme documentation then please submit a support ticket. These tickets are dealt with by the guys that built the theme so will definitely be able to help!</p><p>Just submit a support ticket at <a href="http://www.thinkupthemes.com/support/" target="_blank">www.thinkupthemes.com/support</a></p>', 'ryan'),
				$thinkup_subtitle_customizer => __('<span class="redux-title">Ticket Support</span><p>Don&#39;t panic! If you can&#39;t find the answer in the theme documentation then please submit a support ticket. These tickets are dealt with by the guys that built the theme so will definitely be able to help!</p><p>Just submit a support ticket at <a href="http://www.thinkupthemes.com/support/" target="_blank">www.thinkupthemes.com/support</a></p>', 'ryan'),
                'indent'                     => false,
            ),
		)
	) );


    Redux::setSection( $opt_name, array(
		'type' => 'divide',
	) );


    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=> true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

