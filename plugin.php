<?php
/**
 * Plugin Name: Portfolio Projects Rest
 * Description: A WordPress plugin that creates the rest interface for the project post type.
 * Author: Jurgen Romeijn <jurgen.romeijn@gmail.com>
 * Author URI: http://www.jurgenromeijn.com
 * Version: 1.0.1
 * Plugin URI: https://github.com/jurgenromeijn/wordpress-plugin-projects-rest
 * License: GPL3
 *
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

/**
 * Autoload all classes by using the composer auto loader.
 */
require_once __DIR__ . '/../../../vendor/autoload.php';

/**
 * Set up the plugin.
 */
$projectRestPlugin = \JurgenRomeijn\ProjectsRest\ProjectRestPlugin::getInstance();
$projectRestPlugin->init();
