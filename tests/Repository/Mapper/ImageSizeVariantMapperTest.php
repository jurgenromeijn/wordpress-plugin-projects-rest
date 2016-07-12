<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use PHPUnit_Framework_TestCase as TestCase;

class ImageSizeVariantMapperTest extends TestCase
{
    /**
     * @var Image
     */
    private $image;
    /**
     * @var array
     */
    private $metaData;
    /**
     * @var ImageSizeVariantMapper
     */
    private $imageVariantSizeMapper;

    public function setUp()
    {
        $this->image = new Image(
            'http://test.com/1.jpg',
            200,
            400,
            'alt',
            'caption'
        );
        $this->metaData = [
            'width' => 1170,
            'height' => 800,
            'file' => '2013/08/1.jpg',
            'sizes' => [
                'thumbnail' => [
                    'file' => '1-150x150.jpg',
                    'width' => 150,
                    'height' => 150,
                    'mime-type' => 'image/jpeg'
                ],
                'medium' => ['file' => '1-300x205.jpg', 'width' => 300, 'height' => 205, 'mime-type' => 'image/jpeg'],
                'medium_large' => [
                    'file' => '1-768x525.jpg',
                    'width' => 768,
                    'height' => 525,
                    'mime-type' => 'image/jpeg'
                ],
                'large' => ['file' => '1-1024x700.jpg', 'width' => 1024, 'height' => 700, 'mime-type' => 'image/jpeg'],
                'post-thumbnail' => [
                    'file' => '1-825x510.jpg',
                    'width' => 825,
                    'height' => 510,
                    'mime-type' => 'image/jpeg'
                ]
            ],
            'image_meta' => [
                'aperture' => '0',
                'credit' => '',
                'camera' => '',
                'caption' => '',
                'created_timestamp' => '0',
                'copyright' => '',
                'focal_length' => '0',
                'iso' => '0',
                'shutter_speed' => '0',
                'title' => '',
                'orientation' => '0',
                'keywords' => []
            ]
        ];
        $this->imageVariantSizeMapper = new ImageSizeVariantMapper();
    }

    public function testMapImageSizeVariants()
    {
        // setup
        $result = $this->imageVariantSizeMapper->mapImageSizeVariants($this->image, $this->metaData);

        // tests
        $this->assertNotNull($result);
        $this->assertNotEmpty($result);
        $this->assertSameSize($result, $this->metaData['sizes']);
        $this->assertEquals($result['medium']->getHeight(), $this->metaData['sizes']['medium']['height']);
    }

    public function testMapImageSizeVariantsInvalid()
    {
        // data
        $metaData = [
            'width' => 1170,
            'height' => 800,
            'file' => '2013/08/1.jpg',
            'sizes' => [
                [
                    'file' => '1-150x150.jpg',
                    'width' => 150,
                    'height' => 150,
                    'mime-type' => 'image/jpeg'
                ],
                ['file' => '1-300x205.jpg', 'width' => 300, 'height' => 205, 'mime-type' => 'image/jpeg'],
                [
                    'file' => '1-768x525.jpg',
                    'width' => 768,
                    'height' => 525,
                    'mime-type' => 'image/jpeg'
                ],
                ['file' => '1-1024x700.jpg', 'width' => 1024, 'height' => 700, 'mime-type' => 'image/jpeg'],
                [
                    'file' => '1-825x510.jpg',
                    'width' => 825,
                    'height' => 510,
                    'mime-type' => 'image/jpeg'
                ]
            ],
            'image_meta' => [
                'aperture' => '0',
                'credit' => '',
                'camera' => '',
                'caption' => '',
                'created_timestamp' => '0',
                'copyright' => '',
                'focal_length' => '0',
                'iso' => '0',
                'shutter_speed' => '0',
                'title' => '',
                'orientation' => '0',
                'keywords' => []
            ]
        ];

        // setup
        $result = $this->imageVariantSizeMapper->mapImageSizeVariants($this->image, $metaData);

        // tests
        $this->assertNotNull($result);
        $this->assertEmpty($result);
    }

    public function testMapImageSizeVariantsEmpty()
    {
        // data
        $metaData = [
            'width' => 1170,
            'height' => 800,
            'file' => '2013/08/1.jpg',
            'image_meta' => [
                'aperture' => '0',
                'credit' => '',
                'camera' => '',
                'caption' => '',
                'created_timestamp' => '0',
                'copyright' => '',
                'focal_length' => '0',
                'iso' => '0',
                'shutter_speed' => '0',
                'title' => '',
                'orientation' => '0',
                'keywords' => []
            ]
        ];

        // setup
        $result = $this->imageVariantSizeMapper->mapImageSizeVariants($this->image, $metaData);

        // tests
        $this->assertNotNull($result);
        $this->assertEmpty($result);
    }

    public function testMapImageSizeVariant()
    {
        // data
        $metaData = $this->metaData['sizes']['medium'];

        // setup
        $result = $this->imageVariantSizeMapper->mapImageSizeVariant($this->image, $metaData);

        // tests
        $this->assertNotNull($result);
        $this->assertEquals($result->getUrl(), 'http://test.com/1-300x205.jpg');
        $this->assertEquals($result->getHeight(), $metaData['height']);
        $this->assertEquals($result->getWidth(), $metaData['width']);
    }

    public function testMapImageSizeVariantEmpty()
    {
        // data
        $metaData = [];

        // setup
        $result = $this->imageVariantSizeMapper->mapImageSizeVariant($this->image, $metaData);

        // tests
        $this->assertNotNull($result);
        $this->assertEmpty($result->getUrl());
        $this->assertEmpty($result->getHeight());
        $this->assertEmpty($result->getWidth());
    }
}