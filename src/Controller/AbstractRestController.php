<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Controller;

use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;
use WP_REST_Controller;

abstract class AbstractRestController extends WP_REST_Controller
{
    use SingletonTrait;
}
