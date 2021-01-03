<?php

namespace Rockar\App\Services\Products;

use Rockar\App\Message\Product\Product;
use Rockar\App\Routing\Request\Request;
use Rockar\App\Store\Store;

class Products
{
    private Store $datastore;

    /**
     * @param Store $datastore
     */
    public function __construct(Store $datastore)
    {
        $this->datastore = $datastore;
    }

    /**
     * @param Request $product
     * @return Product
     */
    public function getBy(Request $product): Product
    {
        return $this->datastore->getBy(
            $product->getIdentifierField(),
            $product->getIdentifier()
        );
    }
}
