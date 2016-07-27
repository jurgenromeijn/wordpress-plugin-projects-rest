<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository;

use JurgenRomeijn\ProjectsRest\Model\Rest\Image;
use JurgenRomeijn\ProjectsRest\Repository\Mapper\ProjectMapper;
use PHPUnit_Framework_TestCase as TestCase;
use WP_Post as WordPressPost;

class ProjectRepositoryTest extends TestCase
{
    private $postRepositoryMock;
    private $metaDataRepositoryMock;
    private $imageRepositoryMock;
    private $projectPosts;
    private $projectMetaData;
    private $featuredImage;
    private $images;

    public function setUp()
    {
        $this->projectPosts = [
            new WordPressPost((object)[
                'ID' => 'id1',
                'post_name' => 'name1',
                'post_title' => 'title1',
                'post_content' => 'content1',
                'post_excerpt' => 'excerpt1'
            ]),
            new WordPressPost((object)[
                'ID' => 'id2',
                'post_name' => 'name2',
                'post_title' => 'title2',
                'post_content' => 'content2',
                'post_excerpt' => 'excerpt2'
            ])
        ];
        $this->featuredImage = new Image('http://test.com/1.jpg', 1, 2, 'alt1', 'alt1');
        $this->images = [
            new Image('http://test.com/1.jpg', 1, 2, 'alt1', 'alt1'),
            new Image('http://test.com/2.jpg', 3, 4, 'alt2', 'alt2')
        ];
        $this->projectMetaData = [
            '_edit_last' => [1],
            '_edit_lock' => ['1469604608:1'],
            '_thumbnail_id' => [291],
            'intro' => ['intro'],
            '_intro' => ['field_5798513c021a2'],
            'info' => ['info'],
            '_info' => ['field_5798520371f77']
        ];

        $this->postRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressPostRepositoryInterface')->getMock();
        $this->postRepositoryMock->method('findAll')->willReturn($this->projectPosts);

        $this->metaDataRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressMetaDataRepositoryInterface')
                ->getMock();
        $this->metaDataRepositoryMock->method('findPostMetaData')->willReturn($this->projectMetaData);

        $this->imageRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\ImageRepositoryInterface')->getMock();
        $this->imageRepositoryMock->method('findFeaturedImage')->willReturn($this->featuredImage);
        $this->imageRepositoryMock->method('findImages')->willReturn($this->images);
    }

    public function testFindAll()
    {
        // data
        $projectPosts = $this->projectPosts;
        $projectMetaData = $this->projectMetaData;

        // setup
        $projectRepository = new ProjectRepository(
            $this->postRepositoryMock,
            $this->metaDataRepositoryMock,
            $this->imageRepositoryMock,
            new ProjectMapper()
        );
        $results = $projectRepository->findAll();

        // tests
        $this->assertNotNull($results);
        $this->assertNotEmpty($results);
        $this->assertSameSize($results, $projectPosts);
        $this->assertEquals($results[0]->getId(), $projectPosts[0]->ID);
        $this->assertEquals($results[0]->getSlug(), $projectPosts[0]->post_name);
        $this->assertEquals($results[0]->getTitle(), $projectPosts[0]->post_title);
        $this->assertEquals($results[0]->getIntro(), $projectMetaData['intro'][0]);
        $this->assertEquals($results[0]->getContent(), $projectPosts[0]->post_content);
        $this->assertEquals($results[0]->getInfo(), $projectMetaData['info'][0]);
        $this->assertEquals($results[0]->getExcerpt(), $projectPosts[0]->post_excerpt);
        $this->assertNotNull($results[0]->getFeaturedImage());
        $this->assertEquals($results[0]->getFeaturedImage()->getUrl(), 'http://test.com/1.jpg');
        $this->assertNotNull($results[0]->getImages());
        $this->assertNotEmpty($results[0]->getImages());
        $this->assertSameSize($results[0]->getImages(), $this->images);
        $this->assertEquals($results[1]->getImages()[1]->getUrl(), 'http://test.com/2.jpg');
    }

    public function testFindAllEmpty()
    {
        // mocks
        $postRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressPostRepositoryInterface')->getMock();
        $postRepositoryMock->method('findAll')->willReturn([]);

        $metaDataRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressMetaDataRepositoryInterface')
                ->getMock();
        $metaDataRepositoryMock->method('findPostMetaData')->willReturn([]);

        $imageRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\ImageRepositoryInterface')->getMock();
        $imageRepositoryMock->method('findFeaturedImage')->willReturn(null);
        $imageRepositoryMock->method('findImages')->willReturn([]);

        // setup
        $projectRepository = new ProjectRepository(
            $postRepositoryMock,
            $metaDataRepositoryMock,
            $imageRepositoryMock,
            new ProjectMapper()
        );
        $results = $projectRepository->findAll();

        // tests
        $this->assertNotNull($results);
        $this->assertEmpty($results);
    }

