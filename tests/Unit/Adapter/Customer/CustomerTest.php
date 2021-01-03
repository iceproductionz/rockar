<?php

namespace RockarTests\Unit\Adapter\Customer;

use PHPUnit\Framework\TestCase;
use Rockar\App\Adapter\Adapter;
use Rockar\App\Adapter\Customer\Customer;
use Rockar\App\Message\Customer\Customer as CustomerMessage;

class CustomerTest extends TestCase
{
    public function testConstruction(): void
    {
        $uut = new Customer();

        $this->assertInstanceOf(Customer::class, $uut);
        $this->assertInstanceOf(Adapter::class, $uut);
    }

    public function testSuccessfullyConvertToMessage()
    {
        $input = [
            'tom.harding1974@gmail.co.uk',
            'Tom',
            'Harding',
            '07938244758',
            'SS26GH'
        ];
        $expected = [
            'email'         => 'tom.harding1974@gmail.co.uk',
            'forename'      => 'Tom',
            'surname'       => 'Harding',
            'contactNumber' => '07938244758',
            'postcode'      => 'SS26GH'
        ];

        $uut = new Customer();
        $result = $uut->toMessage($input);

        $this->assertInstanceOf(CustomerMessage::class, $result);
        $this->assertSame($expected, $result->__serialize());
    }
}
