<?php

namespace Rockar\App\Routing\Response;

use Rockar\App\Message\Message;

interface Response
{
    public function getStatus(): string;

    public function getData(): Message;

    public function __serialize(): array;
}
