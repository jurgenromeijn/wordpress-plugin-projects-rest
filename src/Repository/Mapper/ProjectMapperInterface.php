<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Project;
use WP_Post as WordPressPost;

/**
 * All functionality to map a single or multiple WP_Post objects to Project objects.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
interface ProjectMapperInterface
{
    /**
     * Map a WordPressPost object to a Project.
     * @param WordPressPost $post
     * @return Project
     */
    public function mapProject(WordPressPost $post);
}