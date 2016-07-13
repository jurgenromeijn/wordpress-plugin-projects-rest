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
     * Find a WordPressPosts with a certain id;
     * @param int $id
     * @return WordPressPost
     */
    public function find($id);

    /**
     * Find all WordPressPosts or specify a single postType to return.
     * @param string $postType
     * @return array
     */
    public function findAll($postType = null);

    /**
     * Find the post representing the featured image of a post.
     * @param int $postId
     * @return WordPressPost
     */
    public function findFeaturedImagePost($postId);

    /**
     * Find all WordPressPost objects that represent a media item that is attached to a post.
     * @param int $postId
     * @param string $type
     * @return array
     */
    public function findAllAttachedPosts($postId, $type);
}
