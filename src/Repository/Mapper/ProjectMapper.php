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
class ProjectMapper implements ProjectMapperInterface
{
    /**
     * Map an array of WordPressPost objects to Project objects.
     * @param array $posts
     * @return array
     */
    public function mapProjects(array $posts)
    {
        $projects = [];

        foreach ($posts as $post) {
            if ($post !== null) {
                $projects[] = $this->mapProject($post);
            }
        }

        return $projects;
    }

    /**
     * Map a WordPressPost object to a Project.
     * @param WordPressPost $post
     * @return Project
     */
    public function mapProject(WordPressPost $post)
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