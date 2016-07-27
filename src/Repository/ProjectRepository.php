<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Model\Rest\Project;
use JurgenRomeijn\ProjectsRest\Repository\Mapper\ProjectMapperInterface;
use WP_Post as WordPressPost;

/**
 * A repository to fetch projects from the database.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
class ProjectRepository implements ProjectRepositoryInterface
{
    const TYPE_PROJECT = 'project';

    private $wordPressPostRepository;
    private $wordPressMetaDataRepository;
    private $imageRepository;
    private $projectMapper;

    /**
     * ProjectRepository constructor.
     * @param WordPressPostRepositoryInterface $wordPressPostRepository
     * @param WordPressMetaDataRepositoryInterface $wordPressMetaDataRepository
     * @param ImageRepositoryInterface $imageRepository
     * @param ProjectMapperInterface $projectMapper
     */
    public function __construct(
        WordPressPostRepositoryInterface $wordPressPostRepository,
        WordPressMetaDataRepositoryInterface $wordPressMetaDataRepository,
        ImageRepositoryInterface $imageRepository,
        ProjectMapperInterface $projectMapper
    ) {
        $this->wordPressPostRepository = $wordPressPostRepository;
        $this->wordPressMetaDataRepository = $wordPressMetaDataRepository;
        $this->imageRepository = $imageRepository;
        $this->projectMapper = $projectMapper;
    }

    /**
     * find all projects.
     * @param bool $addImages
     * @return array
     */
    public function findAll($addImages = true)
    {
        $projects = [];

        $projectPosts = $this->wordPressPostRepository->findAll(self::TYPE_PROJECT);
        if ($projectPosts !== null && !empty($projectPosts)) {
            foreach ($projectPosts as $projectPost) {
                $projects[] = $this->createProjectFromWordPressPost($projectPost, $addImages);
            }
        }

        return $projects;
    }

    /**
     * Create a Project based on a WordPressPost
     * @param WordPressPost $projectPost
     * @param bool $addImages
     * @return Project
     */
    private function createProjectFromWordPressPost(WordPressPost $projectPost, $addImages)
    {
        $metaData = $this->wordPressMetaDataRepository->findPostMetaData($projectPost->ID);
        $metaData = ($metaData === null) ? [] : $metaData;
        $project = $this->projectMapper->mapProject($projectPost, $metaData);
        if ($addImages === true) {
            $this->addImagesToProject($project);
        }
        return $project;
    }
    
    /**
     * Fetch the images for the specified project and add them to the entity.
     * @param Project $project
     */
    private function addImagesToProject(Project $project)
    {
        $featuredImage = $this->imageRepository->findFeaturedImage($project->getId());
        $images = $this->imageRepository->findImages($project->getId());

        if ($featuredImage !== null) {
            $project->setFeaturedImage($featuredImage);
        }
        if ($images !== null) {
            $project->setImages($images);
        }
    }
}
