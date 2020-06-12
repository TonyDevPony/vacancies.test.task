<?php

namespace App\Services\ResumeService;


use App\Entity\Resume;
use App\Repository\ResumeRepository;

class ResumeService implements ResumeServiceInterface
{

  private $resumeRepository;

  public function __construct(ResumeRepository $resumeRepository)
  {
    $this->resumeRepository = $resumeRepository;
  }

  /**
   * @param array $orderBy
   * @param int|null $limit
   * @param int|null $offset
   * @return array
   */
  public function getAll(array $orderBy = [], int $limit = null, int $offset = null): array
  {
    // TODO: Implement getAll() method.
  }


  /**
   * @param int $creatorId
   * @param string $positionTitle
   * @param string $resumeText
   * @return Resume|null
   */
  public function create(int $creatorId, string $positionTitle, string $resumeText): ?Resume
  {
    // TODO: Implement create() method.
  }

  /**
   * @param int $id
   * @return Resume
   */
  public function one(int $id): Resume
  {
    // TODO: Implement one() method.
  }

  public function send(Resume $resume)
  {
    // TODO: Implement send() method.
  }

  public function approve(int $id)
  {
    // TODO: Implement approve() method.
  }

  public function reject(int $id)
  {
    // TODO: Implement reject() method.
  }

}
