<?php

namespace Rockar\App\Http\Api;

use Rockar\App\Routing\Request\Request;
use Rockar\App\Routing\Response\Response;

interface Api
{
    public function __invoke(Request $request): Response;
}
