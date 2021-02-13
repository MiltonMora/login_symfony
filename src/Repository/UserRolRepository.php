<?php

namespace App\Repository;

use App\Domain\Users\Model\Rol;
use App\Domain\Users\Ports\UserRolInterface;
use App\Domain\Users\Model\UserRol;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRolRepository extends BaseRepository implements UserRolInterface
{
    protected static function entityClass(): string
    {
        return UserRol::class;
    }


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function store(UserRol $userRol): void
    {
        $this->saveEntity($userRol);
    }

    public function getRolesByUserId(string $userId): array
    {
        $roles = $this->objectRepository->createQueryBuilder('userRoles')
            ->select('(userRol.rol)')
            ->from(UserRol::class, 'userRol')
            ->where('userRol.user = :userId')
            ->distinct('(userRol.rol)')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult();

        return $roles;
    }
}