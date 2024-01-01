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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'car_new' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',         'o!5=Rj{Pj:OTh{SgF[QuT5{Iz%6a}kt-+h#|MaU3Y{%;NWySZ>nO+2^bAaa2i%Y`' );
define( 'SECURE_AUTH_KEY',  'g5J#a[Zj}XL2P/pfrO)+9:P88G%jd5C7FpHFe@V%!WKP_^oJS{dr3fW&MMGnoa(4' );
define( 'LOGGED_IN_KEY',    'yQTb`(S;ff,?>6<UWs.0*4G&?eo4hDx!( y.$1>+H}}6z8N*O4,1M#hHtNOquob2' );
define( 'NONCE_KEY',        'g3~aItL%MC*gCL]1u*Z-Q#Q$3;]1gu<-?!yxjDH%b#M2K#?eiYq2U^3~422:_$D@' );
define( 'AUTH_SALT',        '+2Yhr~N;Z+5c {Ly&!ZJ ?kD{pf%h))#fJ=F%qE}0c^xidB&@W/[M/uzG$6MtidZ' );
define( 'SECURE_AUTH_SALT', 'G=I+qdb!0#Ga_XJ8@,TqJY!+8KMxLV^a$]yKM9}ht?Uo]-pC~a@a&:bH]~*?] ik' );
define( 'LOGGED_IN_SALT',   '}mbR&lb5oj*Ir&!fB%L%7ZVJbe0Nx=5X(rt^s >l8D :- <+LXfdTRVt3igg-{+3' );
define( 'NONCE_SALT',       'rl2QPu;9fyscQ9<Z{tvL^q9sJNo_V]Gy,E`Nq57oPHvz~*pia<GE8r]}xeV+a+7i' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
