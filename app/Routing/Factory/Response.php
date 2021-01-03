<?php

namespace Rockar\App\Routing\Factory;

use Rockar\App\Message\Message;
use Rockar\App\Routing\Response\Response as RoutingResponse;
use Rockar\App\Routing\Response\Success;

class Response
{
    public function makeSuccess(Message $message, array $fields = []): RoutingResponse
    {
        return new Success($message, $fields);
    }
}
