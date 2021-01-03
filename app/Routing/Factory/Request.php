<?php

namespace Rockar\App\Routing\Factory;

use Psr\Http\Message\ServerRequestInterface;
use Rockar\App\Exception\BadRequest;
use Rockar\App\Routing\Request\Customer;
use Rockar\App\Routing\Request\Product;
use Rockar\App\Routing\Request\Request as RequestRouting;

class Request
{
    public const TYPES = [
        'customer' => Customer::class,
        'product'  => Product::class,
    ];

    public function make(ServerRequestInterface $request, string $type): RequestRouting
    {
        if (in_array($type, array_keys(self::TYPES), true) === false) {
            throw new BadRequest('Cannot create data object', 0);
        }
        if (!isset($request->getQueryParams()['identifier'])) {
            throw new BadRequest('identifier not supplied in query', 0);
        }
        if (!isset($request->getQueryParams()['identifierField'])) {
            throw new BadRequest('identifierField not supplied in query', 0);
        }
        if (!isset($request->getQueryParams()['fields'])) {
            throw new BadRequest('fields not supplied in query', 0);
        }

        $args = [];
        $args[] = $request->getQueryParams()['identifier'];
        $args[] = $request->getQueryParams()['identifierField'];
        $args[] = $request->getQueryParams()['fields'];
        $selectedClass = self::TYPES[$type];

        return new $selectedClass(...$args);
    }
}
