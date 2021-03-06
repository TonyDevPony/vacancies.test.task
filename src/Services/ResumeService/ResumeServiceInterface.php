<?php

namespace App\Services\ResumeService;

use App\Entity\Resume;

interface ResumeServiceInterface
{
  /**
   * @param array $criteria
   * @param array $orderBy
   * @param int|null $limit
   * @param int|null $offset
   * @return array
   */
  public function getAll(array $criteria = [], array $orderBy = [], int $limit = null, int $offset = null): array ;

  /**
   * @param array $criteria
   * @return Resume
   */
  public function getOne(array $criteria = []): Resume;

  /**
   * @param int $creatorId
   * @param string $positionTitle
   * @param string $resumeText
   * @return Resume|null
   */
  public function create(int $creatorId, string $positionTitle, string $resumeText): ?Resume;

  /**
   * @param int $id
   * @param int $creatorId
   * @param string $positionTitle
   * @param $resumeText
   * @return mixed
   */
  public function update(int $id, int $creatorId = null, string $positionTitle = '', $resumeText = '');

  /**
   * @param int $id
   * @return mixed
   */
  public function delete(int $id);

  /**
   * @param int $vacancyId
   * @param int $resumeId
   * @return mixed|void
   */
  public function send(int $vacancyId, int $resumeId);

  /**
   * @param int $id
   * @return mixed
   */
  public function approve(int $id);

  /**
   * @param int $id
   * @return mixed
   */
  public function reject(int $id);

}
