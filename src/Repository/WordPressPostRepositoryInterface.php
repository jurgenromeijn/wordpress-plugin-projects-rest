<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use WP_Post as WordPressPost;

/**
 * This interface describes all functionality the WordPressPostRepository should have.
 * @package JurgenRomeijn\ProjectsRest\Repository
 */
interface WordPressPostRepositoryInterface
{
    /**
     * Find all WordPressPosts or specify a single postType to return.
     * @param string $postType
     * @return WordPressPost|
     */
    public function findAll($postType = '');

    /**
     * Find a WordPressPosts with a certain id;
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Find all WordPressPost objects that represent a media item that is attached to a post.
     * @param int $postId
     * @return WordPressPost
     */
    public function findAllAttachedImagePosts($postId);
}
