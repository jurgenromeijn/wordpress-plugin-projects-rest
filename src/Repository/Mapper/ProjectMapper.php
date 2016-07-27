<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Project;
use JurgenRomeijn\ProjectsRest\Util\ArrayHelper;
use WP_Post as WordPressPost;

/**
 * All functionality to map a single or multiple WP_Post objects to Project objects.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
class ProjectMapper implements ProjectMapperInterface
{
    const META_INTRO = 'intro';
    const META_INFO = 'info';

    /**
     * Map a WordPressPost object to a Project.
     * @param WordPressPost $post
     * @param array $metaData
     * @return Project
     */
    public function mapProject(WordPressPost $post, array $metaData)
    {
        $project = new Project();

        $project->setId($post->ID);
        $project->setSlug($post->post_name);
        $project->setTitle($post->post_title);
        $project->setIntro(ArrayHelper::findValue(self::META_INTRO, $metaData));
        $project->setContent($post->post_content);
        $project->setInfo(ArrayHelper::findValue(self::META_INFO, $metaData));
        $project->setExcerpt($post->post_excerpt);

        return $project;
    }
}