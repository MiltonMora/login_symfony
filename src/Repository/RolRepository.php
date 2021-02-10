<?php

namespace App\Repository;

use App\Domain\Users\Ports\RolInterface;
use App\Domain\Users\Model\Rol;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RolRepository extends BaseRepository implements RolInterface
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
    public function store(Rol $rol): void
    {
        $this->saveEntity($rol);
    }
}