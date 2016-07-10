<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Controller;

use JurgenRomeijn\ProjectsRest\Repository\ProjectRepository;
use JurgenRomeijn\ProjectsRest\Util\HttpMethods;
use WP_REST_Response as WordPressRestResponse;

/**
 * The main controller which manages the Project entity.
 * @package JurgenRomeijn\ProjectsRest\Controller
 */
class ProjectController extends AbstractRestController
{
    private $projectRepository;

    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->projectRepository = ProjectRepository::getInstance();
    }

    /**
     * Add the routes for this controller and register them.
     */
    public function init()
    {
        $this->addRoute('/project', HttpMethods::GET, 'index');
        parent::init();
    }

    /**
     * Give an overview of all projects.
     * @return WP_REST_Response
     */
    public function index()
    {
        $projects = $this->projectRepository->findAll();
        return new WordPressRestResponse($projects);
    }
}
