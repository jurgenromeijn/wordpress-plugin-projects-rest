<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Controller;

use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;

/**
 * The main controller which manages the Project entity.
 * @package JurgenRomeijn\ProjectsRest\Controller
 */
class ProjectController extends \WP_REST_Controller
{
    use SingletonTrait;
}
