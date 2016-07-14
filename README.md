# Wordpress Plugin: Projects
This is a small wordpress plugin that creates the rest interface for the project post type.

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
Navigate to `[base-url]/wp-json/projects/v1/project` to view all projects.