<?php

namespace RockarTests\Unit\Routing\Factory;

use PHPUnit\Framework\TestCase;
use Rockar\App\Message\Message;
use Rockar\App\Routing\Factory\Response as FactoryResponse;
use Rockar\App\Routing\Response\Success;

class ResponseTest extends TestCase
{
    private $message;

    public function setUp(): void
    {
        $this->message = $this->createMock(Message::class);
    }

    public function testMakeSuccess(): void
    {
        $uut = new FactoryResponse();
        $result = $uut->makeSuccess($this->message, []);

        $this->assertInstanceOf(Success::class, $result);
    }
}
