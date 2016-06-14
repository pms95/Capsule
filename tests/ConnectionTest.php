<?php

class ConnectionTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_get_client()
    {
        $c = new MLS\Capsule\Connection('', '');

        $this->assertInstanceOf('GuzzleHttp\Client', $c->client());
    }
}
