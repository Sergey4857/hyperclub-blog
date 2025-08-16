<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', "hyper" );

/** Database username */
define( 'DB_USER', "root" );

/** Database password */
define( 'DB_PASSWORD', "" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

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
define( 'AUTH_KEY',          'i,NOQXKraVX&(_m}Dj(x@bFVHZqM)/Wp)b^D_g~oJzi]EBI~{B;e@1@0JS^@G-&9' );
define( 'SECURE_AUTH_KEY',   ']pwxC+LnmvZ|n,~vSM<6` kUO-$Vnbw84p=Nk!ccYf5Vtcaa-dPn]1FvVU>:~ekl' );
define( 'LOGGED_IN_KEY',     'QthOyEB!b=}MTJ}ZOLUYKvsdyAd@`xw1O/Gi0L2ulx?OY.)-%LOqd^K@Ng Uq[N.' );
define( 'NONCE_KEY',         '}B|ivLWfn<9+<=AfyQrl[spicNfHH#p6zvT!{mP}Q`dM0$mi~2ok``y^`IRH2qN?' );
define( 'AUTH_SALT',         'lQ-I+~]!uC[R~;oIn82IDk1B>4<Up[]pPvvfzz)u5OXKa]{=&`{GWg/|NgOJ2MR^' );
define( 'SECURE_AUTH_SALT',  'Q${[/FLj.=*AoN?XA<=+44+:bnbHv]u}aup4BgKuTy~6}lq{L|$tM s#tmu3)6j(' );
define( 'LOGGED_IN_SALT',    '5nl;ngsPZiJW({:5tg0T*;7]mR]?F>rpwe=/H!j`PDQ+/Vj$`FcsRwSf4 !+,cV,' );
define( 'NONCE_SALT',        '[~^;C/`U57eMxlhwQ]fC{9Gs}MXZ0Z/d$ky2OBkB/STJcO:wxmNKz8X%!k/$qzO&' );
define( 'WP_CACHE_KEY_SALT', 'Ez4WtSOL2oM~zdD;r>YK9Zpx tavO`wOf61Q(x?E&PGtQ~e+5P.~NMt(.:[0a;..' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


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



define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '9e2b49509e67d2ad97fde7ab181cd0ae' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
define( 'DUPLICATOR_AUTH_KEY', '!GEVKZ<CN^Ys=&qm{GUiU`:sKC(4vk]:f+=}}&5r2m)FYk@Fzu !GClA&Bb_<H }' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
