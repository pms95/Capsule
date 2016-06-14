<?php

use Mockery as m;
use MLS\Capsule\Kase;

class KaseTest extends PHPUnit_Framework_TestCase
{
    /** @var MLS\Capsule\Connection */
    private $connection;

    /** @var MLS\Capsule\Kase */
    private $model;

    /** @var Guzzle\Http\Message\Response */
    private $message;

    public function setUp()
    {
        $this->connection = m::mock('MLS\Capsule\Connection');
        $this->model = new Kase($this->connection);
        $this->message = m::mock('Guzzle\Http\Message\Response');
    }

    /** @test */
    public function should_require_connection()
    {
        $this->setExpectedException('Exception');

        $m = new Kase('');
    }

    /** @test */
    public function find_case_by_id()
    {
        $response = file_get_contents(dirname(__FILE__).'/stubs/get/kase.json');
        $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $case = $this->model->find(43);

        $this->assertInstanceOf('MLS\Capsule\Kase', $case);
        $this->assertEquals('43', $case->id);
        $this->assertEquals('OPEN', $case->status);
        $this->assertEquals('Consulting', $case->name);
        $this->assertEquals('Scope and design web site shopping cart', $case->description);
        $this->assertEquals('2', $case->party_id);
        $this->assertEquals('a.user', $case->owner);
        $this->assertEquals('2016-01-16T13:59:58Z', $case->created_on);
        $this->assertEquals('2016-03-11T16:54:23Z', $case->updated_on);
    }

    /** @test */
    public function find_all_cases()
    {
        $response = file_get_contents(dirname(__FILE__).'/stubs/get/kases.json');
        $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $collection = $this->model->all();

        $this->assertInstanceOf('Illuminate\Support\Collection', $collection);
        $this->assertEquals(1, $collection->count());
        $this->assertInstanceOf('MLS\Capsule\Kase', $collection[0]);
    }

    /** @test */
    public function should_serialise_model()
    {
        $kase = new Kase($this->connection, [
          'status' => 'OPEN',
          'name' => 'Website design',
          'description' => 'Design and create website',
          'owner' => 'a.user'
        ]);

        $stub = json_decode(file_get_contents(dirname(__FILE__).'/stubs/post/kase.json'), true);

        $this->assertEquals(json_encode($stub), $kase->toJson());
    }
}
