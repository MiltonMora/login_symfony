<?php


namespace App\Domain\Business\Ports;

use App\Domain\Business\Model\Business;

interface BusinessInterface
{
    public function store(Business $business);

    public function getBusinessById(string $businessId);

    public function getAll(): array;

}