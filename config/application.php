<?php
/**
 * Your base production configuration goes in this file.
 *
 * A good default policy is to deviate from the production config as little as
 * possible. Try to define as much of your configuration in this file as you
 * can.
 */

use Roots\WPConfig\Config;
use function Env\env;

/**
 * Directory containing all of the site's files
 *
 * @var string
 */
$root_dir = dirname(__DIR__);

/**
 * Document Root
 *
 * @var string
 */
$webroot_dir = $root_dir . '/web';

/**
 * Use Dotenv to set required environment variables and load .env file in root
 * .env.local will override .env if it exists
 */
$env_files = file_exists($root_dir . '/.env.local')
    ? ['.env', '.env.pantheon', '.env.local']
    : ['.env', '.env.pantheon'];

$dotenv = Dotenv\Dotenv::createUnsafeImmutable($root_dir, $env_files, false);

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define('WP_ENV', env('WP_ENV') ?: 'production');
/**
 * DB settings
 * This will ensure these are only loaded on Lando
 */
if (getenv('LANDO_INFO')) {
    $lando_info = json_decode(getenv('LANDO_INFO'));
    $database_config = $lando_info->database;

    Config::define('DB_NAME', $database_config->creds->database ?: 'wordpress');
    Config::define('DB_USER', $database_config->creds->user ?: 'wordpress');
    Config::define('DB_PASSWORD', $database_config->creds->password ?: 'wordpress');
    Config::define('DB_HOST', $database_config->internal_connection->host ?: 'database');
} else {
    Config::define('DB_NAME', env('DB_NAME'));
    Config::define('DB_USER', env('DB_USER'));
    Config::define('DB_PASSWORD', env('DB_PASSWORD'));
    Config::define('DB_HOST', env('DB_HOST') ?: 'localhost');
}

Config::define('DB_CHARSET', 'utf8mb4');
Config::define('DB_COLLATE', '');
Config::define( 'WP_ALLOW_REPAIR', true );
$table_prefix = env('DB_PREFIX') ?: 'wp_';

/**
 * URLs
*/
Config::define('WP_HOME', env('WP_HOME'));
Config::define('WP_SITEURL', env('WP_SITEURL'));
Config::define('DISABLE_WP_CRON', env('DISABLE_WP_CRON') ?: false);

/**
 * Custom Content Directory
 */
Config::define('CONTENT_DIR', '/app');
Config::define('WP_CONTENT_DIR', $webroot_dir . Config::get('CONTENT_DIR'));
Config::define('WP_CONTENT_URL', Config::get('WP_HOME') . Config::get('CONTENT_DIR'));

/**
 * Authentication Unique Keys and Salts
 */
Config::define('AUTH_KEY', env('AUTH_KEY'));
Config::define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
Config::define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
Config::define('NONCE_KEY', env('NONCE_KEY'));
Config::define('AUTH_SALT', env('AUTH_SALT'));
Config::define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
Config::define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
Config::define('NONCE_SALT', env('NONCE_SALT'));

/**
 * Custom Settings
 */
Config::define('AUTOMATIC_UPDATER_DISABLED', true);
// Disable the plugin and theme file editor in the admin
Config::define('DISALLOW_FILE_EDIT', true);
// Disable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', true);
// Limit the number of post revisions that Wordpress stores (true (default WP): store every revision)
Config::define('WP_POST_REVISIONS', env('WP_POST_REVISIONS') ?: true);

/**
 * Debugging Settings
 */
Config::define('WP_DEBUG_DISPLAY', true);
Config::define('WP_DEBUG_LOG', false);
Config::define('SCRIPT_DEBUG', true);
ini_set('display_errors', '0');

/**
 * Allow WordPress to detect HTTPS when used behind a reverse proxy or a load balancer
 * See https://codex.wordpress.org/Function_Reference/is_ssl#Notes
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
    require_once $env_config;
}

Config::apply();

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', $webroot_dir . '/wp/');
}
