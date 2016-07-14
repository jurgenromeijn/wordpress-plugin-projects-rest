<?php
/**
 * @author Jurgen Romeijn <jurgen.romeijn@gmail.com>
 */

namespace JurgenRomeijn\ProjectsRest\Util;

use PHPUnit_Framework_TestCase as TestCase;
use WP_Post as WordPressPost;

class ArrayHelperTest extends TestCase
{
    public function testFindArray()
    {
        // data
        $array = [
            'test' => ['found1', 'found2']
        ];

        // setup
        $result = ArrayHelper::findArray('test', $array);

        // tests
        $this->assertNotNull($result);
        $this->assertNotEmpty($result);
        $this->assertSameSize($result, $array['test']);
        $this->assertEquals($result[0], $array['test'][0]);
        $this->assertEquals($result[1], $array['test'][1]);
    }

    public function testFindArrayNoArray()
    {
        // data
        $array = [
            'test' => 'found'
        ];

        // setup
        $result = ArrayHelper::findArray('test', $array);

        // tests
        $this->assertNotNull($result);
        $this->assertNotEmpty($result);
        $this->assertEquals(count($result[0]), 1);
        $this->assertEquals($result[0], $array['test']);
    }

    public function testFindArrayNotFound()
    {
        // data
        $array = [
            'test' => 'found'
        ];

        // setup
        $result = ArrayHelper::findArray('test2', $array);

        // tests
        $this->assertNotNull($result);
        $this->assertEmpty($result);
    }

    public function testFindValue()
    {
        // data
        $array = [
            'test' => 'found'
        ];

        // setup
        $result = ArrayHelper::findValue('test', $array);

        // tests
        $this->assertNotNull($result);
        $this->assertEquals($result, $array['test']);
    }

    public function testFindValueNotFound()
    {
        // data
        $array = [
            'test' => 'found'
        ];

        // setup
        $result = ArrayHelper::findValue('test2', $array);

        // tests
        $this->assertNull($result);
    }
}
