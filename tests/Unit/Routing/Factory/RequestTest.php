<?php

namespace RockarTests\Unit\Routing\Factory;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Rockar\App\Exception\BadRequest;
use Rockar\App\Routing\Factory\Request as FactoryRequest;
use Rockar\App\Routing\Request\Customer;
use Rockar\App\Routing\Request\Product;

class RequestTest extends TestCase
{
    private $request;

    public function setUp(): void
    {
        $this->request = $this->createMock(ServerRequestInterface::class);
    }

    public function testInvalidRequestType(): void
    {
        $this->expectException(BadRequest::class);

        $uut = new FactoryRequest();
        $uut->make($this->request, 'custoxmer');
    }


    public function testMakeCustomer(): void
    {
        $this->request->method('getQueryParams')->willReturn([
            'identifier'        => 'John',
            'identifierField'   => 'forename',
            'fields'            => ['email', 'forename'],
        ]);

        $uut = new FactoryRequest();
        $result = $uut->make($this->request, 'customer');

        $this->assertInstanceOf(Customer::class, $result);
    }

    public function testMakeProduct(): void
    {
        $this->request->method('getQueryParams')->willReturn([
            'identifier'        => 'xx23f',
            'identifierField'   => 'vin',
            'fields'            => ['vin', 'make'],
        ]);

        $uut = new FactoryRequest();
        $result = $uut->make($this->request, 'product');

        $this->assertInstanceOf(Product::class, $result);
    }
}
