<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Model\Rest;

/**
 * This class represents the ImageSizeVariant entity.
 * @package JurgenRomeijn\ProjectsRest\Model\Rest
 */
class ImageSizeVariant
{
    private $url;
    private $height;
    private $width;

    /**
     * ImageSizeVariant constructor.
     * @param string $url
     * @param int $height
     * @param int $width
     */
    public function __construct($url = null, $height = 0, $width = 0)
    {
        $this->url = $url;
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }
}
