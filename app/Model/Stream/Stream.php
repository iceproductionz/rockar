<?php

namespace Rockar\App\Model\Stream;

interface Stream
{
    /**
     * Read line from stream
     *
     * @return null|array
     */
    public function read(): ?array;
    
    /**
     * Reset cursor to beginning
     *
     * @return int
     */
    public function rewind(): int;
}
