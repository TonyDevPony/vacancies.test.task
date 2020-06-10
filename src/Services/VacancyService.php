<?php


namespace App\Services;


use App\Entity\Vacancy;
use App\Repository\VacancyRepository;

class VacancyService implements VacancyServicesInterface
{
  private $vacancyRepository;

  public function __construct(VacancyRepository $vacancyRepository)
  {
    $this->vacancyRepository = $vacancyRepository;
  }

  /**
   * @param array $orderBy
   * @param int|null $limit
   * @param int|null $offset
   * @return array
   */
  public function getAll(array $orderBy = [], int $limit = null, int $offset = null): array
  {
    return $this->vacancyRepository->all([], $orderBy, $limit, $offset);
  }

  /**
   * @param string $creatorName
   * @param string $title
   * @param string $site
   * @param string $address
   * @param string $telephone
   * @param string $description
   * @return Vacancy
   */
  public function create(string $creatorName,
                         string $title,
                         string $site,
                         string $address,
                         string $telephone,
                         string $description): Vacancy
  {


    $vacancy = new Vacancy($creatorName,$title, $site, $address, $telephone, $description);

    $this->vacancyRepository->save($vacancy);

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
    $this->vacancyRepository->delete($id);

    return $id;
  }


//  public function update(int $id, array $params): ?Vacancy
//  {
//    // TODO: Implement update() method.
//  }

}
