<?php

namespace App\Repository;

use App\Entity\Rol;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RolRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Rol::class;
    }

    public function findOneByNameOrFail(string $name): Rol
    {
        if (null === $rol = $this->objectRepository->findOneBy(['name' => $name])) {
            throw new NotFoundHttpException(\sprintf('rol %s not found', $name));
        }

        return $rol;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Rol $rol): void
    {
        $this->saveEntity($rol);
    }
}