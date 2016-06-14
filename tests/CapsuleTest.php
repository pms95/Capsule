<?php

use Mockery as m;
use MLS\Capsule\Capsule;

class CapsuleTest extends PHPUnit_Framework_TestCase
{
    /** @var MLS\Capsule\Capsule */
    private $capsule;

    public function setUp()
    {
        $connection = m::mock('MLS\Capsule\Connection');

        $this->capsule = new Capsule($connection);
    }

    /** @test */
    public function should_require_connection()
    {
        $this->setExpectedException('Exception');

        $c = new MLS\Capsule\Capsule('');
    }

    /** @test */
    public function should_create_party()
    {
        $this->assertInstanceOf('MLS\Capsule\Party', $this->capsule->party());
    }
}
