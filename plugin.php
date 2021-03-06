<?php
/**
 * Plugin Name: Portfolio Projects Rest
 * Description: A WordPress plugin that creates the rest interface for the project post type.
 * Author: Jurgen Romeijn <jurgen.romeijn@gmail.com>
 * Author URI: http://www.jurgenromeijn.com
 * Version: 1.2.1
 * Plugin URI: https://github.com/jurgenromeijn/wordpress-plugin-projects-rest
 * License: GPL3
 *
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Load all components
 */
$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/resources/config'));
$loader->load('components.yml');

/**
 * Set up the plugin.
 */
$projectRestPlugin = $container->get('project_rest_plugin');
$projectRestPlugin->init();
