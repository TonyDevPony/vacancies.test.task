<?php

namespace App\Services\ResumeService;

use App\Entity\Resume;

interface ResumeServiceInterface
{
  /**
   * @param array $orderBy
   * @param int|null $limit
   * @param int|null $offset
   * @return mixed
   */
  public function getAll(array $orderBy = [], int $limit = null, int $offset = null): array ;

  /**
   * @param int $id
   * @return Resume
   */
  public function one(int $id): Resume;

  /**
   * @param int $creatorId
   * @param string $positionTitle
   * @param string $resumeText
   * @return Resume|null
   */
  public function create(int $creatorId, string $positionTitle, string $resumeText): ?Resume;

  /**
   * @param Resume $resume
   * @return mixed
   */
  public function send(Resume $resume);

  public function approve(int $id);

  public function reject(int $id);

}
