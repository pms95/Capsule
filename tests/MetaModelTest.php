<?php

use Mockery as m;
use MLS\Capsule\Model;
use MLS\Capsule\Connection;

class MetaModelTest extends PHPUnit_Framework_TestCase
{
    /** @var MLS\Capsule\Model */
    private $model;

    public function setUp()
    {
        $connection = m::mock('MLS\Capsule\Connection');

        $this->model = new MetaModelStub($connection);
    }

    /** @test */
    public function should_get_plural_entity_name()
    {
        $this->assertEquals('metamodelstubs', $this->model->base()->lowercase()->plural());
    }

    /** @test */
    public function should_get_singular_entity_name()
    {
        $this->assertEquals('metamodelstub', $this->model->base()->lowercase()->singular());
    }
}

class MetaModelStub extends Model
{
  public function __construct(Connection $connection, $attributes = [])
  {
      $this->connection = $connection;

      $this->fill($attributes);
  }
}
