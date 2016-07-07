<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Model\Rest;

/**
 * This class represents the Image entity.
 * @package JurgenRomeijn\ProjectsRest\Model\Rest
 */
class Image extends ImageSizeVariant
{
    public $altText;
    public $caption;
    private $sizeVariants;

    /**
     * Image constructor.
     * @param string $url
     * @param int $height
     * @param int $width
     * @param string $altText
     * @param string $caption
     * @param array $sizeVariants
     */
    public function __construct(
        $url = null,
        $height = 0,
        $width = 0,
        $altText = null,
        $caption = null,
        array $sizeVariants = []
    ) {
        $this->setUrl($url);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->altText = $altText;
        $this->caption = $caption;
        $this->sizeVariants = $sizeVariants;
    }

    /**
     * @return string
     */
    public function getAltText()
    {
        return $this->altText;
    }

    /**
     * @param string $altText
     */
    public function setAltText($altText)
    {
        $this->altText = $altText;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    /**
     * @return array
     */
    public function getSizeVariants()
    {
        return $this->sizeVariants;
    }

    /**
     * @param array $sizeVariants
     */
    public function setSizeVariants($sizeVariants)
    {
        $this->sizeVariants = $sizeVariants;
    }
}
