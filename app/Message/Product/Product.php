<?php

namespace Rockar\App\Message\Product;

use Rockar\App\Message\Message;

class Product implements Message
{
    
    private string $vin;
    private string $colour;
    private string $make;
    private string $model;
    private string $price;

    /**
     * @param string $vin
     * @param string $colour
     * @param string $make
     * @param string $model
     * @param string $price
     */
    public function __construct(
        string $vin,
        string $colour,
        string $make,
        string $model,
        string $price
    ) {
        $this->vin    = $vin;
        $this->colour = $colour;
        $this->make   = $make;
        $this->model  = $model;
        $this->price  = $price;
    }

    public function __serialize(): array
    {
        return [
            'vin'       => $this->vin,
            'colour'    => $this->colour,
            'make'      => $this->make,
            'model'     => $this->model,
            'price'     => $this->price,
        ];
    }
}
