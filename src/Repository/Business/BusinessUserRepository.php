<?php

namespace App\Repository\Business;

use App\Domain\Business\Model\BusinessUser;
use App\Domain\Business\Ports\BusinessUserInterface;
use App\Repository\BaseRepository;

class BusinessUserRepository extends BaseRepository implements BusinessUserInterface
{
    protected static function entityClass(): string
    {
        return BusinessUser::class;
    }


    public function store(BusinessUser $businessUser): void
    {
        $this->saveEntity($businessUser);
    }

}