<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\Projects\Util\SingletonTrait;
use JurgenRomeijn\ProjectsRest\Model\Rest\Project;
use WP_Post;

/**
 * All functionality to map a single or multiple WP_Post objects to Project objects.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
class ProjectMapper implements ProjectMapperInterface
{
    use SingletonTrait;

    /**
     * ProjectMapper constructor.
     */
    private function __construct()
    {
        // Do nothing
    }

    /**
     * Map an array of WP_Post objects to Project objects.
     * @param array $posts
     * @return array
     */
    public function mapProjects(array $posts)
    {
        $projects = [];

        foreach ($posts as $post) {
            $projects[] = $this->mapProject($post);
        }

        return $projects;
    }

    /**
     * Map a WP_Post object to a Project.
     * @param WP_Post $post
     * @return Project
     */
    public function mapProject(WP_Post $post)
    {
        $project = new Project();

        $project->setId($post->ID);
        $project->setSlug($post->post_name);
        $project->setTitle($post->post_title);
        $project->setContent($post->post_content);
        $project->setExcerpt($post->post_excerpt);

        return $project;
    }
}