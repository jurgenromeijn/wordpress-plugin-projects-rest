<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use JurgenRomeijn\ProjectsRest\Model\Rest\ImageSizeVariant;
use JurgenRomeijn\ProjectsRest\Util\ArrayHelper;

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

        $variants = ArrayHelper::findArray(self::META_SIZES, $metaData);
        foreach ($variants as $variantName => $variantMetaData) {
            if (is_string($variantName) and !empty($variantMetaData)) {
                $imageSizeVariants[$variantName] = $this->mapImageSizeVariant($image, $variantMetaData);
            }
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

        $imageSizeVariant->setUrl(
            $this->getFullImageVariantUrl($image, ArrayHelper::findValue(self::META_FILE, $variantMetaData))
        );
        $imageSizeVariant->setWidth(ArrayHelper::findValue(self::META_WIDTH, $variantMetaData));
        $imageSizeVariant->setHeight(ArrayHelper::findValue(self::META_HEIGHT, $variantMetaData));

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
        $url = null;
        if ($fileName !== null && !empty($fileName)) {
            $imageUrl = $image->getUrl();
            $oldFileName = basename($imageUrl);
            $url = str_replace($oldFileName, $fileName, $imageUrl);
        }
        return $url;
    }
}
