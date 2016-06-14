<?php

use Mockery as m;
use MLS\Capsule\User;

class UserTest extends PHPUnit_Framework_TestCase
{
    /** @var MLS\Capsule\Connection */
    private $connection;

    /** @var MLS\Capsule\User */
    private $model;

    /** @var Guzzle\Http\Message\Response */
    private $message;

    public function setUp()
    {
        $this->connection = m::mock('MLS\Capsule\Connection');
        $this->model = new User($this->connection);
        $this->message = m::mock('Guzzle\Http\Message\Response');
    }

    /** @test */
    public function find_all_users()
    {
        $response = file_get_contents(dirname(__FILE__).'/stubs/get/users.json');
        $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $collection = $this->model->all();

        $this->assertInstanceOf('Illuminate\Support\Collection', $collection);
        $this->assertEquals(2, $collection->count());

        $this->assertInstanceOf('MLS\Capsule\User', $collection[0]);
        $this->assertEquals('a.user', $collection[0]->username);
        $this->assertEquals('Alfred User', $collection[0]->name);
        $this->assertEquals('GBP', $collection[0]->currency);
        $this->assertEquals('Europe/London', $collection[0]->timezone);
        $this->assertEquals('true', $collection[0]->logged_in);
        $this->assertEquals('100', $collection[0]->party_id);

        $this->assertInstanceOf('MLS\Capsule\User', $collection[1]);
        $this->assertEquals('j.joe', $collection[1]->username);
        $this->assertEquals('Jane Doe', $collection[1]->name);
        $this->assertEquals('GBP', $collection[1]->currency);
        $this->assertEquals('Europe/London', $collection[1]->timezone);
        $this->assertEquals('101', $collection[1]->party_id);
    }
}
