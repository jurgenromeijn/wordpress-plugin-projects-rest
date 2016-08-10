# Wordpress Plugin: Projects
This is a small wordpress plugin that creates the rest interface for the project post type.

[![Build Status](https://scrutinizer-ci.com/g/jurgenromeijn/wordpress-plugin-projects-rest/badges/build.png?b=master)](https://scrutinizer-ci.com/g/jurgenromeijn/wordpress-plugin-projects-rest/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jurgenromeijn/wordpress-plugin-projects-rest/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jurgenromeijn/wordpress-plugin-projects-rest/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/jurgenromeijn/wordpress-plugin-projects-rest/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/jurgenromeijn/wordpress-plugin-projects-rest/?branch=master)

## Prerequisites
- PHP 5.2.4+ is installed.
- MySQL 5.0+ is installed.
- WordPress is installed
- WP REST API v2.0 is installed
- There is a project post type defined (for instance by using the [Wordpress Portfolio Projects](https://github.com/jurgenromeijn/wordpress-plugin-projects) plugin.

## Tests
- make sure Xdebug is installed
- run `composer install`
- run `phpunit`

## Usage
- Include this plugin into your WordPress through composer.
- Activate the plugin.
- Navigate to `[base-url]/wp-json/projects/v1/project` to view all projects.