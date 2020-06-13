<?php


namespace App\Services\ResumeStatusService;

use App\Entity\ResumeStatus;

/**
 * Interface ResumeStatusServiceInterface
 * @package App\Services\ResumeStatusService
 */
interface ResumeStatusServiceInterface
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
   * @return mixed
   */
  public function getOne(array $criteria = []): ?ResumeStatus;

  /**
   * @param int $vacancyId
   * @param int $resumeId
   * @return mixed
   */
  public function create(int $vacancyId, int $resumeId);

  /**
   * @param int $resumeId
   * @param int $status
   * @return mixed
   */
  public function update(int $resumeId, int $status);

  /**
   * @param int $vacancyId
   * @param array $orderBy
   * @param int|null $limit
   * @param int|null $offset
   * @return array
   */
  public function getPendingResumeList(int $vacancyId, array $orderBy = [], int $limit = null, int $offset = null): array ;


}
