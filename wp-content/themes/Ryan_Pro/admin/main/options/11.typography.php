<?php
/**
 * Typography functions.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	INPUT GOOGLE FONTS CSS
---------------------------------------------------------------------------------- */

function thinkup_input_googlefamilycss() {
global $thinkup_font_bodyswitch;
global $thinkup_font_bodygoogle;
global $thinkup_font_bodyheadingswitch;
global $thinkup_font_bodyheadinggoogle;
global $thinkup_font_footerheadingswitch;
global $thinkup_font_footerheadinggoogle;
global $thinkup_font_preheaderswitch;
global $thinkup_font_preheadergoogle;
global $thinkup_font_mainheaderswitch;
global $thinkup_font_mainheadergoogle;
global $thinkup_font_mainfooterswitch;
global $thinkup_font_mainfootergoogle;
global $thinkup_font_postfooterswitch;
global $thinkup_font_postfootergoogle;
global $thinkup_font_slidertitleswitch;
global $thinkup_font_slidertitlegoogle;
global $thinkup_font_slidertextswitch;
global $thinkup_font_slidertextgoogle;

	$thinkup_font_bodygoogle            =   str_replace( ' ', '+', $thinkup_font_bodygoogle );
	$thinkup_font_bodyheadinggoogle     =   str_replace( ' ', '+', $thinkup_font_bodyheadinggoogle );
	$thinkup_font_footerheadinggoogle   =   str_replace( ' ', '+', $thinkup_font_footerheadinggoogle );
	$thinkup_font_preheadergoogle       =   str_replace( ' ', '+', $thinkup_font_preheadergoogle );
	$thinkup_font_mainheadergoogle      =   str_replace( ' ', '+', $thinkup_font_mainheadergoogle );
	$thinkup_font_mainfootergoogle      =   str_replace( ' ', '+', $thinkup_font_mainfootergoogle );
	$thinkup_font_postfootergoogle      =   str_replace( ' ', '+', $thinkup_font_postfootergoogle );
	$thinkup_font_slidertitlegoogle     =   str_replace( ' ', '+', $thinkup_font_slidertitlegoogle );
	$thinkup_font_slidertextgoogle      =   str_replace( ' ', '+', $thinkup_font_slidertextgoogle );

	if ( $thinkup_font_bodyswitch == '1' or $thinkup_font_bodyheadingswitch == '1' or $thinkup_font_footerheadingswitch == '1' or $thinkup_font_preheaderswitch == '1' or $thinkup_font_mainheaderswitch == '1' or $thinkup_font_mainfooterswitch == '1' or $thinkup_font_postfooterswitch == '1' or $thinkup_font_slidertitleswitch == '1' or $thinkup_font_slidertextswitch == '1' ) {
		echo 	"\n" . '<link href="//fonts.googleapis.com/css?family=';
			if ( $thinkup_font_bodyswitch == '1' and $thinkup_font_bodygoogle !== 'Select+a+Google+Font' ) {
				echo	$thinkup_font_bodygoogle . ':300,400,600,700|';
			}
			if ( $thinkup_font_bodyheadingswitch == '1' and $thinkup_font_bodyheadinggoogle !== 'Select+a+Google+Font' ) {
				echo	$thinkup_font_bodyheadinggoogle . ':300,400,600,700|';
			}
			if ( $thinkup_font_footerheadingswitch == '1' and $thinkup_font_footerheadinggoogle !== 'Select+a+Google+Font' ) {
				echo	$thinkup_font_footerheadinggoogle . ':300,400,600,700|';
			}
			if ( $thinkup_font_preheaderswitch == '1' and $thinkup_font_preheadergoogle !== 'Select+a+Google+Font' ) {
				echo	$thinkup_font_preheadergoogle . ':300,400,600,700|';
			}
			if ( $thinkup_font_mainheaderswitch == '1' and $thinkup_font_mainheadergoogle !== 'Select+a+Google+Font' ) {
				echo	$thinkup_font_mainheadergoogle . ':300,400,600,700|';
			}
			if ( $thinkup_font_mainfooterswitch == '1' and $thinkup_font_mainfootergoogle !== 'Select+a+Google+Font' ) {
				echo	$thinkup_font_mainfootergoogle . ':300,400,600,700|';
			}
			if ( $thinkup_font_postfooterswitch == '1' and $thinkup_font_postfootergoogle !== 'Select+a+Google+Font' ) {
				echo	$thinkup_font_postfootergoogle . ':300,400,600,700|';
			}

			if ( $thinkup_font_slidertitleswitch == '1' and $thinkup_font_slidertitlegoogle !== 'Select+a+Google+Font' ) {
				echo	$thinkup_font_slidertitlegoogle . ':300,400,600,700|';
			}
			if ( $thinkup_font_slidertextswitch == '1' and $thinkup_font_slidertextgoogle !== 'Select+a+Google+Font' ) {
				echo	$thinkup_font_slidertextgoogle . ':300,400,600,700|';
			}

		echo	'" rel="stylesheet" type="text/css">' . "\n";
	}
}
add_action( 'wp_head', 'thinkup_input_googlefamilycss', 11 );


