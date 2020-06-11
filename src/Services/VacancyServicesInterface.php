<?php


namespace App\Services;

use App\Entity\Vacancy;


interface VacancyServicesInterface
{
  /**
   * @param array $orderBy
   * @param int|null $limit
   * @param int $offset
   * @return array
   */
  public function getAll(array $orderBy = [], int $limit = null, int $offset = null): array;

  /**
   * @param int $id
   * @return Vacancy
   */
  public function getOne(int $id): Vacancy;
  /**
   * @param string $creatorName
   * @param string $title
   * @param string $site
   * @param string $address
   * @param int $telephone
   * @param string $description
   * @return Vacancy
   */
  public function create(string $creatorName, string $title, string $site,
                         string $address, string $telephone, string $description): Vacancy;

  /**
   * @param int $id
   * @return int|null
   */
  public function delete(int $id): ?int;

  public function update(int $id, string $title = '',
                         string $site  = '', string $address  = '',
                         string $telephone  = '', string $description  = ''): ?Vacancy;

}
