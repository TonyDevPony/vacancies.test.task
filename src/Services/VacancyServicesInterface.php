<?php


namespace App\Services;

use App\Entity\Vacancy;


interface VacancyServicesInterface
{
  /**
   * @param string $title
   * @param string $site
   * @param string $address
   * @param int $telephone
   * @param string $description
   * @return Vacancy
   */
  public function create(string $title, string $site,
                         string $address, int $telephone, string $description): Vacancy;

}
