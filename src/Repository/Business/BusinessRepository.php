<?php


namespace App\Repository\Business;


use App\Domain\Business\Ports\BusinessInterface;
use App\Domain\Business\Model\Business;
use App\Repository\BaseRepository;

class BusinessRepository extends BaseRepository implements BusinessInterface
{

    protected static function entityClass(): string
    {
        return Business::class;
    }

    public function store(Business $business)
    {
        $this->saveEntity($business);
    }

    public function getBusinessById(string $businessId)
    {
        return $this->objectRepository->find($businessId);
    }
}