<?php

namespace App\Repository;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Domain\Users\Model\User;
use App\Domain\Users\Ports\UserInterface;

class UserRepository extends BaseRepository implements UserInterface
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findOneByEmailOrFail(string $email): User
    {
        if (null === $user = $this->objectRepository->findOneBy(['email' => $email])) {
            throw new NotFoundHttpException(\sprintf('User %s not found', $email));
        }

        return $user;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    public function findById(string $userId)
    {
        return $this->objectRepository->find($userId);
    }

    public function all()
    {
        return $this->objectRepository->findAll();
    }
}