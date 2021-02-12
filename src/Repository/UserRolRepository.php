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
            ->select('userRol.id')
            ->from(UserRol::class, 'userRol')
            //->join(Rol::class, 'rol', 'WITH', 'userRol.rolId = rol.id')
            ->where('userRol.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult();

        return $roles;
    }
}