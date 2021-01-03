<?php

namespace RockarTests\Unit\Routing\Request;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Rockar\App\Routing\Request\Customer;
use Rockar\App\Routing\Request\Request;

class CustomerTest extends TestCase
{
    public function testConstruction(): void
    {
        $identifier      = 'John';
        $identifierField = 'forename';
        $fields          = [
            'email',
            'forename',
            'surname',
            'contactNumber',
            'postcode',
        ];
        $uut = new Customer($identifier, $identifierField, $fields);

        $this->assertInstanceOf(Customer::class, $uut);
        $this->assertInstanceOf(Request::class, $uut);
    }

    public function testConstructionWithInvalidFields(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $identifier      = 'John';
        $identifierField = 'forename';
        $fields          = [
            'email',
            'forxename',
            'postcode',
        ];
    
        new Customer($identifier, $identifierField, $fields);
    }

    public function testConstructionWithInvalidIdentifierField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $identifier      = 'John';
        $identifierField = 'forcename';
        $fields          = [
            'email',
            'postcode',
        ];
    
        new Customer($identifier, $identifierField, $fields);
    }

    public function testGetIdentifier(): void
    {
        $identifier      = 'John';
        $identifierField = 'forename';
        $fields          = [
            'email',
            'forename',
            'surname',
            'contactNumber',
            'postcode',
        ];
        $uut = new Customer($identifier, $identifierField, $fields);
        $result = $uut->getIdentifier();

        $this->assertSame($identifier, $result);
    }

    public function testGetIdentifierField(): void
    {
        $identifier      = 'John';
        $identifierField = 'forename';
        $fields          = [
            'email',
            'forename',
            'surname',
            'contactNumber',
            'postcode',
        ];
        $uut    = new Customer($identifier, $identifierField, $fields);
        $result = $uut->getIdentifierField();

        $this->assertSame($identifierField, $result);
    }

    public function testGetFieldS(): void
    {
        $identifier      = 'John';
        $identifierField = 'forename';
        $fields          = [
            'email',
            'forename',
            'surname',
            'contactNumber',
            'postcode',
        ];
        $uut    = new Customer($identifier, $identifierField, $fields);
        $result = $uut->getFields();

        $this->assertSame($fields, $result);
    }
}
