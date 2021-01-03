<?php

namespace RockarTests\Unit\Routing\Request;

use PHPUnit\Framework\TestCase;
use Rockar\App\Routing\Request\Product;
use Rockar\App\Routing\Request\Request;
use InvalidArgumentException;

class ProductTest extends TestCase
{
    public function testConstruction(): void
    {
        $identifier      = 'WVGCV7AX7AW000784';
        $identifierField = 'vin';
        $fields          = [
            'vin',
            'colour',
        ];
    
        $uut = new Product($identifier, $identifierField, $fields);

        $this->assertInstanceOf(Product::class, $uut);
        $this->assertInstanceOf(Request::class, $uut);
    }

    public function testConstructionWithInvalidFields(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $identifier      = 'WVGCV7AX7AW000784';
        $identifierField = 'vin';
        $fields          = [
            'vin',
            'colours',
        ];
    
        new Product($identifier, $identifierField, $fields);
    }

    public function testConstructionWithInvalidIdentifierField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $identifier      = 'WVGCV7AX7AW000784';
        $identifierField = 'vinx';
        $fields          = [
            'vin',
            'colour',
        ];
    
        new Product($identifier, $identifierField, $fields);
    }

    public function testGetIdentifier(): void
    {
        $identifier      = 'WVGCV7AX7AW000784';
        $identifierField = 'vin';
        $fields          = [
            'vin',
            'colour',
            'make',
            'model',
            'price',
        ];
        $uut = new Product($identifier, $identifierField, $fields);
        $result = $uut->getIdentifier();

        $this->assertSame($identifier, $result);
    }

    public function testGetIdentifierField(): void
    {
        $identifier      = 'WVGCV7AX7AW000784';
        $identifierField = 'vin';
        $fields          = [
            'vin',
            'colour',
            'make',
            'model',
            'price',
        ];
        $uut    = new Product($identifier, $identifierField, $fields);
        $result = $uut->getIdentifierField();

        $this->assertSame($identifierField, $result);
    }

    public function testGetFields(): void
    {
        $identifier      = 'WVGCV7AX7AW000784';
        $identifierField = 'vin';
        $fields          = [
            'vin',
            'colour',
            'make',
            'model',
            'price',
        ];
        $uut    = new Product($identifier, $identifierField, $fields);
        $result = $uut->getFields();

        $this->assertSame($fields, $result);
    }
}
