<?php

namespace Rockar\App\Http\Api\V1\Products;

use Rockar\App\Exception\BadRequest;
use Rockar\App\Http\Api\Api;
use Rockar\App\Routing\Factory\Response;
use Rockar\App\Routing\Request\Product;
use Rockar\App\Routing\Request\Request;
use Rockar\App\Routing\Response\Response as RoutingResponse;
use Rockar\App\Services\Products\Products;

class Read implements Api
{
    private Response $responseFactory;

    private Products $productsService;

    public function __construct(Response $responseFactory, Products $productsService)
    {
        $this->responseFactory = $responseFactory;
        $this->productsService = $productsService;
    }

    public function __invoke(Request $request): RoutingResponse
    {
        if (!$request instanceof Product) {
            throw new BadRequest('Expected a customer request', 0);
        }

        return $this->responseFactory->makeSuccess(
            $this->productsService->getBy($request),
            $request->getFields()
        );
    }
}
