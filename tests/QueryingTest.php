<?php

use Mockery as m;
use MLS\Capsule\Model;
use MLS\Capsule\Connection;
use MLS\Capsule\Querying\Findable;

class QueryingTest extends PHPUnit_Framework_TestCase
{
    /** @var MLS\Capsule\Connection */
    private $connection;

    /** @var Guzzle\Http\Message\Response */
    private $message;

    /** @var MLS\Capsule\Model */
    private $model;

    public function setUp()
    {
        $this->connection = m::mock('MLS\Capsule\Connection');
        $this->message = m::mock('Guzzle\Http\Message\Response');
        $this->model = new QueryModelStub($this->connection);
    }

    /** @test */
    public function should_get_singular_queryable_name()
    {
        $this->assertEquals('querymodelstub', $this->model->queryableOptions()->singular());
    }

    /** @test */
    public function should_get_plural_queryable_name()
    {
        $this->assertEquals('the_plural_name', $this->model->queryableOptions()->plural());
    }
}

class QueryModelStub extends Model
{
    use Findable;

    protected $queryableOptions = ['plural' => 'the_plural_name'];

    public function __construct(Connection $connection, $attributes = [])
    {
        $this->connection = $connection;

        $this->fill($attributes);
    }
}
