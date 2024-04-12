<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bestofbets_db');
/** Database username */
define('DB_USER', 'bestofbets_wp_zsxsa');
/** Database password */
define('DB_PASSWORD', '5h3QVZFx%?RSi3vA');
/** Database hostname */
define('DB_HOST', 'localhost:3306');
/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');
/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '-~&_5c/|q7U#K!C1@P_]753ep7R4+ZJl75(2vJ*j7/p[RxM2pj~rz@U0:9379Nk5');
define('SECURE_AUTH_KEY', '2d8p(12Z/6;10mmbFR]sJE22_[6cJ3|Dk]484_02:0A_)]4vw7-12g%@G6G0@8X0');
define('LOGGED_IN_KEY', '0*/Q9/i&F2MM_%rm6uX|0nX/H#YqlQs%3X+]!o588&npT0pEZBW0EbQcH1P97Yn)');
define('NONCE_KEY', '|248qd@4[Aq@i8k4;~1*RD6g5(se61_0]rMj+]8a9Kg]I2:fI%h%Su%43bjdf1j9');
define('AUTH_SALT', 'Z[76g7XQzj3VJ8u&_(+9[&*F9J!7pQtB*Bo6n-H6tofZs!G1Xwxae9&-yeAcGh2h');
define('SECURE_AUTH_SALT', '%eKwqzNqwZ_cnTQG|(ml|@1(C8m]/8:]mHS/iT&sQeG5[S(JM3@V)b65t58hdsxh');
define('LOGGED_IN_SALT', ':;1uZ|saOg+f06nDj);In;UYCkdkq;i4@O~ncV!0JG~~z%@2G:T:_eHsqkz~XW5i');
define('NONCE_SALT', ':Jm&di2/w([CBTCduJL[JH+A4366+#)]czq:v(&tIg;JX0gB91R_qFCoOL1EOBx|');
/**#@-*/
/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_clcvcwqm_';
/* Add any custom values between this line and the "stop editing" line. */
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_CACHE_KEY_SALT', 'a5e80af0a1e224f687203cb35aea1a5e' );
// define( 'DISABLE_WP_CRON', true );
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
