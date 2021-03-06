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
class VacancyRepository extends ServiceEntityRepository implements BaseRepositoryInterface
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
   * @param array $criteria
   * @return Vacancy
   */
    public function one(array $criteria = []): Vacancy
    {
      /**
       * @var Vacancy $vacancy
       */
      $vacancy = parent::findOneBy($criteria);
      if(!$vacancy) {
        throw new \LogicException(
          'No vacancy found'
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
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {
      $this->manager->flush();
    }

  /**
   * @param int $id
   * @return int|null
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
    public function delete(int $id): ?int
    {

      $vacancy = $this->manager->getRepository(Vacancy::class)->find($id);

      if(!$vacancy) {
        throw new \LogicException(
          'No vacancy found for id '.$id
        );
      }
      $this->manager->remove($vacancy);
      $this->manager->flush();

      return $id;
    }

}
