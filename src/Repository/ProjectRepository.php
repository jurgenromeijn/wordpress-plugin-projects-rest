<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Model\Rest\Project;
use JurgenRomeijn\ProjectsRest\Repository\Mapper\ProjectMapper;
use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;

/**
 * A repository to fetch projects from the database.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
class ProjectRepository implements ProjectRepositoryInterface
{
    use SingletonTrait;

    private $projectMapper;

    /**
     * ProjectRepository constructor.
     */
    private function __construct()
    {
        $this->projectMapper = ProjectMapper::getInstance();
    }

    /**
     * find all projects.
     * @return Project
     */
    public function findAll()
    {
        $projectPosts = get_posts([
            'post_type' => 'project',
            'posts_per_page' => -1
        ]);
        return $this->projectMapper->mapProjects($projectPosts);
    }
}