<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    /**
     * UserRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string|null $firstName
     * @param string|null $lastName
     * @return Query
     */
    public function searchUserByName(?string $firstName, ?string $lastName): Query
    {
        /** @var QueryBuilder $query */
        $query = $this->createQueryBuilder('user');

        if (!empty($firstName)) {
            $query->where("user.firstName LIKE :firstName")
            ->setParameter('firstName', "%$firstName%");
        }

        if (!empty($lastName)) {
            $query->orWhere("user.lastName LIKE :lastName")
            ->setParameter('lastName', "%$lastName%");
        }

        return $query->getQuery();
    }
}
