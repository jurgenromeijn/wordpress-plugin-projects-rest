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
    private function __construct()
    {
    }

    public function init()
    {
        $this->registerRoute('/project', HttpMethods::GET, 'index');
    }

    public function index()
    {
        return new \WP_REST_Response('test');
    }
}
