<?php

namespace Rockar\App\Routing\Request;

interface Request
{
    public function getIdentifier(): string;

    public function getIdentifierField(): string;

    public function getFields(): array;
}
