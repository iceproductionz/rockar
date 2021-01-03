<?php

namespace RockarTests\Unit\Services\Customers;

use PHPUnit\Framework\TestCase;
use Rockar\App\Message\Message;
use Rockar\App\Message\Customer\Customer;
use Rockar\App\Routing\Request\Customer as RequestCustomer;
use Rockar\App\Services\Customers\Customers;
use Rockar\App\Store\Store;

class CustomersTest extends TestCase
{
    private $datastore;

    public function setUp(): void
    {
        $this->datastore = $this->createMock(Store::class);
    }

    public function testConstruction(): void
    {
        $uut = new Customers($this->datastore);

        $this->assertInstanceOf(Customers::class, $uut);
    }

    public function testSuccessfullyGetBy(): void
    {
        $this->datastore->method('getBy')->willReturn($this->createMock(Customer::class));
        $request = $this->createMock(RequestCustomer::class);

        $uut = new Customers($this->datastore);
        $result = $uut->getBy($request);

        $this->assertInstanceOf(Message::class, $result);
    }
}
