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
    private $projectPost1;
    /**
     * @var WordPressPost
     */
    private $projectPost2;
    /**
     * @var ProjectMapper
     */
    private $projectMapper;

    public function setUp()
    {
        $this->projectPost1 = new WordPressPost((object)[
            'ID' => 1,
            'post_name' => 'slug1',
            'post_title' => 'title1',
            'post_content' => 'content1',
            'post_excerpt' => 'excerpt1'
        ]);
        $this->projectPost2= new WordPressPost((object)[
            'ID' => 2,
            'post_name' => 'slug2',
            'post_title' => 'title2',
            'post_content' => 'content2',
            'post_excerpt' => 'excerpt2'
        ]);
        $this->projectMapper = new ProjectMapper();
    }

    public function testMapProjects()
    {
        // data
        $projectPosts = [
            $this->projectPost1,
            $this->projectPost2
        ];

        // setup
        $mappedProjects = $this->projectMapper->mapProjects($projectPosts);

        // tests
        $this->assertNotNull($mappedProjects);
        $this->assertNotEmpty($mappedProjects);
        $this->assertSameSize($mappedProjects, $projectPosts);
        $this->assertEquals($mappedProjects[0]->getSlug(), $projectPosts[0]->post_name);
        $this->assertEquals($mappedProjects[1]->getSlug(), $projectPosts[1]->post_name);
    }

    public function testMapProjectsSomeNull()
    {
        // data
        $projectPosts = [
            $this->projectPost1,
            null
        ];

        // setup
        $mappedProjects = $this->projectMapper->mapProjects($projectPosts);

        // tests
        $this->assertNotNull($mappedProjects);
        $this->assertNotEmpty($mappedProjects);
        $this->assertSame(count($mappedProjects), 1);
        $this->assertEquals($mappedProjects[0]->getSlug(), $projectPosts[0]->post_name);
    }

    public function testMapProjectsEmpty()
    {
        // data
        $projectPosts = [];

        // setup
        $mappedProjects = $this->projectMapper->mapProjects($projectPosts);

        // tests
        $this->assertNotNull($mappedProjects);
        $this->assertEmpty($mappedProjects);
    }

    public function testMapProject()
    {
        // data
        $projectPost = $this->projectPost1;

        $mappedProject = $this->projectMapper->mapProject($projectPost);

        // tests
        $this->assertNotNull($mappedProject);
        $this->assertEquals($mappedProject->getId(), $projectPost->ID);
        $this->assertEquals($mappedProject->getSlug(), $projectPost->post_name);
        $this->assertEquals($mappedProject->getTitle(), $projectPost->post_title);
        $this->assertEquals($mappedProject->getContent(), $projectPost->post_content);
        $this->assertEquals($mappedProject->getExcerpt(), $projectPost->post_excerpt);
        $this->assertNull($mappedProject->getFeaturedImage());
        $this->assertNotNull($mappedProject->getImages());
        $this->assertEmpty($mappedProject->getImages());
    }
}
