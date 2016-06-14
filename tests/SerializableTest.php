<?php

use Mockery as m;
use MLS\Capsule\Model;
use MLS\Capsule\Connection;
use MLS\Capsule\Serializable;

class SerializableTest extends PHPUnit_Framework_TestCase
{
    /** @var MLS\Capsule\Connection */
    private $connection;

    /** @var MLS\Capsule\Model */
    private $model;

    public function setUp()
    {
        $this->connection = m::mock('MLS\Capsule\Connection');
        $this->model = new SerializableModelStub($this->connection);
    }

    /** @test */
    public function should_get_serliazable_options()
    {
        $options = $this->model->serializableOptions();

        $this->assertTrue(is_array($options));
        $this->assertTrue(is_array($options['root']));
        $this->assertEquals('serializablemodelstubs', $options['collection_root']);
    }
}

class SerializableModelStub extends Model
{
    use Serializable;

    protected $serializableConfig = ['root' => ['person', 'organisation']];

    public function __construct(Connection $connection, $attributes = [])
    {
        $this->connection = $connection;

        $this->fill($attributes);
    }
}
