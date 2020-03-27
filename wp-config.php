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
define( 'DB_NAME', 'wellington_music' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '`?wx<@JECe]y,czCC(pDzESAgTX;w(:LN!(MUWAo%YX;C8;LAqc/pPfQxRPpc<!f' );
define( 'SECURE_AUTH_KEY',  'ix-M2GCVr)gYGMW8ocd5`Axf2t?@2Pe5U~0g.t#,PBua~^sRJ_+8Vk+0]M;IUg_B' );
define( 'LOGGED_IN_KEY',    'a>t}S>(igq6&J[T;`[Uc69<,?l4](oO0 z$O1KedWp$K,I%_cynzMdU6]JE-[Z&8' );
define( 'NONCE_KEY',        '];RXw?R{nguQNqR*p}zm&Li3RgVJD[~!m_(Sny8b@1aKZNMx$S7!f49R3]=SxQ3&' );
define( 'AUTH_SALT',        '}`(j<~~aadtxmT!Roxg X;Y;?@)@:M3)t*CPKIS~QHAf1RE#pNxDT|{0*11bN)}&' );
define( 'SECURE_AUTH_SALT', 'GQh2HS22E5<`6G;@F-VYRh0>`eg|0jyQlXoiy)m,e%OlnkTKyOA<I@W(Shx_xW_]' );
define( 'LOGGED_IN_SALT',   '-pq<WUCKk}>&{[a.Uh~nGbwJ,fxsJF=;X1y<DU##jxIv7KU-R?ARW}s}#cm915t(' );
define( 'NONCE_SALT',       '?QY4l^qiQ_--S,~L+!WZB^`bETF|W/Z-UC(*uE{lTY[Ly%J &fQbPxxpbRKq7AM~' );

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
