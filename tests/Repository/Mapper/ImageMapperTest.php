<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use JurgenRomeijn\ProjectsRest\Model\Rest\ImageSizeVariant;
use PHPUnit_Framework_TestCase as TestCase;
use WP_Post as WordPressPost;

class ImageMapperTest extends TestCase
{
    /**
     * @var WordPressPost
     */
    private $imagePost;
    /**
     * @var array
     */
    private $imageSizeVariants;

    public function setUp()
    {
        $this->imagePost = new WordPressPost((object)[
            'ID' => 1,
            'guid' => 'http://test.com/1.jpg',
            'post_title' => 'title1',
        ]);
        $this->imageSizeVariants = [
            'small' => new ImageSizeVariant('http://test.com/small/1.jpg', 100, 200),
            'medium' => new ImageSizeVariant('http://test.com/medium/1.jpg', 200, 400),
            'large' => new ImageSizeVariant('http://test.com/large/1.jpg', 400, 800)
        ];
    }

    public function testMapImage()
    {
        // data
        $imagePost = $this->imagePost;
        $metaData = [
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

        // mocks
        $sizeVariantMapperMock =
            $this
                ->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\Mapper\ImageSizeVariantMapperInterface')
                ->getMock();
        $sizeVariantMapperMock->method('mapImageSizeVariants')->willReturn($this->imageSizeVariants);

        // setup
        $imageMapper = new ImageMapper($sizeVariantMapperMock);
        $response = $imageMapper->mapImage($imagePost, $metaData);

        // tests
        $this->assertNotNull($response);
        $this->assertEquals($response->getUrl(), $imagePost->guid);
        $this->assertEquals($response->getCaption(), $imagePost->post_excerpt);
        $this->assertEquals($response->getAltText(), $imagePost->post_excerpt);
        $this->assertEquals($response->getWidth(), $metaData['width']);
        $this->assertEquals($response->getHeight(), $metaData['height']);
        $this->assertNotEmpty($response->getSizeVariants());
        $this->assertSameSize($response->getSizeVariants(), $this->imageSizeVariants);
        $this->assertEquals(
            $response->getSizeVariants()['medium']->getUrl(),
            $this->imageSizeVariants['medium']->getUrl()
        );
    }

    public function testMapImageNoVariants()
    {
        // data
        $imagePost = $this->imagePost;
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

        // mocks
        $sizeVariantMapperMock =
            $this
                ->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\Mapper\ImageSizeVariantMapperInterface')
                ->getMock();
        $sizeVariantMapperMock->method('mapImageSizeVariants')->willReturn([]);

        // setup
        $imageMapper = new ImageMapper($sizeVariantMapperMock);
        $response = $imageMapper->mapImage($imagePost, $metaData);

        // tests
        $this->assertNotNull($response);
        $this->assertEquals($response->getUrl(), $imagePost->guid);
        $this->assertEquals($response->getWidth(), $metaData['width']);
        $this->assertEquals($response->getHeight(), $metaData['height']);
        $this->assertNotNull($response->getSizeVariants());
        $this->assertEmpty($response->getSizeVariants());
    }

    public function testMapImageEmptyMeta()
    {
        // data
        $imagePost = $this->imagePost;
        $metaData = [];

        // mocks
        $sizeVariantMapperMock =
            $this
                ->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\Mapper\ImageSizeVariantMapperInterface')
                ->getMock();
        $sizeVariantMapperMock->method('mapImageSizeVariants')->willReturn([]);

        // setup
        $imageMapper = new ImageMapper($sizeVariantMapperMock);
        $response = $imageMapper->mapImage($imagePost, $metaData);

        // tests
        $this->assertNotNull($response);
        $this->assertEquals($response->getUrl(), $imagePost->guid);
        $this->assertNull($response->getWidth());
        $this->assertNull($response->getHeight());
        $this->assertNotNull($response->getSizeVariants());
        $this->assertEmpty($response->getSizeVariants());
    }
}
