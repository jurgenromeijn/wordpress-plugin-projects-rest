<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Util;

/**
 * Static util class that has methods that help managing arrays.
 * @package JurgenRomeijn\ProjectsRest\Util
 */
abstract class ArrayHelper
{
    /**
     * Safely get an array from another array or return an empty array.
     * @param $key
     * @param $array
     * @return array
     */
    public static function findArray($key, array $array)
    {
        $returnArray = [];

        if (array_key_exists($key, $array)) {
            $returnArray = (is_array($array[$key])) ? $array[$key] : [$array[$key]];
        }

        return $returnArray;
    }

    /**
     * Safely get a value from an array or return null
     * @param $key
     * @param $array
     * @return object
     */
    public static function findValue($key, array $array)
    {
        $value = null;

        if (array_key_exists($key, $array)) {
            $value = $array[$key];
        }
        if (is_array($value)) {
            $value = implode(',', $value);
        }

        return $value;
    }
}