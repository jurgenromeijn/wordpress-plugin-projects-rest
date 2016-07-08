<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use JurgenRomeijn\ProjectsRest\Model\Rest\ImageSizeVariant;

/**
 * All functionality to map an array of metadata to the ImageSizeVariant entity.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
interface ImageSizeVariantMapperInterface
{
    /**
     * Map the meta data to an associative array of image size variants.
     * @param Image $image
     * @param array $metaData
     * @return array
     */
    public function mapImageSizeVariants(Image $image, array $metaData);

    /**
     * Map the specific meta data of an image to a size variant.
     * @param array $variantMetaData
     * @return ImageSizeVariant
     */
    public function mapImageSizeVariant(Image $image, array $variantMetaData);
}
