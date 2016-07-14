<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use JurgenRomeijn\ProjectsRest\Util\ArrayHelper;
use WP_Post as WordPressPost;

/**
 * All functionality to map a WP_Post objects and an array of meta data to an Image object.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
class ImageMapper implements ImageMapperInterface
{
    const META_WIDTH  = 'width';
    const META_HEIGHT = 'height';

    private $imageSizeVariantMapper;

    /**
     * ImageMapper constructor.
     * @param ImageSizeVariantMapperInterface $imageSizeVariantMapper
     */
    public function __construct(ImageSizeVariantMapperInterface $imageSizeVariantMapper)
    {
        $this->imageSizeVariantMapper = $imageSizeVariantMapper;
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
        $image->setWidth(ArrayHelper::findValue(self::META_WIDTH, $metaData));
        $image->setHeight(ArrayHelper::findValue(self::META_HEIGHT, $metaData));
        $image->setSizeVariants($this->imageSizeVariantMapper->mapImageSizeVariants($image, $metaData));

        return $image;
    }
}