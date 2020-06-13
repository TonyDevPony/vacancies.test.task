<?php

namespace App\Repository;

use App\Entity\Resume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

/**
 * @method Resume|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resume|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resume[]    findAll()
 * @method Resume[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResumeRepository extends ServiceEntityRepository implements BaseRepositoryInterface
{
    private $manager;

    public function __construct(ManagerRegistry $registry, ObjectManager $manager)
    {
        $this->manager = $manager;

        parent::__construct($registry, Resume::class);
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $offset
     * @param int $limit
     * @return array
     */
    public function all(array $criteria = [], array $orderBy = null, $offset = null, $limit = 10): array
    {
      if($orderBy == null)
      {
        $orderBy['resumeId'] = 'DESC';
      }

      /**
       * @var Resume[] $resumeList
       */
      $resumeList = parent::findBy($criteria, $orderBy, $offset, $limit);

      return $resumeList;
    }

  /**
   * @param array $criteria
   * @return Resume
   */
    public function one(array $criteria = []): ?Resume
    {
      /**
       * @var Resume $resume
       */
      $resume = parent::findOneBy($criteria);

      if(!$resume)
      {
        return null;
      }

      return $resume;
    }

    /**
     * @return mixed|void
     */
    public function update()
    {
      $this->manager->flush();
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function delete(int $id): ?int
    {
      $resume = $this->manager->getRepository(Resume::class)->find($id);

      if(!$resume)
      {
        throw new \LogicException(
          'No resume found for id'. $id
        );
      }
      $this->manager->remove($resume);
      $this->manager->flush();

      return $id;
    }

    public function save(Resume $resume): Resume
    {
      $this->manager->persist($resume);
      $this->manager->flush();

      return $resume;
    }

}
