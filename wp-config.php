<?php
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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'suufi' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '5UJr]lbCf7wrSMmM`KL%Q~:)t@|xo!v_/C2jFj,7mF7.seoq6`hklnZ6kjxvoWMb' );
define( 'SECURE_AUTH_KEY',  'to%#%Qp-i>s3k+M4PgL]i!9!Q={S5DAq6kq(`bKv0%g`fyBy=Lv[td$%k*ynERhD' );
define( 'LOGGED_IN_KEY',    '(0$f-XwO*~|7Q[pRVc=u6xS;,!bveY:8c vvR&[H/gd-cX$*(@SeVX]M7ir0A@uf' );
define( 'NONCE_KEY',        'XML#Tb9[Wts/|8hiG56N(s NU@3e^6:Kj`P`1bMNX9FM;,^q.^)PdHxrNaD{CA~b' );
define( 'AUTH_SALT',        'mc2o+Q0)bz7FrNr8Ap7d3Fd+k,<#uUIO*vqf<0-m{6osKsIrPxj*IqSW>|Iw!3V7' );
define( 'SECURE_AUTH_SALT', 'Z/!R2nI5IKgw5S[|V4H//csKIgMv1vCaLSA STM3nZ[9l($Sd40z|gPvr<DKf<a>' );
define( 'LOGGED_IN_SALT',   'B8C{zkUz#_l)*U-;*WxY<dfP?!:2K.mFdh~VUe!#%P{;3aDN(6|km[[jtzmvv!.j' );
define( 'NONCE_SALT',       'oO*?V@bAKDVYv>`H,$(TrSB}xEzmDkng!_WQX=:mz/E@tuWAmX,Ag$*Ls}Aw0A| ' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
