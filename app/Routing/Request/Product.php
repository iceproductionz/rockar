<?php

namespace Rockar\App\Routing\Request;

use Webmozart\Assert\Assert;

class Product implements Request
{
    private $validValues = [
        'vin',
        'colour',
        'make',
        'model',
        'price',
    ];

    private string $identifier;

    private string $identifierField;

    private array $fields;

    public function __construct(string $id, string $idField, array $fields)
    {
        Assert::inArray($idField, $this->validValues);
        foreach ($fields as $field) {
            Assert::inArray($field, $this->validValues);
        }

        $this->identifier      = $id;
        $this->identifierField = $idField;
        $this->fields          = $fields;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getIdentifierField(): string
    {
        return $this->identifierField;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
