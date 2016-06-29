<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

spl_autoload_register('pluginAutoload');

/**
 * Autoload all classes in the src folder.
 * @param $class
 */
function pluginAutoload($class)
{
    $prefix = 'JurgenRomeijn\\ProjectsRest';
    $base_dir = __DIR__ . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0)
    {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file))
    {
        require_once $file;
    }
}
