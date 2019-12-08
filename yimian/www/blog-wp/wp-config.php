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
define( 'DB_NAME', 'blog' );

/** MySQL database username */
define( 'DB_USER', 'blog' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ds9^dF3s92@2dSH' );

/** MySQL hostname */
define( 'DB_HOST', '192.168.0.90' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '?p~_W-,Eai&nb)-eC2M&$+MGAiyn}C6Hdm#)mdJNxG/me+2sUAg |n%xL[Dluqem' );
define( 'SECURE_AUTH_KEY',  'jM}JqT4n-?3(TOjfe=ULl`J8J{mC-@.kGRua,zW]wdc4F#VT1ao>>~wJ<49Z2}-~' );
define( 'LOGGED_IN_KEY',    '{KyU7BP<IDv2E;eJmR(xKPv.!tzFzx&iDy&s={Pi&mns7gFALQ{c`CXS7PIk!R$x' );
define( 'NONCE_KEY',        'N&),^@WDm[Chi?GN| a=E 2,8n!di4j*bB<Wq:0JUbc/K(utU(8Sm%^6g&]koFTp' );
define( 'AUTH_SALT',        'zP6t=pm(`O@s. >d:g|$HYgkZ]+XV[S,x#6bn@$_. cC]0]Q;`r.S>wzciF_Sx-:' );
define( 'SECURE_AUTH_SALT', 'ibX(=8 h;,AgkU@Mb`DkNgj5F4;Ys$FcCa#Ay{;0FF}<dInLlK)mJjQe^[xH/.TG' );
define( 'LOGGED_IN_SALT',   '}v[3aapf6M<cRFFF((;{{en+LWdu8P{WmD*|>>,5zpZu!}iq;sSR.QBmMa+/Yi[1' );
define( 'NONCE_SALT',       ':X9PxWHR9!5t2g PgG55GII)t#_MCf9`A80M:|6I?RP;S!r@X{D/v%7QDZ3z4AtG' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
