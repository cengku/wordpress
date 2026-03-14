<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cengcang_help' );

/** Database username */
define( 'DB_USER', 'cengcang_help' );

/** Database password */
define( 'DB_PASSWORD', 'hBckDZKRWWdb2NQD' );

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
define( 'AUTH_KEY',         '$bLPKtcJa4RB%-s2NG,HB$H;R*~qUTP&@4AbuZ+sw7&_P!;A[<2EJY{eh>A,Xo,c' );
define( 'SECURE_AUTH_KEY',  '(D76a|A5$layR`tF0`T=[T86ApKgf-=2wu|#s=g}$wYfno&.tqa,pOJ!h~SH<ao ' );
define( 'LOGGED_IN_KEY',    'Fjfe~-q@jT326+h?!OrOJ-V=x{R#TcRI%u<v6duWwHq.{8b{gwk%0z?Vy?( 1=g4' );
define( 'NONCE_KEY',        'd8B1B!eE|BpFRnwF,<,vs6.A9q6o>bkD t?!lwdI[T(vOr4FU@US00G6P1NNRy;%' );
define( 'AUTH_SALT',        'kdv:]#UM :<.eM5qm|~`*v=1L#cI<KqV+JXj3 |E=`+b=?dpFHO}snG?x&kyo]KD' );
define( 'SECURE_AUTH_SALT', '2{<B[  %C?@&u%?EJoolbx=N}Y<d/i)IAsl},{_uIlaWR44[}[2o;H*CmE3ylpbl' );
define( 'LOGGED_IN_SALT',   'iGVUe{$6`DqFq?F(LTkk%E<xmwRy@m;4LE_F;EeB 4ZUNvlCbVY]?vqWdg,Z7y:|' );
define( 'NONCE_SALT',       '&S1le|+Sh&ApeA@B%-^x>wDA<zEjkJYwA6S|{0{Nu7oPO/Y_B5i0WGBR74[9!MS{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
