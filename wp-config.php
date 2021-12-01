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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'superfect' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '_d,P?XO6!6m&B<R,3RAH#V2RkHZt?oOs?8r.i{>7i]!a/>Gq{onPBH~?x BG+D!>' );
define( 'SECURE_AUTH_KEY',  '|SX^} ~R6#6|3gNIpWGW>](j;${:SMk-8-^cCJCdK?:o--XK?[*zrv5g:G;S49!u' );
define( 'LOGGED_IN_KEY',    '7g{%!R$fZavOD@X1o4$e=Qi#p/j5Y>&FG3jz|ds.L(bDudR>n27e[~gSFA qE1B4' );
define( 'NONCE_KEY',        '!VJ!,FTi1v5.9UB^EFbPQ<oOUPYZDB|Bwnge_&#LnQ2dMSOK-4bRteFDvnh?tRd;' );
define( 'AUTH_SALT',        '=D)8cf+og&T`pBw(0/;=&-*vTwM{7Lb+_A8wwkj_L{]-t83gMRAp^7i#L2K:3Z4Z' );
define( 'SECURE_AUTH_SALT', '$XhsVe]UacLf(!G4-tPBU(qWvSq~PQ;~9/jC6iO/ZO.Zrtc6rP8W EoawrT0E0u?' );
define( 'LOGGED_IN_SALT',   'qdM9-Jtimw |VX|3ZTnH$2ji>Pc*KRjZ[ &2Y<`R50g%NiV0REet^rEZabNQXd4m' );
define( 'NONCE_SALT',       'g@3e~c{Vm77mkgg5y#O)X$N.MSgc>se}4+/JL{_v(H/W2&a!%LPARb@n}/`lMq|[' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_super';

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
