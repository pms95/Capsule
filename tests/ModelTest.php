<?php

use Mockery as m;
use MLS\Capsule\Model;
use MLS\Capsule\Connection;

class ModelTest extends PHPUnit_Framework_TestCase
{
    /** @test MLS\Capsule\Model */
    private $model;

    public function setUp()
    {
        $connection = m::mock('MLS\Capsule\Connection');

        $this->model = new ModelStub($connection, ['name' => 'Momodou Samateh']);
    }

    /** @test */
    public function should_return_connection()
    {
        $this->assertInstanceOf('MLS\Capsule\Connection', $this->model->connection());
    }

    /** @test */
    public function should_have_access_to_injected_attributes()
    {
        $this->assertEquals('Momodou Samateh', $this->model->name);
    }

    /** @test */
    public function should_set_property()
    {
        $this->model->email = 'samateh719@gmail.com';
        $this->assertEquals('samateh719@gmail.com', $this->model->email);
    }
}

class ModelStub extends Model
{
    protected $fillable = ['name', 'email'];

    public function __construct(Connection $connection, $attributes = [])
    {
        $this->connection = $connection;

        $this->fill($attributes);
    }
}
