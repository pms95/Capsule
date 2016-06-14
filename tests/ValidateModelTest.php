<?php

use Mockery as m;
use MLS\Capsule\Model;
use MLS\Capsule\Connection;
use MLS\Capsule\Validating;

class ValidateModelTest extends PHPUnit_Framework_TestCase
{
    /** @var MLS\Capsule\Model */
    private $model;

    public function setUp()
    {
        $connection = m::mock('MLS\Capsule\Connection');

        $this->model = new ValidateModelStub($connection);
    }

    /** @test */
    public function should_fail_validation()
    {
        $this->assertFalse($this->model->validate());
    }

    /** @test */
    public function should_pass_validation()
    {
        $this->model->email = 'samateh719@gmail.com';
        $this->assertTrue($this->model->validate());
    }
}

class ValidateModelStub extends Model
{
    use Validating;

    protected $fillable = ['email'];
    protected $rules = ['email' => 'required'];

    public function __construct(Connection $connection, $attributes = [])
    {
        $this->connection = $connection;

        $this->fill($attributes);
    }
}
