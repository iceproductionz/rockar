<?php

namespace Rockar\App\Adapter;

use Rockar\App\Message\Message;

interface Adapter
{
    public function toMessage(array $fields): Message;
}
