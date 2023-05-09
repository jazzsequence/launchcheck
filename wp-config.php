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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

if ( file_exists( __DIR__ . '/wp_launch_check/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/wp_launch_check/vendor/autoload.php';
}

// ** Database settings - You can get this info from your web host ** //
/** This will ensure these are only loaded on Lando */
if (getenv('LANDO_INFO')) {
    /**  Parse the LANDO INFO  */
    $lando_info = json_decode(getenv('LANDO_INFO'));

    /** Get the database config */
    $database_config = $lando_info->database;
    /** The name of the database for WordPress */
    defined( 'DB_NAME' ) or define('DB_NAME', $database_config->creds->database);
    /** MySQL database username */
    defined( 'DB_USER' ) or define('DB_USER', $database_config->creds->user);
    /** MySQL database password */
    defined( 'DB_PASSWORD' ) or define('DB_PASSWORD', $database_config->creds->password);
    /** MySQL hostname */
    defined( 'DB_HOST' ) or define('DB_HOST', $database_config->internal_connection->host);

    /** URL routing (Optional, may not be necessary) */
    // define('WP_HOME','http://mysite.lndo.site');
    // define('WP_SITEURL','http://mysite.lndo.site');
  };

/** Database charset to use in creating database tables. */
defined( 'DB_CHARSET' ) or define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
defined( 'DB_COLLATE' ) or define( 'DB_COLLATE', '' );

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
defined( 'AUTH_KEY' ) or define( 'AUTH_KEY',          'zz<SFu9[H^-{XV/9jgej*{W7/!eWDz.fm)BWBCYex$DP,ru6hRYN*=40.-fUvjJ:' );
defined( 'SECURE_AUTH_KEY' ) or define( 'SECURE_AUTH_KEY',   'Q8Dc|5Usp6eMNI!Nc8ClD=z+h $~WtYAu%wD.#4$zI(cF)7qDk(=BqBv>P^_-Lbf' );
defined( 'LOGGED_IN_KEY' ) or define( 'LOGGED_IN_KEY',     '12h^HN9Yt4b:lVEtB6rbBm,$1Igd m[`v0GM7xlZ1{fe,Y67KJ7Em?GK4.`EfT#l' );
defined( 'NONCE_KEY' ) or define( 'NONCE_KEY',         'aMwYqtwJ3A]N){q3LsU.-!Q`K~uJ68W0 `Geb&SqfwB+h{`Zs,L,kq0T//)hH/V@' );
defined( 'AUTH_SALT' ) or define( 'AUTH_SALT',         'C#0<6lF:a^Q;b_{>eu+6QazxR*^>{Q&O0#8E7)LC3ue/ [_u$,b;nPkGGyQC2ktC' );
defined( 'SECURE_AUTH_SALT' ) or define( 'SECURE_AUTH_SALT',  '%E%(BDxilh[O[%~B,Z1zsq$dY9+b761c2s{cTAXIp+g=p>e1b(<_o)C-@vALANKE' );
defined( 'LOGGED_IN_SALT' ) or define( 'LOGGED_IN_SALT',    'U_RijQ*,|%{)kf:$T`:?Mb:qH 3dy >Dz]4a%!Wy_3YQz=;UIL~,g>hC}jbci>k*' );
defined( 'NONCE_SALT' ) or define( 'NONCE_SALT',        '7x@B>evG7<8CUkK@dgn%~u/7/1uk!MQt; ]C0Pe0lk`EOkC?|1<`yKp^5j&<6*v,' );
defined( 'WP_CACHE_KEY_SALT' ) or define( 'WP_CACHE_KEY_SALT', '<ksu3Gc!?~mC#XqZekhi:1[g1gKD.NG_zPp.deju{dQGEiKM@07#K[jto]xK;!@6' );


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
	define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_DISPLAY', true );
    define( 'SCRIPT_DEBUG', true );
}

defined( 'WP_ALLOW_MULTISITE' ) or define( 'WP_ALLOW_MULTISITE', true );
defined( 'MULTISITE' ) or define( 'MULTISITE', true );
defined( 'SUBDOMAIN_INSTALL' ) or define( 'SUBDOMAIN_INSTALL', false );
$base = '/';
defined( 'DOMAIN_CURRENT_SITE' ) or define( 'DOMAIN_CURRENT_SITE', 'launchcheck.lndo.site' );
defined( 'PATH_CURRENT_SITE' ) or define( 'PATH_CURRENT_SITE', '/' );
defined( 'SITE_ID_CURRENT_SITE' ) or define( 'SITE_ID_CURRENT_SITE', 1 );
defined( 'BLOG_ID_CURRENT_SITE' ) or define( 'BLOG_ID_CURRENT_SITE', 1 );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
