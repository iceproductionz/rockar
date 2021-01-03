<?php

namespace Rockar\App\Store;

interface Store
{
    public function getBy($field, $id);
}
