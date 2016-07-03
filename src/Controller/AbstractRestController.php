<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Controller;

use JurgenRomeijn\ProjectsRest\ProjectRestPlugin;
use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;
use WP_REST_Controller;

abstract class AbstractRestController extends WP_REST_Controller
{
    use SingletonTrait;

    const REGISTER_REST_ROUTE_METHODS  = 'methods';
    const REGISTER_REST_ROUTE_CALLBACK = 'callback';

    abstract public function init();

    protected function registerRoute($route, $httpMethod, $callback)
    {
        $apiBasePath = ProjectRestPlugin::getApiBasePath();
        register_rest_route($apiBasePath, $route, [
            self::REGISTER_REST_ROUTE_METHODS  => $httpMethod,
            self::REGISTER_REST_ROUTE_CALLBACK => [$this, $callback]
        ]);
    }
}
