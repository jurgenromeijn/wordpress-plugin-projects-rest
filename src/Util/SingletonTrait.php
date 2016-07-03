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
    private static $instance;

    /**
     * return an instance of this singleton.
     * @return SingletonTrait
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
