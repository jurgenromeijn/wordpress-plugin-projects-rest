<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;

/**
 * This interface describes all functionality the ImageRepository should have.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
interface ImageRepositoryInterface
{
    /**
     * Find images for a project.
     * @param int $projectId
     * @return array
     */
    public function findImages($projectId);

    /**
     * Find the featured image for a project.
     * @param int $projectId
     * @return Image
     */
    public function findFeaturedImage($projectId);
}
