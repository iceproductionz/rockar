<?php

namespace Rockar\App\Http\Api\V1\Customers;

use Rockar\App\Exception\BadRequest;
use Rockar\App\Http\Api\Api;
use Rockar\App\Routing\Factory\Response;
use Rockar\App\Routing\Request\Customer;
use Rockar\App\Routing\Request\Request;
use Rockar\App\Routing\Response\Response as RoutingResponse;
use Rockar\App\Services\Customers\Customers;

class Read implements Api
{
    private Response $responseFactory;

    private Customers $customersService;

    public function __construct(Response $responseFactory, Customers $customersService)
    {
        $this->responseFactory = $responseFactory;
        $this->customersService = $customersService;
    }

    public function __invoke(Request $request): RoutingResponse
    {
        if (!$request instanceof Customer) {
            throw new BadRequest('Expected a customer request', 0);
        }

        return $this->responseFactory->makeSuccess(
            $this->customersService->getBy($request),
            $request->getFields()
        );
    }
}
