<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Model\Internal;

/**
 * This class represents a route in our rest interface.
 * @package JurgenRomeijn\ProjectsRest\Model\Internal
 */
class Route
{
    private $route;
    private $httpMethod;
    private $callback;

    /**
     * Route constructor.
     * @param string $route
     * @param string $httpMethod
     * @param string $callback
     */
    public function __construct($route, $httpMethod, $callback)
    {
        $this->route = $route;
        $this->httpMethod = $httpMethod;
        $this->callback = $callback;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @param string $httpMethod
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * @return string
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param string $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }
}
