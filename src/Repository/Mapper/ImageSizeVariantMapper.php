<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\ImageSizeVariant;
use JurgenRomeijn\ProjectsRest\Util\SingletonTrait;

/**
 * All functionality to map an array of metadata to the ImageSizeVariant entity.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
class ImageSizeVariantMapper implements ImageSizeVariantMapperInterface
{
    use SingletonTrait;

    /**
     * ImageSizeVariantMapper constructor.
     */
    public function __construct()
    {
        // Do nothing
    }

    /**
     * Map the meta data to an associative array of image size variants.
     * @param array $metaData
     * @return array
     */
    public function mapImageSizeVariants(array $metaData)
    {
        // TODO: Implement mapImageSizeVariants() method.
    }

    /**
     * Map the specific meta data of an image to a size variant.
     * @param array $variantMetaData
     * @return ImageSizeVariant
     */
    public function mapImageSizeVariant(array $variantMetaData)
    {
        // TODO: Implement mapImageSizeVariant() method.
    }
}
