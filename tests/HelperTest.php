<?php

use MLS\Capsule\Helper;

class HelperTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_convert_to_snake_case()
    {
        $attributes = Helper::toSnakeCase(['firstName' => 'Momodou Samateh']);

        reset($attributes);

        $this->assertEquals('first_name', key($attributes));
    }

    /** @test */
    public function should_convert_to_camel_case()
    {
        $attributes = Helper::toCamelCase(['first_name' => 'Momodou Samateh']);

        reset($attributes);

        $this->assertEquals('firstName', key($attributes));
    }
}
