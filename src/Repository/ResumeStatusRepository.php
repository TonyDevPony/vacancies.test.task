<?php

namespace App\Repository;


use App\Entity\ResumeStatus;
use App\Entity\Resume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

/**
 * @method ResumeStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResumeStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResumeStatus[]    findAll()
 * @method ResumeStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResumeStatusRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registry, ObjectManager $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, ResumeStatus::class);
    }

    public function save(ResumeStatus $resumeStatus): ResumeStatus
    {
      $this->manager->persist($resumeStatus);
      $this->manager->flush();

      return $resumeStatus;
    }

    public function one(array $criteria = [])
    {

      $resumeStatus = parent::findOneBy($criteria);

      if(!$resumeStatus)
      {
        throw new \LogicException(
          'No resume status found'
        );
      }

      return $resumeStatus;
    }

    public function all(array $criteria = [], array $orderBy = null, $offset = null, $limit = 10): array
    {
      if($orderBy == null)
      {
        $orderBy['statusId'] = 'DESC';
      }

      /**
       * @var ResumeStatus[] $resumeStatuses
       */
      $resumeStatuses = parent::findBy($criteria, $orderBy, $offset, $limit);

      return $resumeStatuses;
    }

    public function update()
    {
      $this->manager->flush();
    }




}
