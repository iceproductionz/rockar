<?php

namespace Rockar\App\Message\Customer;

use Rockar\App\Message\Message;

class Customer implements Message
{
    
    private string $email;
    private string $forename;
    private string $surname;
    private string $contactNumber;
    private string $postcode;

    /**
     * @param string $email
     * @param string $forename
     * @param string $surname
     * @param string $contactNumber
     * @param string $postcode
     */
    public function __construct(
        string $email,
        string $forename,
        string $surname,
        string $contactNumber,
        string $postcode
    ) {
        $this->email    = $email;
        $this->forename = $forename;
        $this->surname  = $surname;
        $this->contactNumber = $contactNumber;
        $this->postcode = $postcode;
    }

    public function __serialize(): array
    {
        return [
            'email'         => $this->email,
            'forename'      => $this->forename,
            'surname'       => $this->surname,
            'contactNumber' => $this->contactNumber,
            'postcode'      => $this->postcode,
        ];
    }
}
