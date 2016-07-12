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

        $variants = $this->getArrayFromMetaData(self::META_SIZES, $metaData);
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
            $this->getFullImageVariantUrl($image, $this->getValueFromMetaData(self::META_FILE, $variantMetaData))
        );
        $imageSizeVariant->setWidth($this->getValueFromMetaData(self::META_WIDTH, $variantMetaData));
        $imageSizeVariant->setHeight($this->getValueFromMetaData(self::META_HEIGHT, $variantMetaData));

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

    /**
     * Safely et an array from the meta data or return an empty one.
     * @param $key
     * @param $metaData
     * @return array
     */
    private function getArrayFromMetaData($key, $metaData)
    {
        $array = [];
        if (array_key_exists($key, $metaData)) {
            $array = $metaData[$key];
        }
        return $array;
    }

    /**
     * Safely get a value from the metadata or return null
     * @param $key
     * @param $metaData
     * @return
     */
    private function getValueFromMetaData($key, $metaData)
    {
        $value = null;
        if (array_key_exists($key, $metaData)) {
            $value = $metaData[$key];
        }
        return $value;
    }
}