/* ----------------------------------------------------------------------------------
	INPUT FONT FAMILY CSS
---------------------------------------------------------------------------------- */

function thinkup_input_fontfamily() {
global $thinkup_font_bodyswitch;
global $thinkup_font_bodystandard;
global $thinkup_font_bodygoogle;
global $thinkup_font_bodyheadingswitch;
global $thinkup_font_bodyheadingstandard;
global $thinkup_font_bodyheadinggoogle;
global $thinkup_font_footerheadingswitch;
global $thinkup_font_footerheadingstandard;
global $thinkup_font_footerheadinggoogle;
global $thinkup_font_preheaderswitch;
global $thinkup_font_preheaderstandard;
global $thinkup_font_preheadergoogle;
global $thinkup_font_mainheaderswitch;
global $thinkup_font_mainheaderstandard;
global $thinkup_font_mainheadergoogle;
global $thinkup_font_mainfooterswitch;
global $thinkup_font_mainfooterstandard;
global $thinkup_font_mainfootergoogle;
global $thinkup_font_postfooterswitch;
global $thinkup_font_postfooterstandard;
global $thinkup_font_postfootergoogle;
global $thinkup_font_slidertitleswitch;
global $thinkup_font_slidertitlestandard;
global $thinkup_font_slidertitlegoogle;
global $thinkup_font_slidertextswitch;
global $thinkup_font_slidertextstandard;
global $thinkup_font_slidertextgoogle;

	$thinkup_font_bodygoogle            =   str_replace( '+', ' ', $thinkup_font_bodygoogle );
	$thinkup_font_bodyheadinggoogle     =   str_replace( '+', ' ', $thinkup_font_bodyheadinggoogle );
	$thinkup_font_footerheadinggoogle   =   str_replace( '+', ' ', $thinkup_font_footerheadinggoogle );
	$thinkup_font_preheadergoogle       =   str_replace( '+', ' ', $thinkup_font_preheadergoogle );
	$thinkup_font_mainheadergoogle      =   str_replace( '+', ' ', $thinkup_font_mainheadergoogle );
	$thinkup_font_mainfootergoogle      =   str_replace( '+', ' ', $thinkup_font_mainfootergoogle );
	$thinkup_font_postfootergoogle      =   str_replace( '+', ' ', $thinkup_font_postfootergoogle );
	$thinkup_font_slidertitlegoogle     =   str_replace( '+', ' ', $thinkup_font_slidertitlegoogle );
	$thinkup_font_slidertextgoogle      =   str_replace( '+', ' ', $thinkup_font_slidertextgoogle );
	
	$output = NULL;

	if ( ( empty( $thinkup_font_bodyswitch ) or $thinkup_font_bodyswitch == '0' ) and ! empty( $thinkup_font_bodystandard ) ) {
		if ( $thinkup_font_bodystandard == 'default theme font' ) {
			$output .= '';
		} else {
			$output .= '#content, #content button, #content input, #content select, #content textarea { font-family:' . $thinkup_font_bodystandard . '}' . "\n";
			$output .= '#introaction-core, #introaction-core button, #introaction-core input, #introaction-core select, #introaction-core textarea { font-family:' . $thinkup_font_bodystandard . '}' . "\n";
			$output .= '#outroaction-core, #outroaction-core button, #outroaction-core input, #outroaction-core select, #outroaction-core textarea { font-family:' . $thinkup_font_bodystandard . '}' . "\n";
		}
	} else if ( $thinkup_font_bodyswitch == '1' and ! empty( $thinkup_font_bodygoogle ) ) {
		if ( $thinkup_font_bodygoogle == 'Select a Google Font' ) {
			$output .= '';
		} else {
			$output .= '#content, #content button, #content input, #content select, #content textarea { font-family:' . $thinkup_font_bodygoogle . '}' . "\n";
			$output .= '#introaction-core, #introaction-core button, #introaction-core input, #introaction-core select, #introaction-core textarea { font-family:' . $thinkup_font_bodygoogle . '}' . "\n";
			$output .= '#outroaction-core, #outroaction-core button, #outroaction-core input, #outroaction-core select, #outroaction-core textarea { font-family:' . $thinkup_font_bodygoogle . '}' . "\n";
		}
	}
	if ( ( empty( $thinkup_font_bodyheadingswitch ) or $thinkup_font_bodyheadingswitch == '0' ) and ! empty( $thinkup_font_bodyheadingstandard ) ) {
		if ( $thinkup_font_bodyheadingstandard == 'default theme font' ) {
			$output .= '';
		} else {
			$output .= 'h1, h2, h3, h4, h5, h6 { font-family:' . $thinkup_font_bodyheadingstandard . '}' . "\n";
			$output .= '#content h1, #content h2, #content h3, #content h4, #content h5, #content h6 { font-family:' . $thinkup_font_bodyheadingstandard . '}' . "\n";
			$output .= '#intro-core h1, #intro-core h2, #intro-core h3, #intro-core h4, #intro-core h5, #intro-core h6 { font-family:' . $thinkup_font_bodyheadingstandard . '}' . "\n";
			$output .= '#introaction-core h1, #introaction-core h2, #introaction-core h3, #introaction-core h4, #introaction-core h5, #introaction-core h6 { font-family:' . $thinkup_font_bodyheadingstandard . '}' . "\n";
			$output .= '#outroaction-core h1, #outroaction-core h2, #outroaction-core h3, #outroaction-core h4, #outroaction-core h5, #outroaction-core h6 { font-family:' . $thinkup_font_bodyheadingstandard . '}' . "\n";
		}
	} else if ( $thinkup_font_bodyheadingswitch == '1' and ! empty( $thinkup_font_bodyheadinggoogle ) ) {
		if ( $thinkup_font_bodyheadinggoogle == 'Select a Google Font' ) {
			$output .= '';
		} else {
			$output .= 'h1, h2, h3, h4, h5, h6 { font-family:' . $thinkup_font_bodyheadinggoogle . '}' . "\n";
			$output .= '#content h1, #content h2, #content h3, #content h4, #content h5, #content h6 { font-family:' . $thinkup_font_bodyheadinggoogle . '}' . "\n";
			$output .= '#intro-core h1, #intro-core h2, #intro-core h3, #intro-core h4, #intro-core h5, #intro-core h6 { font-family:' . $thinkup_font_bodyheadinggoogle . '}' . "\n";
			$output .= '#introaction-core h1, #introaction-core h2, #introaction-core h3, #introaction-core h4, #introaction-core h5, #introaction-core h6 { font-family:' . $thinkup_font_bodyheadinggoogle . '}' . "\n";
			$output .= '#outroaction-core h1, #outroaction-core h2, #outroaction-core h3, #outroaction-core h4, #outroaction-core h5, #outroaction-core h6 { font-family:' . $thinkup_font_bodyheadinggoogle . '}' . "\n";
		}
	}
	if ( ( empty( $thinkup_font_footerheadingswitch ) or $thinkup_font_footerheadingswitch == '0' ) and ! empty( $thinkup_font_footerheadingstandard ) ) {
		if ( $thinkup_font_footerheadingstandard == 'default theme font' ) {
			$output .= '';
		} else {
			$output .= '#footer-core h3 { font-family:' . $thinkup_font_footerheadingstandard . '}' . "\n";
		}
	} else if ( $thinkup_font_footerheadingswitch == '1' ) {
		if ( $thinkup_font_footerheadinggoogle == 'Select a Google Font' ) {
			$output .= '';
		} else {
			$output .= '#footer-core h3 { font-family:' . $thinkup_font_footerheadinggoogle . '}' . "\n";
		}
	}
	if ( ( empty( $thinkup_font_preheaderswitch ) or $thinkup_font_preheaderswitch == '0' ) and ! empty( $thinkup_font_preheaderstandard ) ) {
		if ( $thinkup_font_preheaderstandard == 'default theme font' ) {
			$output .= '';
		} else {
			$output .= '#pre-header .header-links li a, #pre-header-social li.message, #pre-header-search input { font-family:' . $thinkup_font_preheaderstandard . '}' . "\n";
		}
	} else if ( $thinkup_font_preheaderswitch == '1' and ! empty( $thinkup_font_preheadergoogle ) ) {
		if ( $thinkup_font_preheadergoogle == 'Select a Google Font' ) {
			$output .= '';
		} else {
			$output .= '#pre-header .header-links li a, #pre-header-social li.message, #pre-header-search input { font-family:' . $thinkup_font_preheadergoogle . '}' . "\n";
		}
	}	
	if ( ( empty( $thinkup_font_mainheaderswitch ) or $thinkup_font_mainheaderswitch == '0' ) and ! empty( $thinkup_font_mainheaderstandard  ) ) {
		if ( $thinkup_font_mainheaderstandard == 'default theme font' ) {
			$output .= '';
		} else {
			$output .= '#header li a, #header-sticky li a, #header-social li.message, #header-search input { font-family:' . $thinkup_font_mainheaderstandard . '}' . "\n";
		}
	} else if ( $thinkup_font_mainheaderswitch == '1' and ! empty( $thinkup_font_mainheadergoogle ) ) {
		if ( $thinkup_font_mainheadergoogle == 'Select a Google Font' ) {
			$output .= '';
		} else {
			$output .= '#header li a, #header-sticky li a, #header-social li.message, #header-search input { font-family:' . $thinkup_font_mainheadergoogle . '}' . "\n";
		}
	}
	if ( ( empty( $thinkup_font_mainfooterswitch ) or $thinkup_font_mainfooterswitch == '0' ) and ! empty( $thinkup_font_mainfooterstandard ) ) {
		if ( $thinkup_font_mainfooterstandard == 'default theme font' ) {
			$output .= '';
		} else {
			$output .= '#footer-core, #footer-core button, #footer-core input, #footer-core select, #footer-core textarea { font-family:' . $thinkup_font_mainfooterstandard . '}' . "\n";
		}
	} else if ( $thinkup_font_mainfooterswitch == '1' and ! empty( $thinkup_font_mainfootergoogle ) ) {
		if ( $thinkup_font_mainfootergoogle == 'Select a Google Font' ) {
			$output .= '';
		} else {
			$output .= '#footer-core, #footer-core button, #footer-core input, #footer-core select, #footer-core textarea { font-family:' . $thinkup_font_mainfootergoogle . '}' . "\n";
		}
	}
	if ( ( empty( $thinkup_font_postfooterswitch ) or $thinkup_font_postfooterswitch == '0' ) and ! empty( $thinkup_font_postfooterstandard ) ) {
		if ( $thinkup_font_postfooterstandard == 'default theme font' ) {
			$output .= '';
		} else {
			$output .= '#sub-footer-core, #sub-footer-core a { font-family:' . $thinkup_font_postfooterstandard . '}' . "\n";
		}
	} else if ( $thinkup_font_postfooterswitch == '1' and ! empty( $thinkup_font_postfootergoogle ) ) {
		if ( $thinkup_font_postfootergoogle == 'Select a Google Font' ) {
			$output .= '';
		} else {
			$output .= '#sub-footer-core, #sub-footer-core a { font-family:' . $thinkup_font_postfootergoogle . '}' . "\n";
		}
	}
	if ( ( empty( $thinkup_font_slidertitleswitch ) or $thinkup_font_slidertitleswitch == '0' ) and ! empty( $thinkup_font_slidertitlestandard ) ) {
		if ( $thinkup_font_slidertitlestandard == 'default theme font' ) {
			$output .= '';
		} else {
			$output .= '#slider .featured-title span { font-family:' . $thinkup_font_slidertitlestandard . '}' . "\n";
		}
	} else if ( $thinkup_font_slidertitleswitch == '1' and ! empty( $thinkup_font_slidertitlegoogle ) ) {
		if ( $thinkup_font_slidertitlegoogle == 'Select a Google Font' ) {
			$output .= '';
		} else {
			$output .= '#slider .featured-title span { font-family:' . $thinkup_font_slidertitlegoogle . '}' . "\n";
		}
	}
	if ( ( empty( $thinkup_font_slidertextswitch ) or $thinkup_font_slidertextswitch == '0' ) and ! empty( $thinkup_font_slidertextstandard ) ) {
		if ( $thinkup_font_slidertextstandard == 'default theme font' ) {
			$output .= '';
		} else {
			$output .= '#slider .featured-excerpt span, #slider .featured-link a { font-family:' . $thinkup_font_slidertextstandard . '}' . "\n";
		}
	} else if ( $thinkup_font_slidertextswitch == '1' and ! empty( $thinkup_font_slidertextgoogle ) ) {
		if ( $thinkup_font_slidertextgoogle == 'Select a Google Font' ) {
			$output .= '';
		} else {
			$output .= '#slider .featured-excerpt span, #slider .featured-link a { font-family:' . $thinkup_font_slidertextgoogle . '}' . "\n";
		}
	}

	if ( ! empty( $output ) ) {
		echo    '<style type="text/css">' . "\n" . $output . '</style>';
	}
}
add_action( 'wp_head', 'thinkup_input_fontfamily', 11 );


