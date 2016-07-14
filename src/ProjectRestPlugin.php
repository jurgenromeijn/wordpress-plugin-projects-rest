<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest;

use JurgenRomeijn\ProjectsRest\Controller\ProjectController;

/**
 * Sets up the ProjectRestPlugin
 * @package JurgenRomeijn\ProjectsRest
 */
class ProjectRestPlugin
{
    const API_VERSION   = 'v1';
    const API_BASE_PATH = 'projects';

    private $projectController;

    /**
     * ProjectRestPlugin constructor.
     * @param ProjectController $projectController
     */
    public function __construct(ProjectController $projectController)
    {
        $this->projectController = $projectController;
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
