<?php

namespace App\Domain\Business\Ports;

use App\Domain\Business\Model\BusinessUser;

interface BusinessUserInterface
{
    public function store(BusinessUser $businessUser);

}