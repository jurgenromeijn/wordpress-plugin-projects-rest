<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use JurgenRomeijn\ProjectsRest\Repository\Mapper\ImageMapperInterface;
use WP_Post as WordPressPost;

/**
 * A repository to fetch images from the database.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
class ImageRepository implements ImageRepositoryInterface
{
    const TYPE_IMAGE = 'image';

    private $wordPressPostRepository;
    private $wordPressMetaDataRepository;
    private $imageMapper;

    /**
     * ImageRepository constructor.
     * @param WordPressPostRepositoryInterface $wordPressPostRepository
     * @param WordPressMetaDataRepositoryInterface $wordPressMetaDataRepository
     * @param ImageMapperInterface $imageMapper
     */
    public function __construct(
        WordPressPostRepositoryInterface $wordPressPostRepository,
        WordPressMetaDataRepositoryInterface $wordPressMetaDataRepository,
        ImageMapperInterface $imageMapper
    ) {
        $this->wordPressPostRepository = $wordPressPostRepository;
        $this->wordPressMetaDataRepository = $wordPressMetaDataRepository;
        $this->imageMapper = $imageMapper;
    }

    /**
     * Find images for a project.
     * @param int $projectId
     * @return array
     */
    public function findImages($projectId)
    {
        $images = [];

        $imagePosts = $this->wordPressPostRepository->findAllAttachedPosts($projectId, self::TYPE_IMAGE);
        if ($imagePosts !== null) {
            foreach ($imagePosts as $imagePost) {
                $metaData = $this->wordPressMetaDataRepository->findAttachmentMetaData($imagePost->ID);
                $images[] = $this->imageMapper->mapImage($imagePost, $metaData);
            }
        }

        return $images;
    }

    /**
     * Find the featured image for a project.
     * @param int $projectId
     * @return Image
     */
    public function findFeaturedImage($projectId)
    {
        $image = null;

        $imagePost = $this->wordPressPostRepository->findFeaturedImagePost($projectId);
        if ($imagePost !== null) {
            $metaData = $this->wordPressMetaDataRepository->findAttachmentMetaData($imagePost->ID);
            $image = $this->imageMapper->mapImage($imagePost, $metaData);
        }

        return $image;
    }
}
