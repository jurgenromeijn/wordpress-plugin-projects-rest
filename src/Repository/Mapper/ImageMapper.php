<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;
use WP_Post as WordPressPost;

/**
 * All functionality to map a WP_Post objects and an array of meta data to an Image object.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
class ImageMapper implements ImageMapperInterface
{
    use SingletonTrait;

    const META_WIDTH  = 'width';
    const META_HEIGHT = 'height';

    private $imageSizeVariantMapper;

    /**
     * ImageMapper constructor.
     */
    private function __construct()
    {
        $this->imageSizeVariantMapper = ImageSizeVariantMapper::getInstance();
    }

    /**
     * Map a WP_Post object and an array of meta data to an Image object.
     * @param WordPressPost $postImage
     * @param array $metaData
     * @return Image
     */
    public function mapImage(WordPressPost $postImage, array $metaData)
    {
        $image = new Image();

        $image->setUrl($postImage->guid);
        $image->setAltText($postImage->post_excerpt);
        $image->setCaption($postImage->post_excerpt);
        $image->setWidth($metaData[self::META_WIDTH]);
        $image->setHeight($metaData[self::META_HEIGHT]);
        $image->setSizeVariants($this->imageSizeVariantMapper->mapImageSizeVariants($image, $metaData));

        return $image;
    }
}