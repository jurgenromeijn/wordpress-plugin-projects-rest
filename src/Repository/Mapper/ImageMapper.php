<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;
use WP_Post;

/**
 * All functionality to map a WP_Post objects and an array of meta data to an Image object.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
class ImageMapper implements ImageMapperInterface
{
    use SingletonTrait;

    const META_WIDTH  = 'width';
    const META_HEIGHT = 'height';

    /**
     * ImageMapper constructor.
     */
    private function __construct()
    {
        // Do nothing
    }

    /**
     * Map a WP_Post object and an array of meta data to an Image object.
     * @param WP_Post $postImage
     * @param array $metaData
     * @return Image
     */
    public function mapImage(WP_Post $postImage, array $metaData)
    {
        $image = new Image();

        $image->setUrl($postImage->guid);
        $image->setCaption($postImage->post_excerpt);
        $image->setWidth($metaData[self::META_WIDTH]);
        $image->setHeight($metaData[self::META_HEIGHT]);

        return $image;
    }
}