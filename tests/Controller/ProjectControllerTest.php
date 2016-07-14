<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Controller;

use JurgenRomeijn\ProjectsRest\Model\Rest\Project;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Class ProjectControllerTest
 * @package JurgenRomeijn\ProjectsRest\Controller
 */
class ProjectControllerTest extends TestCase
{
    private $project1;
    private $project2;

    public function setUp()
    {
        $this->project1 = new Project(
            1,
            'project1',
            'Project1',
            'Lorem Ipsum1',
            'Lorem Ipsum1',
            null,
            []
        );
        $this->project2 = new Project(
            2,
            'project2',
            'Project2',
            'Lorem Ipsum2',
            'Lorem Ipsum2',
            null,
            []
        );
    }

    public function testIndexMultipleProjects()
    {
        // data
        $projects = [
            $this->project1,
            $this->project2
        ];

        // mocks
        $projectRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\ProjectRepositoryInterface')->getMock();
        $projectRepositoryMock->method('findAll')->willReturn($projects);

        // setup
        $projectController = new ProjectController($projectRepositoryMock);
        $response = $projectController->index();

        // tests
        $this->assertNotNull($response->get_data());
        $this->assertNotEmpty($response->get_data());
        $this->assertSameSize($response->get_data(), $projects);
        $this->assertEquals($response->get_data(), $projects);
        $this->assertEquals($response->get_data()[1], $projects[1]);
        $this->assertEquals($response->get_data()[1]->getId(), $projects[1]->getId());
    }

    public function testIndexOneProject()
    {
        // data
        $projects = [
            $this->project1
        ];

        // mocks
        $projectRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\ProjectRepositoryInterface')->getMock();
        $projectRepositoryMock->method('findAll')->willReturn($projects);

        // setup
        $projectController = new ProjectController($projectRepositoryMock);
        $response = $projectController->index();

        // tests
        $this->assertNotNull($response->get_data());
        $this->assertNotEmpty($response->get_data());
        $this->assertSameSize($response->get_data(), $projects);
        $this->assertEquals($response->get_data(), $projects);
        $this->assertEquals($response->get_data()[0], $projects[0]);
        $this->assertEquals($response->get_data()[0]->getId(), $projects[0]->getId());
    }

    public function testIndexEmptyProjects()
    {
        // data
        $projects = [];

        // mocks
        $projectRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\ProjectRepositoryInterface')->getMock();
        $projectRepositoryMock->method('findAll')->willReturn($projects);

        // setup
        $projectController = new ProjectController($projectRepositoryMock);
        $response = $projectController->index();

        // tests
        $this->assertNotNull($response->get_data());
        $this->assertEmpty($response->get_data());
    }

    public function testIndexNullProjects()
    {
        // data
        $projects = null;

        // mocks
        $projectRepositoryMock =
            $this->getMockBuilder('JurgenRomeijn\ProjectsRest\Repository\ProjectRepositoryInterface')->getMock();
        $projectRepositoryMock->method('findAll')->willReturn($projects);

        // setup
        $projectController = new ProjectController($projectRepositoryMock);
        $response = $projectController->index();

        // tests
        $this->assertNotNull($response->get_data());
        $this->assertEmpty($response->get_data());
    }
}
