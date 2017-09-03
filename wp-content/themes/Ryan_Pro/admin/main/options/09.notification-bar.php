<?php
/**
 * Notification bar functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	ENABLE NOTIFICATION BAR
---------------------------------------------------------------------------------- */

/* Input page structure for html */
function thinkup_notification_html() {
global $thinkup_notification_switch;
global $thinkup_notification_text;
global $thinkup_notification_button;
global $thinkup_notification_link;
global $thinkup_notification_linkpage;
global $thinkup_notification_linkcustom;

	if ( $thinkup_notification_switch == '1' ) {
	echo '<div id="notification"><div id="notification-core">';

		echo '<span class="notification-text">';
		echo wp_kses_post( $thinkup_notification_text );
		echo '</span>';

		if ( ! empty( $thinkup_notification_button ) ) {
					if ( $thinkup_notification_link == 'option1' and $thinkup_notification_linkpage !== 'Select a page:' ) {
						echo '<a href="' . esc_url( get_permalink( $thinkup_notification_linkpage ) ) . '"><span class="notification-button">';
						echo esc_html( $thinkup_notification_button );
						echo '</span></a>';
					} else if ( $thinkup_notification_link == 'option2' ) {
						echo '<a href="' . esc_url( $thinkup_notification_linkcustom ) . '"><span class="notification-button">';
						echo esc_html( $thinkup_notification_button );
						echo '</span></a>';
					} else {
						echo '<span class="notification-button">';
						echo esc_html( $thinkup_notification_button );
						echo '</span>';
					}
		}
	echo '</div></div>' . "\n";
	}
}

/* Input custom css if user has set the values */
function thinkup_notification_css() {
global $thinkup_notification_backgroundcolourswitch;
global $thinkup_notification_maintextcolourswitch;
global $thinkup_notification_buttoncolourswitch;
global $thinkup_notification_buttontextcolourswitch;
global $thinkup_notification_backgroundcolour;
global $thinkup_notification_maintextcolour;
global $thinkup_notification_buttoncolour;
global $thinkup_notification_buttontextcolour;
global $thinkup_notification_fixtop;

	if ( ! empty( $thinkup_notification_backgroundcolour ) or $thinkup_notification_fixtop == '1' ) {
		echo	"\n" . '<style type="text/css">' . "\n";
			if ( ! empty( $thinkup_notification_backgroundcolour ) and $thinkup_notification_backgroundcolourswitch == '1' ) {
				echo	'#notification { background: ' . esc_html( $thinkup_notification_backgroundcolour ) . ' }' . "\n";
			}
			if ( ! empty( $thinkup_notification_maintextcolour ) and $thinkup_notification_maintextcolourswitch == '1' ) {
				echo	'#notification-core { color: ' . esc_html( $thinkup_notification_maintextcolour ) . ' }' . "\n";
			}
			if ( ! empty( $thinkup_notification_buttoncolour ) and $thinkup_notification_buttoncolourswitch == '1' ) {
				echo	'#notification-core .notification-button { background: ' . esc_html( $thinkup_notification_buttoncolour ) . ' }' . "\n";
			}
			if ( ! empty( $thinkup_notification_buttontextcolour ) and $thinkup_notification_buttontextcolourswitch == '1' ) {
				echo	'#notification-core .notification-button { color: ' . esc_html( $thinkup_notification_buttontextcolour ) . ' }' . "\n";
				echo	'#notification-core .notification-button a { color: ' . esc_html( $thinkup_notification_buttontextcolour ) . ' }' . "\n";
			}
			if ( $thinkup_notification_fixtop == '1' ) {
				echo	'#notification { position: fixed }' . "\n";
				echo	'#body-core { padding-top: 31px }' . "\n";
			}
		echo	'</style>' . "\n";
	}
}

/* Add notification bar to page */
function thinkup_input_notification() {
global $thinkup_notification_switch;
global $thinkup_notification_homeswitch;

	if ( $thinkup_notification_switch == '1' and $thinkup_notification_homeswitch == '1' and is_front_page() ) {
		thinkup_notification_html();
	} else if ( $thinkup_notification_switch == '1' and $thinkup_notification_homeswitch !== '1' ) {
		thinkup_notification_html();
	} else if ( $thinkup_notification_switch !== '1' ) {
		echo '';
	}
}

/* Add custom css to page */
function thinkup_input_notificationcss() {
global $thinkup_notification_switch;
global $thinkup_notification_homeswitch;

	if ( $thinkup_notification_switch == '1' and $thinkup_notification_homeswitch == '1' and is_front_page() ) {
		thinkup_notification_css();
	} else if ( $thinkup_notification_switch == '1' and $thinkup_notification_homeswitch !== '1' ) {
		thinkup_notification_css();
	} else if ( $thinkup_notification_switch !== '1' ) {
		echo '';
	}
}
add_action( 'wp_head','thinkup_input_notificationcss');


?>