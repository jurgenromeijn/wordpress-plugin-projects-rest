<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest;

use JurgenRomeijn\ProjectsRest\Controller\ProjectController;
use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;

/**
 * Sets up the ProjectRestPlugin
 * @package JurgenRomeijn\ProjectsRest
 */
class ProjectRestPlugin
{
    use SingletonTrait;

    const API_VERSION   = 'v1';
    const API_BASE_PATH = 'projects';

    private $projectController;

    /**
     * Load components
     */
    private function __construct()
    {
        $this->projectController = ProjectController::getInstance();
    }

    /**
     * Set up the plugin.
     */
    public function init()
    {
        $this->projectController->init();
    }

    /**
     * Get the base path of the Rest APIs exposed by this plugin.
     * @return string
     */
    public static function getApiBasePath()
    {
        return self::API_BASE_PATH . '/' . self::API_VERSION;
    }
}
