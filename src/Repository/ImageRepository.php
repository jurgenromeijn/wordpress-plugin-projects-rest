<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Model\Rest\Project;

/**
 * A repository to fetch images from the database.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
class ImageRepository implements ImageRepositoryInterface
{
    /**
     * Find images for a project.
     * @param Project $project
     * @return array
     */
    public function findImages(Project $project)
    {
        // TODO: Implement findImages() method.
    }
}
