<?php

namespace RockarTests\Unit\Routing\Response;

use PHPUnit\Framework\TestCase;
use Rockar\App\Message\Message;
use Rockar\App\Routing\Response\Response;
use Rockar\App\Routing\Response\Success;

class SuccessTest extends TestCase
{
    private $data;

    public function setUp(): void
    {
        $this->data = $this->createMock(Message::class);
    }

    public function testConstruction(): void
    {
        $uut = new Success($this->data, []);

        $this->assertInstanceOf(Success::class, $uut);
        $this->assertInstanceOf(Response::class, $uut);
    }

    public function testGetStatus(): void
    {
        $uut = new Success($this->data, []);

        $this->assertSame("200", $uut->getStatus());
    }

    public function testGetData(): void
    {
        $uut = new Success($this->data, []);

        $this->assertSame($this->data, $uut->getData());

    }

    public function testGetTestSerializeWithNoShowingFields(): void
    {
        $this->data->method('__serialize')->willReturn([]);
        $expected = [
            "status" => '200',
            'data'   => (object)[],
        ];

        $uut = new Success($this->data, []);

        $this->assertEquals($uut->__serialize(), $expected);
    }

    public function testGetTestSerializeWithAllFieldsShowing(): void
    {
        $dataResult = [
            'a' => 1,
            'b' => 2,
            'c' => 3
        ];
        $this->data->method('__serialize')->willReturn($dataResult);
        $expected = [
            "status" => '200',
            'data'   => (object)$dataResult,
        ];

        $uut = new Success($this->data, ['a', 'b', 'c']);

        $this->assertEquals($uut->__serialize(), $expected);
    }

    public function testGetTestSerializeWithSomeFieldsShowing(): void
    {
        $dataResult = [
            'a' => 1,
            'b' => 2,
            'c' => 3
        ];
        $this->data->method('__serialize')->willReturn($dataResult);
        $expected = [
            "status" => '200',
            'data'   => (object)[
                'b' => 2,
                'c' => 3
            ],
        ];

        $uut = new Success($this->data, ['b', 'c']);

        $this->assertEquals($uut->__serialize(), $expected);
    }
}
