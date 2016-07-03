<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Model\Rest\Project;

/**
 * This interface describes all functionality the ProjectRepository should have.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
interface ProjectRepositoryInterface
{
    /**
     * find all projects.
     * @return Project
     */
    public function findAll();
}
