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
define('DB_NAME', 'wp_demoapi');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '6QMAm|WjDY$S<}oyoQ]m.5R4]@SHtIY+(p+*~71;u}hAjNDnft1(VuKC 7x1R5m%');
define('SECURE_AUTH_KEY',  'HLE(z/!8rvU)7VGNE^5,U!_gCwZ.TbxB1l: .CvjSyU`I.kR|c(q7+_[&t~8_zZj');
define('LOGGED_IN_KEY',    'aOKnmA>SGxre}`hm3B9e?L}-aJq.j5^C`YJm/ax=`36>SuiHgs=>(/k$=MmWg-Xh');
define('NONCE_KEY',        'q/LcZ,EGe,v15CKjmNKeB[.@ k(Z(Du^c>_qQFBm5rH*o&xkYSc}GrV!zZr-]^rI');
define('AUTH_SALT',        '<vfukdVyh<NzF;nt|/?glR&5pJjRLxORf2lmV[t@nD@1EBSs6IH$)J[TuCusLnc$');
define('SECURE_AUTH_SALT', '^oRXl,e ?q@=4HL?L:+Sa2`i|J59pL?=I(|uMvgxa[ffzHJ<{`]~QRx5l8ZPMU1i');
define('LOGGED_IN_SALT',   'O*{${. kDP3]k5ry|&QVI0PmOXj=WOB.E9F<2+c$KA]UHk|JZ)>P7[E*n<5Bx$K4');
define('NONCE_SALT',       'T/tj;MV9H!x:8aqbZW~|><w-Qp{JS_7^FUM![E |H}qv2:${PMs#_GP*haxJU_o,');

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
