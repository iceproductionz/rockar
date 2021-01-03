<?php

namespace RockarTests\Unit\Store\Csv;

use PHPUnit\Framework\TestCase;
use Rockar\App\Adapter\Adapter;
use Rockar\App\Model\Stream\Csv as CsvStream;
use Rockar\App\Message\Message;
use Rockar\App\Store\Csv\Csv as Csv;
use Rockar\App\Store\Store;
use RuntimeException;
use Rockar\App\Exception\NotFound;

class CsvTest extends TestCase
{
    private $stream;

    private $adapter;

    public function setUp(): void
    {
        $this->stream = $this->createMock(CsvStream::class);
        $this->adapter = $this->createMock(Adapter::class);
    }

    public function testConstruction(): void
    {
        $uut = new Csv(['key1' => 0], $this->stream, $this->adapter);
        
        $this->assertInstanceOf(Csv::class, $uut);
        $this->assertInstanceOf(Store::class, $uut);
    }

    public function testNoneExistingHeaderPosition(): void
    {
        $this->expectException(RuntimeException::class);

        $uut = new Csv(['key1' => 0], $this->stream, $this->adapter);
        $uut->getHeaderPosition('key2');
    }

    public function testExistingHeaderPosition(): void
    {
        $uut = new Csv(['key1' => 0], $this->stream, $this->adapter);
        $result = $uut->getHeaderPosition('key1');

        $this->assertSame(0, $result);
    }

    public function testGetByWithNoMatch(): void
    {
        $this->expectException(NotFound::class);

        $headers = [
            'key1' => 0,
            'key2' => 1,
        ];
        $this->stream->method('read')->willReturnOnConsecutiveCalls(
            ['key1', 'key2', 'key3'],
            ['value1', 'value2', 'value3'],
        );
        $uut     = new Csv($headers, $this->stream, $this->adapter);
        $uut->getBy('key1', 'jonny');
    }

    public function testGetByWithMatchResult(): void
    {
        $headers = [
            'key1' => 0,
            'key2' => 1,
        ];
        $this->stream->method('read')->willReturnOnConsecutiveCalls(
            ['key1', 'key2', 'key3'],
            ['value1', 'value2', 'value3'],
        );
        $this->adapter->method('toMessage')->willReturn($this->createMock(Message::class));
        $uut     = new Csv($headers, $this->stream, $this->adapter);
        $result  = $uut->getBy('key1', 'value1');

        $this->assertInstanceOf(Message::class, $result);
    }
}
