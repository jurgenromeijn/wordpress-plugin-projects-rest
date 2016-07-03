<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Model\Rest\Project;

/**
 * This interface describes all functionality the ImageRepository should have.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
interface ImageRepositoryInterface
{
    /**
     * Find images for a project.
     * @param Project $project
     * @return array
     */
    public function findImages(Project $project);
}
