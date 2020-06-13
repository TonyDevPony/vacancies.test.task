<?php


namespace App\Services\VacancyService;


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
   * @param array $criteria
   * @param array $orderBy
   * @param int|null $limit
   * @param int|null $offset
   * @return array
   */
  public function getAll(array $criteria = [], array $orderBy = [], int $limit = null, int $offset = null): array
  {
    return $this->vacancyRepository->all($criteria, $orderBy, $limit, $offset);
  }

  /**
   * @param int $id
   * @return Vacancy
   */
  public function getOne(int $id): Vacancy
  {
    return $this->vacancyRepository->one($id);
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


  public function update(int $id, string $title = '',
                         string $site  = '', string $address  = '',
                         string $telephone  = '', string $description  = ''): ?Vacancy
  {
    $vacancy = $this->vacancyRepository->find($id);

    if(!$vacancy) {
      throw new \LogicException(
        'No vacancy found for id' .$id
      );
    }

    if($title != '')
      $vacancy->setTitle($title);

    if($site != '')
      $vacancy->setSite($site);

    if($address != '')
      $vacancy->setAddress($address);

    if($telephone != '')
      $vacancy->setTelephone($telephone);

    if($description != '')
      $vacancy->setDescription($description);

    $this->vacancyRepository->update();

    return $vacancy;

  }

}
