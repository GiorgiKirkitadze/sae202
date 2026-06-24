<?php
//Begin Really Simple Security session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple Security cookie settings
//Begin Really Simple Security key
define('RSSSL_KEY', 'RBR8m9Tbd0ZJggD795keCSDLB1jXDQeie8ei7P7k5g7CCwxRozUoSWXLKw5GNrQg');
//END Really Simple Security key

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
define( 'DB_NAME', 'sae202_agence' );

/** Database username */
define( 'DB_USER', 'sae202-agence' );

/** Database password */
define( 'DB_PASSWORD', 'Qwinn.77@' );

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
define( 'AUTH_KEY',         'Rb_@@Q{eeh1FM~D23Jpo #7+6uGth`r0LC?&vi3b2tP:Eu,/pq{M#Z=rBsH.`-&v' );
define( 'SECURE_AUTH_KEY',  'z`zDmxte4>L>r;?PzL<q;UEX/[b(*-?6o8A7C,#qp9hHn0)#)CMv(c=s>CI}n>>]' );
define( 'LOGGED_IN_KEY',    '=5hXl(|h-&A](&Y&-MtO,.1V-LFHYtj91Y`G+8-_M(A}Jo8{w)E2t:]W]<n.aSko' );
define( 'NONCE_KEY',        '@Dak*MtlD-p/y6^AS{b]iV `Eu.SY&vq;~sioB!W^<^CYIPeSQ$o7(Xkr.szM*aT' );
define( 'AUTH_SALT',        'O9]*H~{kkEcCkw%+7{k0-&6v(-@x9rQ5aA}wliz7d` L)RgioI[t=a>9ppE)w4 #' );
define( 'SECURE_AUTH_SALT', 'f6eNU&.[)^+Ft~}^XecJdL&gy:L8&1ELLiF!i%.=zgf%`phW/f`,~m{i)8r5MPXK' );
define( 'LOGGED_IN_SALT',   '7Bl`85WU6TH3O |>ew!gu(a`mw0s3X3+zFr=S1Q(uTLUig}>zEHO_pZ>vq#k(H<>' );
define( 'NONCE_SALT',       '{a Crh-LF$Sbz:aM]Snl,OE>sp{X)^aaP{+<A^Ct?S.J<8(i/h<PBRCwk:xV{H%=' );

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
define('FS_METHOD', 'ssh2');
