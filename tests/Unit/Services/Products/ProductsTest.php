<?php

namespace RockarTests\Unit\Services\Products;

use PHPUnit\Framework\TestCase;
use Rockar\App\Message\Message;
use Rockar\App\Message\Product\Product;
use Rockar\App\Routing\Request\Product as RequestProduct;
use Rockar\App\Services\Products\Products;
use Rockar\App\Store\Store;

class ProductsTest extends TestCase
{
    private $datastore;

    public function setUp(): void
    {
        $this->datastore = $this->createMock(Store::class);
    }

    public function testConstruction(): void
    {
        $uut = new Products($this->datastore);

        $this->assertInstanceOf(Products::class, $uut);
    }

    public function testSuccessfullyGetBy(): void
    {
        $this->datastore->method('getBy')->willReturn($this->createMock(Product::class));
        $request = $this->createMock(RequestProduct::class);

        $uut = new Products($this->datastore);
        $result = $uut->getBy($request);

        $this->assertInstanceOf(Message::class, $result);
    }
}
