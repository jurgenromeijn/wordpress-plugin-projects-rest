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
class ImageSizeVariantMapper implements ImageSizeVariantMapperInterface
{
    const META_SIZES  = 'sizes';
    const META_WIDTH  = 'width';
    const META_HEIGHT = 'height';
    const META_FILE   = 'file';

    /**
     * Map the meta data to an associative array of image size variants.
     * @param Image $image
     * @param array $metaData
     * @return array
     */
    public function mapImageSizeVariants(Image $image, array $metaData)
    {
        $imageSizeVariants = [];

        $variants = $metaData[self::META_SIZES];
        foreach ($variants as $variantName => $variantMetaData) {
            $imageSizeVariants[$variantName] = $this->mapImageSizeVariant($image, $variantMetaData);
        }

        return $imageSizeVariants;
    }

    /**
     * Map the specific meta data of an image to a size variant.
     * @param Image $image
     * @param array $variantMetaData
     * @return ImageSizeVariant
     */
    public function mapImageSizeVariant(Image $image, array $variantMetaData)
    {
        $imageSizeVariant = new ImageSizeVariant();

        $imageSizeVariant->setUrl($this->getFullImageVariantUrl($image, $variantMetaData[self::META_FILE]));
        $imageSizeVariant->setWidth($variantMetaData[self::META_WIDTH]);
        $imageSizeVariant->setHeight($variantMetaData[self::META_HEIGHT]);

        return $imageSizeVariant;
    }

    /**
     * Use the Image object to create the full url for the variant.
     * @param Image $image
     * @param string $fileName
     * @return string
     */
    private function getFullImageVariantUrl(Image $image, $fileName)
    {
        $imageUrl = $image->getUrl();
        $oldFileName = basename($imageUrl);
        return str_replace($oldFileName, $fileName, $imageUrl);
    }
}
