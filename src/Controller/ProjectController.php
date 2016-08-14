<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Controller;

use JurgenRomeijn\ProjectsRest\Repository\ProjectRepositoryInterface;
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
     * @param ProjectRepositoryInterface $projectRepository
     */
    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Add the routes for this controller and register them.
     */
    public function init()
    {
        $this->addRoute('/projects', HttpMethods::GET, 'index');
        parent::init();
    }

    /**
     * Give an overview of all projects.
     * @return WP_REST_Response
     */
    public function index()
    {
        $projects = $this->projectRepository->findAll();
        if ($projects === null) {
            $projects = [];
        }
        return new WordPressRestResponse($projects);
    }
}