    public function testFindAllNull()
    {
        // mocks
        $postRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressPostRepositoryInterface')->getMock();
        $postRepositoryMock->method('findAll')->willReturn(null);

        $metaDataRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\WordPressMetaDataRepositoryInterface')
                ->getMock();
        $metaDataRepositoryMock->method('findPostMetaData')->willReturn(null);

        $imageRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\ImageRepositoryInterface')->getMock();
        $imageRepositoryMock->method('findFeaturedImage')->willReturn(null);
        $imageRepositoryMock->method('findImages')->willReturn(null);

        // setup
        $projectRepository = new ProjectRepository(
            $postRepositoryMock,
            $metaDataRepositoryMock,
            $imageRepositoryMock,
            new ProjectMapper()
        );
        $results = $projectRepository->findAll();

        // tests
        $this->assertNotNull($results);
        $this->assertEmpty($results);
    }

    public function testFindAllAddImagesTrue()
    {
        // setup
        $projectRepository = new ProjectRepository(
            $this->postRepositoryMock,
            $this->metaDataRepositoryMock,
            $this->imageRepositoryMock,
            new ProjectMapper()
        );
        $results = $projectRepository->findAll(true);

        // tests
        $this->assertNotNull($results);
        $this->assertNotEmpty($results);
        $this->assertSameSize($results, $this->projectPosts);
        $this->assertNotNull($results[0]->getFeaturedImage());
        $this->assertEquals($results[0]->getFeaturedImage()->getUrl(), 'http://test.com/1.jpg');
        $this->assertNotNull($results[0]->getImages());
        $this->assertNotEmpty($results[0]->getImages());
        $this->assertSameSize($results[0]->getImages(), $this->images);
        $this->assertEquals($results[1]->getImages()[1]->getUrl(), 'http://test.com/2.jpg');
    }

    public function testFindAllAddImagesFalse()
    {
        // setup
        $projectRepository = new ProjectRepository(
            $this->postRepositoryMock,
            $this->metaDataRepositoryMock,
            $this->imageRepositoryMock,
            new ProjectMapper()
        );
        $results = $projectRepository->findAll(false);

        // tests
        $this->assertNotNull($results);
        $this->assertNotEmpty($results);
        $this->assertSameSize($results, $this->projectPosts);
        $this->assertNull($results[0]->getFeaturedImage());
        $this->assertNotNull($results[0]->getImages());
        $this->assertEmpty($results[0]->getImages());
    }

    public function testFindAllAddImagesEmpty()
    {
        // mocks
        $imageRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\ImageRepositoryInterface')->getMock();
        $imageRepositoryMock->method('findFeaturedImage')->willReturn(null);
        $imageRepositoryMock->method('findImages')->willReturn([]);

        // setup
        $projectRepository = new ProjectRepository(
            $this->postRepositoryMock,
            $this->metaDataRepositoryMock,
            $imageRepositoryMock,
            new ProjectMapper()
        );
        $results = $projectRepository->findAll();

        // tests
        $this->assertNotNull($results);
        $this->assertNotEmpty($results);
        $this->assertSameSize($results, $this->projectPosts);
        $this->assertNull($results[0]->getFeaturedImage());
        $this->assertNotNull($results[0]->getImages());
        $this->assertEmpty($results[0]->getImages());
    }

    public function testFindAllAddImagesNull()
    {
        // mocks
        $imageRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\ImageRepositoryInterface')->getMock();
        $imageRepositoryMock->method('findFeaturedImage')->willReturn(null);
        $imageRepositoryMock->method('findImages')->willReturn(null);

        // setup
        $projectRepository = new ProjectRepository(
            $this->postRepositoryMock,
            $this->metaDataRepositoryMock,
            $imageRepositoryMock,
            new ProjectMapper()
        );
        $results = $projectRepository->findAll();

        // tests
        $this->assertNotNull($results);
        $this->assertNotEmpty($results);
        $this->assertSameSize($results, $this->projectPosts);
        $this->assertNull($results[0]->getFeaturedImage());
        $this->assertNotNull($results[0]->getImages());
        $this->assertEmpty($results[0]->getImages());
    }
}
