<?php

namespace Rockar\App\Adapter\Customer;

use Rockar\App\Adapter\Adapter;
use Rockar\App\Message\Customer\Customer as CustomerMessage;
use Rockar\App\Message\Message;

class Customer implements Adapter
{
    public function toMessage(array $fields): Message
    {
        return new CustomerMessage(...$fields);
    }    
}
