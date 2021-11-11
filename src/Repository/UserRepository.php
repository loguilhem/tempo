<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findTeamMembersExceptMe(User $user, int $company): array
    {
        return $this->createQueryBuilder('u')
            ->join('u.companies', 'c')
            ->where('c.id = :company')
            ->andWhere('u.id != :me')
            ->setParameter('company', $company)
            ->setParameter('me', $user)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCompany(Company $company): array
    {
        return $this->createQueryBuilder('u')
            ->join('u.companies', 'c')
            ->where('c.id = :company')
            ->setParameter('company', $company)
            ->getQuery()
            ->getResult()
        ;
    }
}
