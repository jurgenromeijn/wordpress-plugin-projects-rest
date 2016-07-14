<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

// Set required constants
define('PROJECT_ROOT', dirname(dirname(__FILE__)) . '/');
define('ABSPATH', PROJECT_ROOT . 'wp/');
define('WP_ROOT', ABSPATH);
define('WP_CONTENT_ROOT', PROJECT_ROOT . 'wp-content/');
define('PLUGINS_ROOT', WP_CONTENT_ROOT . 'plugins/');
define('WPINC', 'wp-includes');

// Load the autload
require(PROJECT_ROOT . 'vendor/autoload.php');

// Load required plugin classes
require(PLUGINS_ROOT . 'rest-api/lib/endpoints/class-wp-rest-controller.php');

// Load require wordpress classes
require(WP_ROOT . 'wp-includes/functions.php');
require(WP_ROOT . 'wp-includes/class-wp-post.php');
require(WP_ROOT . 'wp-includes/class-wp-http-response.php');
require(WP_ROOT . 'wp-includes/rest-api/class-wp-rest-server.php');
require(WP_ROOT . 'wp-includes/rest-api/class-wp-rest-response.php');
