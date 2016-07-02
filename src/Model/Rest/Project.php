<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Model\Rest;

/**
 * This class represents the Project entity.
 * @package JurgenRomeijn\ProjectsRest\Model\Rest
 */
class Project
{
    private $slug;
    private $title;
    private $content;
    private $excerpt;
    private $featuredImage;
    private $images;

    /**
     * Project constructor.
     * @param string $slug
     * @param string $title
     * @param string $content
     * @param string $excerpt
     * @param Image $featuredImage
     * @param array $images
     */
    public function __construct(
        $slug = null,
        $title = null,
        $content = null,
        $excerpt = null,
        Image $featuredImage = null,
        array $images = array()
    ) {
        $this->slug = $slug;
        $this->title = $title;
        $this->content = $content;
        $this->excerpt = $excerpt;
        $this->featuredImage = $featuredImage;
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * @param string $excerpt
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
    }

    /**
     * @return Image
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    /**
     * @param Image $featuredImage
     */
    public function setFeaturedImage($featuredImage)
    {
        $this->featuredImage = $featuredImage;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

}
