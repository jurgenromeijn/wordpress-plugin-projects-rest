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
        $this->projectMapper   = ProjectMapper::getInstance();
    }

    /**
     * find all projects.
     * @param bool $addImages
     * @return array
     */
    public function findAll($addImages = true)
    {
        $projectPosts = get_posts([
            'post_type' => self::TYPE_PROJECT,
            'posts_per_page' => self::UNLIMITED
        ]);
        $projects = $this->projectMapper->mapProjects($projectPosts);
        if ($addImages === true) {
            $this->addImagesToProjects($projects);
        }
        return $projects;
    }

    /**
     * Fetch the images for the specified projects and add them to the entity.
     * @param array $projects
     */
    private function addImagesToProjects(array $projects)
    {
        foreach ($projects as $project) {
            $images = $this->imageRepository->findImages($project);
            $project->setImages($images);
        }
    }
}