<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

/**
 * This interface describes all functionality the ProjectRepository should have.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
interface ProjectRepositoryInterface
{
    /**
     * find all projects.
     * @return array
     */
    public function findAll();
}
