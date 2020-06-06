<?php

namespace App\Repository;

use App\Entity\Vacancy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

/**
 * @method Vacancy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacancy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacancy[]    findAll()
 * @method Vacancy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacancyRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registry, ObjectManager $manager)
    {
      $this->manager = $manager;

      parent::__construct($registry, Vacancy::class);

    }

    /**
     * @return Vacancy[]
     */
    public function all(): array
    {
      $vacancies = parent::findAll();

      return $vacancies;
    }

    /**
     * @param int $id
     * @return Vacancy
     */
    public function one(int $id): Vacancy
    {
      /**
       * @var Vacancy $vacancy
       */
      $vacancy = parent::findOneBy(['id' => $id]);

      return $vacancy;
    }

    /**
     * @param Vacancy $vacancy
     * @return Vacancy
     */
    public function save(Vacancy $vacancy): Vacancy
    {
      $this->manager->persist($vacancy);
      $this->manager->flush();

      return $vacancy;
    }

    /**
     * @param Vacancy $vacancy
     * @return Vacancy
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Vacancy $vacancy): Vacancy
    {
      $this->manager->flush();

      return $vacancy;
    }

}
