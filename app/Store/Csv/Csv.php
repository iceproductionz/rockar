<?php

namespace Rockar\App\Store\Csv;

use Rockar\App\Adapter\Adapter;
use Rockar\App\Exception\NotFound;
use Rockar\App\Model\Stream\Stream;
use Rockar\App\Store\Store;

class Csv implements Store
{
    private array $headers;

    private Adapter $adapter;

    private Stream $stream;

    public function __construct(
        array $headers,
        Stream $stream,
        Adapter $adapter
    ) {
        $this->headers = $headers;
        $this->stream = $stream;
        $this->adapter = $adapter;
    }

    public function getBy($field, $value)
    {
        $headerPosition = $this->getHeaderPosition($field);
        $this->stream->rewind();

        while (($data =  $this->stream->read()) !== null) {
            if ($data[$headerPosition] === $value) {
                return $this->adapter->toMessage($data);
            }
        }

        throw new NotFound(get_class($this->adapter) . ' not found');
    }

    public function getHeaderPosition(string $field): int
    {
        if (!isset($this->headers[$field])) {
            throw new NotFound('Header not found');
        }

        return $this->headers[$field];
    }
}
