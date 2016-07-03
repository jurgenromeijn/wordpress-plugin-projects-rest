<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Controller;

use JurgenRomeijn\ProjectsRest\Util\HttpMethods;

/**
 * The main controller which manages the Project entity.
 * @package JurgenRomeijn\ProjectsRest\Controller
 */
class ProjectController extends AbstractRestController
{
    /**
     * ProjectController constructor.
     */
    protected function __construct()
    {
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
     * @return \WP_REST_Response
     */
    public function index()
    {
        // Todo: implement
        return new \WP_REST_Response('test');
    }
}
