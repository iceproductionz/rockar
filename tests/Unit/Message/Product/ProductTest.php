<?php

namespace RockarTests\Unit\Message\Product;

use PHPUnit\Framework\TestCase;
use Rockar\App\Message\Product\Product;
use Rockar\App\Message\Message;

class ProductTest extends TestCase
{
    public function testConstruction(): void
    {
        $vin    = 'WVGCV7AX7AW000784';
        $colour = 'Red';
        $make   = 'Ford';
        $model  = 'Fiesta';
        $price  = '10000';

        $uut = new Product($vin, $colour, $make, $model, $price);

        $this->assertInstanceOf(Product::class, $uut);
        $this->assertInstanceOf(Message::class, $uut);
    }

    public function testSerialization(): void
    {
        $vin    = 'WVGCV7AX7AW000784';
        $colour = 'Red';
        $make   = 'Ford';
        $model  = 'Fiesta';
        $price  = '10000';

        $expected = [
            'vin'       => $vin,
            'colour'    => $colour,
            'make'      => $make,
            'model'     => $model,
            'price'     => $price,
        ];

        $uut = new Product($vin, $colour, $make, $model, $price);

        $this->assertSame(
            $expected,
            $uut->__serialize()
        );
    }
}
