<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Project;
use WP_Post;

/**
 * All functionality to map a WP_Post objects to Project object.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
interface ProjectMapperInterface
{
    /**
     * Map a WP_Post object to a Project.
     * @param WP_Post $post
     * @return Project
     */
    public function mapProject(WP_Post $post);
}