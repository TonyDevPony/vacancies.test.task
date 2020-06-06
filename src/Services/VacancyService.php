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

  public function create(string $title, string $site,
                         string $address, int $telephone, string $description): Vacancy
  {
    $vacancy = new Vacancy($title, $site, $address, $telephone, $description);
  }

}
