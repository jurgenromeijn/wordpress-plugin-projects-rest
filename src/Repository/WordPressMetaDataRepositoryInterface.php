<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

/**
 * This interface describes all functionality the WordPressMetaDataRepository should have.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
interface WordPressMetaDataRepositoryInterface
{
    /**
     * Find an array of metadata for the specified attachment.
     * @param $attachmentId
     * @return array
     */
    public function find($attachmentId);
}
