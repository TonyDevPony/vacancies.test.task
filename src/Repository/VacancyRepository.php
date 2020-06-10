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
   * @param array $criteria
   * @param array|null $orderBy
   * @param null $offset
   * @param int $limit
   * @return Vacancy[]
   */
    public function all(array $criteria = [], array $orderBy = null, $offset = null, $limit = 10): array
    {
      if($orderBy == null) {
        $orderBy['id'] = 'DESC';
      }

      /**
       * @var Vacancy[] $vacancies
       */
      $vacancies = parent::findBy($criteria, $orderBy, $offset, $limit);

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
      if(!$vacancy) {
        throw new \LogicException(
          'No vacancy found for id '.$id
        );
      }

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

  /**
   * @param int $id
   * @return int|null
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
    public function delete(int $id): ?int
    {
      $em = $this->getEntityManager();
      $vacancy = $em->getRepository(Vacancy::class)->find($id);

      if(!$vacancy) {
        throw new \LogicException(
          'No vacancy found for id '.$id
        );
      }
      $em->remove($vacancy);
      $em->flush();

      return $id;
    }

}
