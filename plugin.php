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
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Autoload all classes by using the composer auto loader.
 */
require_once __DIR__ . '/../../../vendor/autoload.php';

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
