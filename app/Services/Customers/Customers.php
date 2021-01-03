<?php

namespace Rockar\App\Services\Customers;

use Rockar\App\Message\Customer\Customer;
use Rockar\App\Routing\Request\Request;
use Rockar\App\Store\Store;

class Customers
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
     * @param Request $customer
     * @return Customer
     */
    public function getBy(Request $customer): Customer
    {
        return $this->datastore->getBy(
            $customer->getIdentifierField(),
            $customer->getIdentifier()
        );
    }
}
