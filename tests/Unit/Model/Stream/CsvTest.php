<?php

namespace RockarTests\Unit\Model\Stream;

use PHPUnit\Framework\TestCase;
use Rockar\App\Model\Stream\Csv;
use Rockar\App\Model\Stream\Stream;

class CsvTest extends TestCase
{
    private $stream;

    public function setUp(): void
    {
        $this->stream = fopen('php://temp', '+r');
    }

    public function testConstruction(): void
    {
        $uut = new Csv($this->stream);

        $this->assertInstanceOf(Csv::class, $uut);
        $this->assertInstanceOf(Stream::class, $uut);
    }

    public function testReadEmpty(): void
    {
        $uut = new Csv($this->stream);
        $result = $uut->read();

        $this->assertNull($result);
    }

    public function testReadCsLine(): void
    {
        $expected =  ['row1', 'row2', 'row3', 'row4', 'row5'];
        fputcsv($this->stream, $expected);

        $uut = new Csv($this->stream);
        $uut->rewind();
        $result = $uut->read();

        $this->assertSame($expected, $result);
    }


    public function testRewind(): void
    {
        fputs($this->stream, "hello\n");
        $currentPosition = \ftell($this->stream);

        $this->assertSame(6, $currentPosition);

        $uut = new Csv($this->stream);
        $uut->rewind();

        $this->assertSame(0, \ftell($this->stream));
    }
}
