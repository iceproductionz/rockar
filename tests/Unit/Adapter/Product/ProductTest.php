<?php

namespace RockarTests\Unit\Adapter\Product;

use PHPUnit\Framework\TestCase;
use Rockar\App\Adapter\Adapter;
use Rockar\App\Adapter\Product\Product;
use Rockar\App\Message\Product\Product as ProductMessage;

class ProductTest extends TestCase
{
    public function testConstruction(): void
    {
        $uut = new Product();

        $this->assertInstanceOf(Product::class, $uut);
        $this->assertInstanceOf(Adapter::class, $uut);
    }

    public function testSuccessfullyConvertToMessage()
    {
        $input = [
            'WVGCV7AX7AW000784',
            'Red',
            'Ford',
            'Fiesta',
            '10000'
        ];
        $expected = [
            'vin'    => 'WVGCV7AX7AW000784',
            'colour' => 'Red',
            'make'   => 'Ford',
            'model'  => 'Fiesta',
            'price'  => '10000'
        ];


        $uut = new Product();
        $result = $uut->toMessage($input);

        $this->assertInstanceOf(ProductMessage::class, $result);
        $this->assertSame($expected, $result->__serialize());
    }
}
