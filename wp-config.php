<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'CUCS');

/** MySQL database username */
define('DB_USER', 'bolinc');

/** MySQL database password */
define('DB_PASSWORD', 'a8336353');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ZAc<8;[[/WA5Gs+9(.$(Z@PPN}<F3zDE({7Qh$ps4MN?C]}OCn(#m&Fs[I-V^pp:');
define('SECURE_AUTH_KEY',  'Ty/4TsJ=w~;RojZ,7!i]SVv};}t>>{^nA] %wB6LN{KI7{I_S- )EhIXkHBdTbA4');
define('LOGGED_IN_KEY',    'N2(Fd9x`a7Bv:*lsE7AD{{es{vDntN(F.76o,5&gL3ZP)Kf{2LtuxJeZ1IFJ0j^K');
define('NONCE_KEY',        'Q7O}g~.B,0P98}ysBj[DWrvzFHiz`ex7KLM{48LuY_CV& ch#1#bLpl(B=d8Wn*5');
define('AUTH_SALT',        ';cu~$!sDQJmu6N$=][acl?^3x[6#>o3<_)yKEcoZTkCj_}8vkf=/<ATi*H5iDVSB');
define('SECURE_AUTH_SALT', '~TzV&t)nybq!BLEp^]Z39v*X#Q#) ftcM`K%hp9q`,l)vZu< i7v9u{mOG;is~+W');
define('LOGGED_IN_SALT',   'kn,l#l}S7MUa~Xy6v{;Gr|p8YbHV]j _B RHEK9rCwtL3`i^&qG6k?4$N>Vm@]m:');
define('NONCE_SALT',       'E4n+zzKI^VJc/]egx`<Gm=:PhQIH&:&q6KfXe4L#lR#yEVwC<%%L7)1tQsCp6l~x');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
