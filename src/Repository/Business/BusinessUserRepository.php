<?php

namespace App\Repository\Business;

use App\Domain\Business\Model\BusinessUser;
use App\Domain\Business\Ports\BusinessUserInterface;
use App\Repository\BaseRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function findOrFailByUserId(string $userId): array
    {
        if (null === $user = $this->objectRepository->findBy(['user' => $userId])) {
            throw new NotFoundHttpException(\sprintf('User %s not found', $userId));
        }

        return $user;
    }


}