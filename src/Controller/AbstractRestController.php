<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Controller;

use JurgenRomeijn\ProjectsRest\Model\Internal\Route;
use JurgenRomeijn\ProjectsRest\ProjectRestPlugin;
use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;
use WP_REST_Controller;

abstract class AbstractRestController extends WP_REST_Controller
{
    use SingletonTrait;

    const REGISTER_REST_ROUTE_METHODS  = 'methods';
    const REGISTER_REST_ROUTE_CALLBACK = 'callback';

    public $routes = [];

    public function init()
    {
        add_action('rest_api_init', array($this, 'registerRoutes'));
    }

    public function registerRoutes()
    {
        $apiBasePath = ProjectRestPlugin::getApiBasePath();
        foreach ($this->routes as $route) {
            register_rest_route($apiBasePath, $route->getRoute(), [
                self::REGISTER_REST_ROUTE_METHODS  => $route->getHttpMethod(),
                self::REGISTER_REST_ROUTE_CALLBACK => [$this, $route->getCallback()]
            ]);
        }
    }

    protected function addRoute($route, $httpMethod, $callback)
    {
        $this->routes[] = new Route($route, $httpMethod, $callback);
    }
}
