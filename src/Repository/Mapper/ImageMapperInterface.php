<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use WP_Post as WordPressPost;

/**
 * All functionality to map a WP_Post objects and an array of meta data to an Image object.
 * @package JurgenRomeijn\ProjectsRest\Repository\Mapper
 */
interface ImageMapperInterface
{
    /**
     * Map a WordPressPost object and an array of meta data to an Image object.
     * @param WordPressPost $image
     * @param array $metaData
     * @return Image
     */
    public function mapImage(WordPressPost $image, array $metaData);
}
