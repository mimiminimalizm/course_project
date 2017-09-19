<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param string $username
     *
     * @return User|null
     */
    public function findUser(string $username): ?User
    {
        return $this
            ->createQueryBuilder('u')
            ->where('u.email = ?1')
            ->orWhere('u.username = ?1')
            ->setMaxResults(1)
            ->getQuery()
            ->setParameter(1, $username)
            ->getSingleResult();
    }
}