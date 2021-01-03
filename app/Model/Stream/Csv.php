<?php

namespace Rockar\App\Model\Stream;

use RuntimeException;

class Csv implements Stream
{
    private $handle;

    /**
     * @param resource $handle
     */
    public function __construct($handle)
    {
        if (!is_resource($handle)) {
            throw new RuntimeException('Invalid Type');
        }

        $this->handle = $handle;
    }
    public function read(): ?array
    {
        $result = fgetcsv($this->handle);

        if ($result === false) {
            return null;
        }

        return $result;
    }
    
    public function rewind(): int
    {
        return fseek($this->handle, 0);
    }
}
