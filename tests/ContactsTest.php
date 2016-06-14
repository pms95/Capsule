<?php

use MLS\Capsule\Email;
use MLS\Capsule\Phone;
use MLS\Capsule\Website;
use MLS\Capsule\Address;
use MLS\Capsule\Contacts;

class ContactsTest extends PHPUnit_Framework_TestCase
{
    /** @var Address */
    private $address;

    /** @var Email */
    private $email;

    /** @var Phone */
    private $phone;

    /** @var Website */
    private $website;

    public function setUp()
    {
        $this->address = new Address(['street' => '101 Blah Blah Lane']);
        $this->email = new Email(['email_address' => 'name@domain.com',]);
        $this->phone = new Phone(['phone_number' => '0191 123 456',]);
        $this->website = new Website(['web_service' => 'TWITTER', 'web_address' => 'modoukups']);
    }

    /** @test */
    public function should_create_contact()
    {
        $contacts = new Contacts([
            'addresses' => [$this->address],
            'emails' => [$this->email],
            'phones' => [$this->phone],
            'websites' => [$this->website]
        ]);

        $this->assertInstanceOf('MLS\Capsule\Address', $contacts->addresses[0]);
        $this->assertInstanceOf('MLS\Capsule\Email', $contacts->emails[0]);
        $this->assertInstanceOf('MLS\Capsule\Phone', $contacts->phones[0]);
        $this->assertInstanceOf('MLS\Capsule\Website', $contacts->websites[0]);
    }

    /** @test */
    public function should_serialise()
    {
        $contacts = new Contacts(['emails' => [$this->email]]);

        $this->assertTrue(is_object(json_decode($contacts->toJson())));
    }
}
