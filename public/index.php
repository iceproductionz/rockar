<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Rockar\App\Adapter\Customer\Customer as CustomerAdapter;
use Rockar\App\Exception\BadRequest;
use Rockar\App\Exception\NotFound;
use Rockar\App\Http\Api\V1\Customers\Read as ReadCustomers;
use Rockar\App\Model\Stream\Csv as StreamCsv;
use Rockar\App\Routing\Factory\Request as FactoryRequest;
use Rockar\App\Routing\Factory\Response as FactoryResponse;
use Rockar\App\Services\Customers\Customers as CustomersService;
use Rockar\App\Store\Csv\Csv;
use Slim\Factory\AppFactory;
use Slim\Psr7\Request as Psr7Request;

require __DIR__ . '/../vendor/autoload.php';

$customersStoreConfig   = require __DIR__ . '/../config/store/customers.php';
$productsStoreConfig    = require __DIR__ . '/../config/store/products.php';

$routingRequestFactory  = new FactoryRequest();
$routingResponseFactory = new FactoryResponse();

$customerAdapter        = new CustomerAdapter();
$customerStream         = new StreamCsv(
    fopen($customersStoreConfig['filePath'], 'r+')
);
$customersStore         = new Csv(
    $customersStoreConfig['headers'],
    $customerStream,
    $customerAdapter
);
$customersService = new CustomersService($customersStore);
$customersApi     = new ReadCustomers($routingResponseFactory, $customersService);

$productAdapter        = new CustomerAdapter();
$productStream         = new StreamCsv(
    fopen($productsStoreConfig['filePath'], 'r+')
);
$productsStore         = new Csv(
    $productsStoreConfig['headers'],
    $productStream,
    $productAdapter
);
$productsService = new CustomersService($productsStore);
$productsApi     = new ReadCustomers($routingResponseFactory, $productsService);

// Instantiate App
$app = AppFactory::create();

// Add routes
$app->get(
    '/api/v1/customers',
    function (Request $request, Response $response) use ($routingRequestFactory, $customersApi) {
        $routingRequest = $routingRequestFactory->make($request, 'customer');
        $routingResponse = $customersApi($routingRequest);

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($routingResponse->__serialize(), JSON_PRETTY_PRINT));

        return $response;
    }
);
$app->get(
    '/api/v1/products',
    function (Request $request, Response $response) use ($routingRequestFactory, $productsApi) {
        $routingRequest  = $routingRequestFactory->make($request, 'product');
        $routingResponse = $productsApi($routingRequest);

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($routingResponse->__serialize(), JSON_PRETTY_PRINT));
        return $response;
    }
);


// Define Custom Error Handler
$customErrorHandler = function (
    Psr7Request $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails,
    ?LoggerInterface $logger = null
) use ($app) {
    $payload = ['error' => $exception->getMessage()];

    $response = $app->getResponseFactory()->createResponse();
    $response = $response->withStatus(500);
    if ($exception instanceof BadRequest) {
        $response = $response->withStatus(400);
    }
    if ($exception instanceof InvalidArgumentException) {
        $response = $response->withStatus(400);
    }
    if ($exception instanceof NotFound) {
        $response = $response->withStatus(404);
    }

    $response = $response->withHeader('Content-Type', 'application/json');
    
    $response->getBody()->write(
        json_encode($payload, JSON_PRETTY_PRINT)
    );

    return $response;
};

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
$app->run();
