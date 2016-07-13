<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use WP_Post as WordPressPost;

class WordPressPostRepository implements WordPressPostRepositoryInterface
{
    const UNLIMITED = -1;
    const TYPE_IMAGE = 'image';

    /**
     * Find a WordPressPosts with a certain id;
     * @param int $id
     * @return WordPressPost
     */
    public function find($id)
    {
        return get_post($id);
    }

    /**
     * Find all WordPressPosts or specify a single postType to return.
     * @param string $postType
     * @return array
     */
    public function findAll($postType = null)
    {
        return get_posts([
            'post_type' => $postType,
            'posts_per_page' => self::UNLIMITED
        ]);
    }

    /**
     * Find the post representing the featured image of a post.
     * @param int $postId
     * @return WordPressPost
     */
    public function findFeaturedImagePost($postId)
    {
        $thumbNailPost = null;
        $thumbNailId = get_post_thumbnail_id($postId);
        if ($thumbNailId !== null) {
            $thumbNailPost = $this->find($postId);
        }
        return $thumbNailPost;
    }

    /**
     * Find all WordPressPost objects that represent a media item that is attached to a post.
     * @param int $postId
     * @return array
     */
    public function findAllAttachedImagePosts($postId)
    {
        return get_attached_media(self::TYPE_IMAGE, $postId);
    }
}
