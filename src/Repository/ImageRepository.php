<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use JurgenRomeijn\ProjectsRest\Model\Rest\Project;
use JurgenRomeijn\ProjectsRest\Repository\Mapper\ImageMapper;
use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;
use WP_Post;

/**
 * A repository to fetch images from the database.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
class ImageRepository implements ImageRepositoryInterface
{
    use SingletonTrait;

    const TYPE_IMAGE = 'image';

    private $imageMapper;

    /**
     * ImageRepository constructor.
     */
    private function __construct()
    {
        $this->imageMapper = ImageMapper::getInstance();
    }

    /**
     * Find images for a project.
     * @param Project $project
     * @return array
     */
    public function findImages(Project $project)
    {
        $images = [];
        $imagePosts = get_attached_media(self::TYPE_IMAGE, $project->getId());
        foreach ($imagePosts as $imagePost) {
            $metaData = $this->getImageMetaData($imagePost);
            $images[] = $this->imageMapper->mapImage($imagePost, $metaData);
        }
        return $images;
    }

    /**
     * @param WP_Post $image
     * @return array
     */
    private function getImageMetaData(WP_Post $image)
    {
        $metaData = wp_get_attachment_metadata($image->ID);
        return ($metaData !== false ) ? $metaData : null;
    }

    /**
     * Find the featured image for a project.
     * @param Project $project
     * @return Image
     */
    public function findFeaturedImage(Project $project)
    {
        // TODO: Implement findFeaturedImage() method.
    }
}
