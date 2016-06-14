<?php

use Mockery as m;
use MLS\Capsule\Opportunity;

class OpportunityTest extends PHPUnit_Framework_TestCase
{
    /** @var MLS\Capsule\Connection */
    private $connection;

    /** @var MLS\Capsule\Opportunity */
    private $model;

    /** @var Guzzle\Http\Message\Response */
    private $message;

    public function setUp()
    {
        $this->connection = m::mock('MLS\Capsule\Connection');
        $this->model = new Opportunity($this->connection);
        $this->message = m::mock('Guzzle\Http\Message\Response');
    }

    /** @test */
    public function should_require_connection()
    {
        $this->setExpectedException('Exception');

        $m = new Opportunity('');
    }

    /** @test */
    public function find_opportunity_by_id()
    {
        $response = file_get_contents(dirname(__FILE__).'/stubs/get/opportunity.json');
        $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $opportunity = $this->model->find(43);

        $this->assertInstanceOf('MLS\Capsule\Opportunity', $opportunity);
        $this->assertEquals('43', $opportunity->id);
        $this->assertEquals('Consulting', $opportunity->name);
        $this->assertEquals('Scope and design web site shopping cart', $opportunity->description);
        $this->assertEquals('2', $opportunity->party_id);
        $this->assertEquals('GBP', $opportunity->currency);
        $this->assertEquals('500.00', $opportunity->value);
        $this->assertEquals('DAY', $opportunity->duration_basis);
        $this->assertEquals('10', $opportunity->duration);
        $this->assertEquals('2016-09-30T00:00:00Z', $opportunity->expected_close_date);
        $this->assertEquals('2', $opportunity->milestone_id);
        $this->assertEquals('Bid', $opportunity->milestone);
        $this->assertEquals('50', $opportunity->probability);
        $this->assertEquals('a.user', $opportunity->owner);
        $this->assertEquals('2011-09-30T00:00:00Z', $opportunity->created_on);
        $this->assertEquals('2011-09-30T00:00:00Z', $opportunity->updated_on);
    }

    /** @test */
    public function find_all_opportunities()
    {
        $response = file_get_contents(dirname(__FILE__).'/stubs/get/opportunities.json');
        $this->message->shouldReceive('json')->andReturn(json_decode($response, true));
        $this->connection->shouldReceive('get')->andReturn($this->message);

        $collection = $this->model->all();

        $this->assertInstanceOf('Illuminate\Support\Collection', $collection);
        $this->assertEquals(1, $collection->count());
        $this->assertInstanceOf('MLS\Capsule\Opportunity', $collection[0]);
    }
}
