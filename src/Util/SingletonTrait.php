<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Util;

/**
 * This trait contains all singleton functionality used by business components.
 * @package JurgenRomeijn\Projects\Common
 */
trait SingletonTrait
{
    protected static $instance;

    /**
     * return an instance of this singleton.
     * @return SingletonTrait
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
