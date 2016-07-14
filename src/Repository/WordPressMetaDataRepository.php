<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

/**
 * A repository responsible for fetching attachment metadata from the database.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
class WordPressMetaDataRepository implements WordPressMetaDataRepositoryInterface
{
    /**
     * Find an array of metadata for the specified attachment.
     * @param int $attachmentId
     * @return array
     */
    public function find($attachmentId)
    {
        $metaData = wp_get_attachment_metadata($attachmentId);
        return ($metaData !== false) ? $metaData : [];
    }
}
