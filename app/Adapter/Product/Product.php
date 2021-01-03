<?php

namespace Rockar\App\Adapter\Product;

use Rockar\App\Adapter\Adapter;
use Rockar\App\Message\Product\Product as ProductMessage;
use Rockar\App\Message\Message;

class Product implements Adapter
{
    public function toMessage(array $fields): Message
    {
        return new ProductMessage(...$fields);
    }
}
