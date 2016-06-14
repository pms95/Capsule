<?php

use Mockery as m;
use MLS\Capsule\Model;
use MLS\Capsule\Connection;
use MLS\Capsule\Normalizer;

class NormalizerTest extends PHPUnit_Framework_TestCase
{
    /** @test MLS\Capsule\Connection */
    private $connection;

    /** @test MLS\Capsule\Model */
    private $model;

    /** @test MLS\Capsule\Normalizer */
    private $normalizer;

    public function setUp()
    {
        $this->connection = m::mock('MLS\Capsule\Connection');
        $this->model = new NormalizeModelStub($this->connection);
        $this->normalizer = new Normalizer($this->model);
    }

    /** @test */
    public function should_require_model()
    {
        $this->setExpectedException('Exception');

        $normalizer = new Normalizer('', []);
    }

    /** @test */
    public function should_require_options_array()
    {
        $this->setExpectedException('Exception');

        $normalizer = new Normalizer($this->model, '');
    }

    /** @test */
    public function model_method_should_require_attributes_array()
    {
        $this->setExpectedException('Exception');

        $this->normalizer->model();
    }

    /** @test */
    public function collection_should_require_attributes_array()
    {
        $this->setExpectedException('Exception');

        $this->normalizer->collection();
    }
}

class NormalizeModelStub extends Model
{
    public function __construct(Connection $connection, $attributes = [])
    {
        $this->connection = $connection;

        $this->fill($attributes);
    }
}
