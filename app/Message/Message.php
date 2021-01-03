<?php

namespace Rockar\App\Message;

interface Message
{
    public function __serialize(): array;
}
