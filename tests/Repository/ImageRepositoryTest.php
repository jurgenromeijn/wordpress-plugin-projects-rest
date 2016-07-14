<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Repository\Mapper\ImageMapper;
use JurgenRomeijn\ProjectsRest\Repository\Mapper\ImageSizeVariantMapper;
use PHPUnit_Framework_TestCase as TestCase;
use WP_Post as WordPressPost;

class ImageRepositoryTest extends TestCase
{
    private $imagePosts;
    private $metaData;

    public function setUp()
    {
        $this->imagePosts = [
            new WordPressPost((object)[
                'ID' => 1,
                'guid' => 'http://test.com/1.jpg',
                'post_excerpt' => 'excerpt1',
            ]),
            new WordPressPost((object)[
                'ID' => 2,
                'guid' => 'http://test.com/2.jpg',
                'post_excerpt' => 'excerpt2',
            ])
        ];
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
    }

    public function testFindImages()
    {
        // data
        $imagePosts = $this->imagePosts;
        $metaData = $this->metaData;

        // mocks
        $postRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressPostRepositoryInterface')->getMock();
        $postRepositoryMock->method('findAllAttachedPosts')->willReturn($imagePosts);

        $metaDataRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressMetaDataRepositoryInterface')
                ->getMock();
        $metaDataRepositoryMock->method('find')->willReturn($metaData);

        // setup
        $imageRepository = new ImageRepository(
            $postRepositoryMock,
            $metaDataRepositoryMock,
            new ImageMapper(new ImageSizeVariantMapper())
        );
        $results = $imageRepository->findImages(1);

        // tests
        $this->assertNotNull($results);
        $this->assertNotEmpty($results);
        $this->assertSameSize($results, $imagePosts);
        $this->assertEquals($results[0]->getUrl(), $imagePosts[0]->guid);
        $this->assertEquals($results[0]->getAltText(), $imagePosts[0]->post_excerpt);
        $this->assertEquals($results[0]->getCaption(), $imagePosts[0]->post_excerpt);
        $this->assertEquals($results[0]->getHeight(), $metaData['height']);
        $this->assertEquals($results[0]->getWidth(), $metaData['width']);
        $this->assertNotNull($results[0]->getSizeVariants());
        $this->assertNotEmpty($results[0]->getSizeVariants());
        $this->assertEquals($results[0]->getSizeVariants()['thumbnail']->getUrl(), 'http://test.com/1-150x150.jpg');
    }

    public function testFindImagesEmpty()
    {
        // mocks
        $postRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressPostRepositoryInterface')->getMock();
        $postRepositoryMock->method('findAllAttachedPosts')->willReturn([]);

        $metaDataRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressMetaDataRepositoryInterface')
                ->getMock();
        $metaDataRepositoryMock->method('find')->willReturn([]);

        // setup
        $imageRepository = new ImageRepository(
            $postRepositoryMock,
            $metaDataRepositoryMock,
            new ImageMapper(new ImageSizeVariantMapper())
        );
        $results = $imageRepository->findImages(1);

        // tests
        $this->assertNotNull($results);
        $this->assertEmpty($results);
    }

    public function testFindImagesNull()
    {
        // mocks
        $postRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressPostRepositoryInterface')->getMock();
        $postRepositoryMock->method('findAllAttachedPosts')->willReturn(null);

        $metaDataRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressMetaDataRepositoryInterface')
                ->getMock();
        $metaDataRepositoryMock->method('find')->willReturn(null);

        // setup
        $imageRepository = new ImageRepository(
            $postRepositoryMock,
            $metaDataRepositoryMock,
            new ImageMapper(new ImageSizeVariantMapper())
        );
        $results = $imageRepository->findImages(1);

        // tests
        $this->assertNotNull($results);
        $this->assertEmpty($results);
    }

    public function testFindFeaturedImages()
    {
        // data
        $imagePost = $this->imagePosts[0];
        $metaData = $this->metaData;

        // mock
        $postRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressPostRepositoryInterface')->getMock();
        $postRepositoryMock->method('findFeaturedImagePost')->willReturn($imagePost);

        $metaDataRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressMetaDataRepositoryInterface')
                ->getMock();
        $metaDataRepositoryMock->method('find')->willReturn($metaData);

        // setup
        $imageRepository = new ImageRepository(
            $postRepositoryMock,
            $metaDataRepositoryMock,
            new ImageMapper(new ImageSizeVariantMapper())
        );
        $result = $imageRepository->findFeaturedImage(1);

        //tests
        $this->assertNotNull($result);
        $this->assertEquals($result->getUrl(), $imagePost->guid);
        $this->assertEquals($result->getAltText(), $imagePost->post_excerpt);
        $this->assertEquals($result->getCaption(), $imagePost->post_excerpt);
        $this->assertEquals($result->getHeight(), $metaData['height']);
        $this->assertEquals($result->getWidth(), $metaData['width']);
        $this->assertNotNull($result->getSizeVariants());
        $this->assertNotEmpty($result->getSizeVariants());
        $this->assertEquals($result->getSizeVariants()['thumbnail']->getUrl(), 'http://test.com/1-150x150.jpg');
    }

    public function testFindFeaturedImagesNull()
    {
        // mock
        $postRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressPostRepositoryInterface')->getMock();
        $postRepositoryMock->method('findFeaturedImagePost')->willReturn(null);

        $metaDataRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressMetaDataRepositoryInterface')
                ->getMock();
        $metaDataRepositoryMock->method('find')->willReturn([]);

        // setup
        $imageRepository = new ImageRepository(
            $postRepositoryMock,
            $metaDataRepositoryMock,
            new ImageMapper(new ImageSizeVariantMapper())
        );
        $result = $imageRepository->findFeaturedImage(1);

        //tests
        $this->assertNull($result);
    }

    public function testFindFeaturedImagesNullMetaNull()
    {
        // mock
        $postRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressPostRepositoryInterface')->getMock();
        $postRepositoryMock->method('findFeaturedImagePost')->willReturn(null);

        $metaDataRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressMetaDataRepositoryInterface')
                ->getMock();
        $metaDataRepositoryMock->method('find')->willReturn(null);

        // setup
        $imageRepository = new ImageRepository(
            $postRepositoryMock,
            $metaDataRepositoryMock,
            new ImageMapper(new ImageSizeVariantMapper())
        );
        $result = $imageRepository->findFeaturedImage(1);

        //tests
        $this->assertNull($result);
    }
}
