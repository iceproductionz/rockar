<?php

namespace Rockar\App\Routing\Response;

use Rockar\App\Message\Message;

class Success implements Response
{
    private Message $data;

    private array $showFields;

    public function __construct(Message $data, array $showFields)
    {
        $this->data       = $data;
        $this->showFields = $showFields;
    }

    public function getStatus(): string
    {
        return "200";
    }

    public function getData(): Message
    {
        return $this->data;
    }

    public function __serialize(): array
    {
        $fields = $this->getData()->__serialize();
        $data = [];
        foreach ($fields as $field => $value) {
            if (in_array($field, $this->showFields, true) === true) {
                $data[$field] = $value;
            }
        }
         
        return [
            'status' => $this->getStatus(),
            'data'   => (object)$data,
        ];
    }
}
