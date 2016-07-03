<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Util;

/**
 * An enum containing all HTTP methods
 * @package JurgenRomeijn\ProjectsRest\Util
 */
abstract class HttpMethods
{
    const OPTIONS = 'OPTIONS';
    const GET     = 'GET';
    const HEAD    = 'HEAD';
    const POST    = 'POST';
    const PUT     = 'PUT';
    const DELETE  = 'DELETE';
    const TRACE   = 'TRACE';
    const CONNECT = 'CONNECT';
}