/* ----------------------------------------------------------------------------------
	INPUT FONT SIZE CSS
---------------------------------------------------------------------------------- */

function thinkup_input_fontsize() {
global $thinkup_font_bodysize;
global $thinkup_font_h1size;
global $thinkup_font_h2size;
global $thinkup_font_h3size;
global $thinkup_font_h4size;
global $thinkup_font_h5size;
global $thinkup_font_h6size;
global $thinkup_font_footerheadingsize;
global $thinkup_font_preheadersize;
global $thinkup_font_preheadersubsize;
global $thinkup_font_mainheadersize;
global $thinkup_font_mainheadersubsize;
global $thinkup_font_mainfootersize;
global $thinkup_font_postfootersize;
global $thinkup_font_sidebarsize;
global $thinkup_font_slidertitlesize;
global $thinkup_font_slidertextsize;

	$output = NULL;

	if ( empty( $thinkup_font_bodysize ) or $thinkup_font_bodysize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#content, #content button, #content input, #content select, #content textarea { font-size:' . $thinkup_font_bodysize . '}' . "\n";
		$output .= '#introaction-core, #introaction-core button, #introaction-core input, #introaction-core select, #introaction-core textarea { font-size:' . $thinkup_font_bodysize . '}' . "\n";
		$output .= '#outroaction-core, #outroaction-core button, #outroaction-core input, #outroaction-core select, #outroaction-core textarea { font-size:' . $thinkup_font_bodysize . '}' . "\n";		
	}
	if ( empty( $thinkup_font_h1size ) or $thinkup_font_h1size == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= 'h1, #content h1,#introaction-core h1, #outroaction-core h1 { font-size:' . $thinkup_font_h1size . '}' . "\n";
	}		
	if ( empty( $thinkup_font_h2size ) or $thinkup_font_h2size == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= 'h2, #content h2,#introaction-core h2, #outroaction-core h2 { font-size:' . $thinkup_font_h2size . '}' . "\n";
	}		
	if ( empty( $thinkup_font_h3size ) or $thinkup_font_h3size == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= 'h3, #content h3,#introaction-core h3, #outroaction-core h3 { font-size:' . $thinkup_font_h3size . '}' . "\n";
	}		
	if ( empty( $thinkup_font_h4size ) or $thinkup_font_h4size == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= 'h4, #content h4,#introaction-core h4, #outroaction-core h4 { font-size:' . $thinkup_font_h4size . '}' . "\n";
	}		
	if ( empty( $thinkup_font_h5size ) or $thinkup_font_h5size == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= 'h5, #content h5,#introaction-core h5, #outroaction-core h5 { font-size:' . $thinkup_font_h5size . '}' . "\n";
	}		
	if ( empty( $thinkup_font_h6size ) or $thinkup_font_h6size == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= 'h6, #content h6,#introaction-core h6, #outroaction-core h6 { font-size:' . $thinkup_font_h6size . '}' . "\n";
	}
	if ( empty( $thinkup_font_footerheadingsize ) or $thinkup_font_footerheadingsize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#footer-core h3 { font-size:' . $thinkup_font_footerheadingsize . '}' . "\n";
	}
	if ( empty( $thinkup_font_preheadersize ) or $thinkup_font_preheadersize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#pre-header #pre-header-core .menu > li > a, #pre-header-social li, #pre-header-social li a, #pre-header-search input { font-size:' . $thinkup_font_preheadersize . '}' . "\n";
	}
	if ( empty( $thinkup_font_preheadersubsize ) or $thinkup_font_preheadersubsize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#pre-header #pre-header-core .sub-menu a { font-size:' . $thinkup_font_preheadersubsize . '}' . "\n";
	}
	if ( empty( $thinkup_font_mainheadersize ) or $thinkup_font_mainheadersize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#header #header-core .menu > li > a, #header-responsive li a { font-size:' . $thinkup_font_mainheadersize . '}' . "\n";
	}
	if ( empty( $thinkup_font_mainheadersubsize ) or $thinkup_font_mainheadersubsize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#header #header-core .sub-menu a { font-size:' . $thinkup_font_mainheadersubsize . '}' . "\n";
	}
	if ( empty( $thinkup_font_mainfootersize ) or $thinkup_font_mainfootersize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#footer-core, #footer-core button, #footer-core input, #footer-core select, #footer-core textarea, #footer-core .widget { font-size:' . $thinkup_font_mainfootersize . '}' . "\n";
	}
	if ( empty( $thinkup_font_postfootersize ) or $thinkup_font_postfootersize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#sub-footer-core, #sub-footer-core a { font-size:' . $thinkup_font_postfootersize . '}' . "\n";
	}
	if ( empty( $thinkup_font_sidebarsize ) or $thinkup_font_sidebarsize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#sidebar h3.widget-title { font-size:' . $thinkup_font_sidebarsize . '}' . "\n";
	}
	if ( empty( $thinkup_font_slidertitlesize ) or $thinkup_font_slidertitlesize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#slider .featured-title span { font-size:' . $thinkup_font_slidertitlesize . ' !important; }' . "\n";
	}
	if ( empty( $thinkup_font_slidertextsize ) or $thinkup_font_slidertextsize == 'Default Size' ) {
		$output .= '';
	} else {
		$output .= '#slider .featured-excerpt span { font-size:' . $thinkup_font_slidertextsize . ' !important; }' . "\n";
	}

	if ( ! empty( $output ) ) {
		echo    '<style type="text/css">' . "\n" . $output . '</style>';
	}
}
add_action( 'wp_head', 'thinkup_input_fontsize', 11 );


?>