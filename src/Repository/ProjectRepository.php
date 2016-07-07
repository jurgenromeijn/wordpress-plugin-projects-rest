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

    const TYPE_PROJECT = 'project';
    const UNLIMITED = -1;

    private $imageRepository;
    private $projectMapper;

    /**
     * ProjectRepository constructor.
     */
    private function __construct()
    {
        $this->imageRepository = ImageRepository::getInstance();
        $this->projectMapper = ProjectMapper::getInstance();
    }

    /**
     * find all projects.
     * @return array
     */
    public function findAll()
    {
        $projects = [];
        $projectPosts = get_posts([
            'post_type' => self::TYPE_PROJECT,
            'posts_per_page' => self::UNLIMITED
        ]);
        foreach ($projectPosts as $projectPost) {
            $project = $this->projectMapper->mapProject($projectPost);
            $projectImages = $this->imageRepository->findImages($project);
            $project->setImages($projectImages);
            $projects[] = $project;
        }
        return $projects;
    }
}