<?php

use Mockery as m;
use MLS\Capsule\Person;
use MLS\Capsule\Persistance\Options;

class PersistableOptionsTest extends PHPUnit_Framework_TestCase
{
    /** @var Options */
    private $options;

    public function setUp()
    {
        $person = new Person(m::mock('MLS\Capsule\Connection'), ['id' => 123]);
        $this->options = new Options($person, []);
    }

    /** @test */
    public function should_generate_create_endpoint()
    {
        $this->assertEquals('people', $this->options->create());
    }

    /** @test */
    public function should_generate_update_endpoint()
    {
        $this->assertEquals('person/123', $this->options->update());
    }

    /** @test */
    public function should_generate_delete_endpoint()
    {
        $this->assertEquals('person/123', $this->options->delete());
    }
}
