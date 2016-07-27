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
    private $id;
    public $slug;
    public $title;
    public $intro;
    public $content;
    public $info;
    public $excerpt;
    public $featuredImage;
    public $images;

    /**
     * Project constructor.
     * @param int $id
     * @param string $slug
     * @param string $title
     * @param string $intro
     * @param string $content
     * @param string $info
     * @param string $excerpt
     * @param Image $featuredImage
     * @param array $images
     */
    public function __construct(
        $id = null,
        $slug = null,
        $title = null,
        $intro = null,
        $content = null,
        $info = null,
        $excerpt = null,
        Image $featuredImage = null,
        array $images = []
    ) {
        $this->id = $id;
        $this->slug = $slug;
        $this->title = $title;
        $this->intro = $intro;
        $this->content = $content;
        $this->info = $info;
        $this->excerpt = $excerpt;
        $this->featuredImage = $featuredImage;
        $this->images = $images;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * @param string $intro
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
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
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
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
