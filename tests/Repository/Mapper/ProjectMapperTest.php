<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Repository\Mapper;

use PHPUnit_Framework_TestCase as TestCase;
use WP_Post as WordPressPost;

class ProjectMapperTest extends TestCase
{
    /**
     * @var WordPressPost
     */
    private $projectPost;
    /**
     * @var WordPressPost
     */
    private $projectMetaData;
    /**
     * @var ProjectMapper
     */
    private $projectMapper;

    public function setUp()
    {
        $this->projectPost = new WordPressPost((object)[
            'ID' => 1,
            'post_name' => 'slug1',
            'post_title' => 'title1',
            'post_content' => 'content1',
            'post_excerpt' => 'excerpt1'
        ]);
        $this->projectMetaData = [
            '_edit_last' => [1],
            '_edit_lock' => ['1469604608:1'],
            '_thumbnail_id' => [291],
            'intro' => ['intro'],
            '_intro' => ['field_5798513c021a2'],
            'info' => ['info'],
            '_info' => ['field_5798520371f77']
        ];
        $this->projectMapper = new ProjectMapper();
    }

    public function testMapProject()
    {
        // data
        $projectPost = $this->projectPost;
        $projectMetaData = $this->projectMetaData;

        // setup
        $mappedProject = $this->projectMapper->mapProject($projectPost, $projectMetaData);

        // tests
        $this->assertNotNull($mappedProject);
        $this->assertEquals($mappedProject->getId(), $projectPost->ID);
        $this->assertEquals($mappedProject->getSlug(), $projectPost->post_name);
        $this->assertEquals($mappedProject->getTitle(), $projectPost->post_title);
        $this->assertEquals($mappedProject->getIntro(), $this->projectMetaData['intro'][0]);
        $this->assertEquals($mappedProject->getContent(), $projectPost->post_content);
        $this->assertEquals($mappedProject->getInfo(), $this->projectMetaData['info'][0]);
        $this->assertEquals($mappedProject->getExcerpt(), $projectPost->post_excerpt);
        $this->assertNull($mappedProject->getFeaturedImage());
        $this->assertNotNull($mappedProject->getImages());
        $this->assertEmpty($mappedProject->getImages());
    }

    public function testMapProjectMetaDataEmpty()
    {
        // data
        $projectPost = $this->projectPost;
        $projectMetaData = [];

        // setup
        $mappedProject = $this->projectMapper->mapProject($projectPost, $projectMetaData);

        // tests
        $this->assertNotNull($mappedProject);
        $this->assertEquals($mappedProject->getId(), $projectPost->ID);
        $this->assertEquals($mappedProject->getSlug(), $projectPost->post_name);
        $this->assertEquals($mappedProject->getTitle(), $projectPost->post_title);
        $this->assertEquals($mappedProject->getIntro(), null);
        $this->assertEquals($mappedProject->getContent(), $projectPost->post_content);
        $this->assertEquals($mappedProject->getInfo(), null);
        $this->assertEquals($mappedProject->getExcerpt(), $projectPost->post_excerpt);
        $this->assertNull($mappedProject->getFeaturedImage());
        $this->assertNotNull($mappedProject->getImages());
        $this->assertEmpty($mappedProject->getImages());
    }
}
