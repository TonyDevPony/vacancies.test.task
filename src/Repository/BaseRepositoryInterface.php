<?php

namespace App\Repository;

/**
 * Interface BaseRepositoryInterface
 * @package App\Repository
 */
interface BaseRepositoryInterface
{
  /**
   * @param array $criteria
   * @param array|null $orderBy
   * @param null $offset
   * @param int $limit
   * @return array
   */
  public function all(array $criteria = [], array $orderBy = null, $offset = null, $limit = 10): array;

  /**
   * @param array $criteria
   * @return mixed
   */
  public function one(array $criteria = []);

  /**
   * @return mixed
   */
  public function update();

  /**
   * @param int $id
   * @return mixed
   */
  public function delete(int $id);
}

