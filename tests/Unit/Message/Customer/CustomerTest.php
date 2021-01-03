<?php

namespace RockarTests\Unit\Message\Customer;

use PHPUnit\Framework\TestCase;
use Rockar\App\Message\Customer\Customer;
use Rockar\App\Message\Message;

class CustomerTest extends TestCase
{
    public function testConstruction(): void
    {
        $email    = 'tom.harding1974@gmail.co.uk';
        $forename = 'Tom';
        $surname  = 'Harding';
        $contactNumber = '07938244758';
        $postcode = 'SS26GH';
        $uut = new Customer($email, $forename, $surname, $contactNumber, $postcode);

        $this->assertInstanceOf(Customer::class, $uut);
        $this->assertInstanceOf(Message::class, $uut);
    }

    public function testSerialization(): void
    {
        $email    = 'tom.harding1974@gmail.co.uk';
        $forename = 'Tom';
        $surname  = 'Harding';
        $contactNumber = '07938244758';
        $postcode = 'SS26GH';

        $expected = [
            'email'         => $email,
            'forename'      => $forename,
            'surname'       => $surname,
            'contactNumber' => $contactNumber,
            'postcode'      => $postcode,
        ];

        $uut = new Customer($email, $forename, $surname, $contactNumber, $postcode);

        $this->assertSame(
            $expected,
            $uut->__serialize()
        );
    }
}
