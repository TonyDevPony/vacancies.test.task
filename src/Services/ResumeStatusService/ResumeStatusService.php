<?php


namespace App\Services\ResumeStatusService;

use App\Entity\Resume;
use App\Entity\ResumeStatus;
use App\Repository\ResumeRepository;
use App\Repository\ResumeStatusRepository;
use App\Services\ResumeService\ResumeServiceInterface;
use Symfony\Component\Validator\Constraints\Date;



class ResumeStatusService implements ResumeStatusServiceInterface
{
  private $resumeStatusRepository;

  private $resumeRepository;



  public function __construct(ResumeStatusRepository $resumeStatusRepository, ResumeRepository $resumeRepository)
  {
    $this->resumeStatusRepository = $resumeStatusRepository;
    $this->resumeRepository = $resumeRepository;
    $this->resumeRepository = $resumeRepository;

  }

  /**
   * @param array $criteria
   * @return mixed|object
   */
  public function getOne(array $criteria = []): ?ResumeStatus
  {
    return $this->resumeStatusRepository->one($criteria);
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
    return $this->resumeStatusRepository->all($criteria, $orderBy, $limit,$offset);
  }

  /**
   * @param int $vacancyId
   * @param int $resumeId
   * @return ResumeStatus|mixed
   */
  public function create(int $vacancyId, int $resumeId)
  {
    /**
     * @var ResumeStatus $resumeStatus
     */
    $resumeStatus = new ResumeStatus($vacancyId, $resumeId);

    $this->resumeStatusRepository->save($resumeStatus);

    return $resumeStatus;
  }

  /**
   * @param int $resumeId
   * @param int $status
   * @return mixed|void
   */
  public function update(int $resumeId, int $status)
  {
    $resumeStatus = $this->resumeStatusRepository->findOneBy(['resumeId' => $resumeId]);

    if(!$resumeStatus)
    {
      throw new \LogicException(
        'No resume status found for id' .$resumeId
      );
    }

    $resumeStatus->setStatus($status);
    $this->resumeStatusRepository->update();

    return $resumeStatus;
  }

  /**
   * @param int $vacancyId
   * @param array $orderBy
   * @param int|null $limit
   * @param int|null $offset
   * @return array
   */
  public function getPendingResumeList(int $vacancyId, array $orderBy = [], int $limit = null, int $offset = null):array
  {
    $resumeStatusLists = $this->resumeStatusRepository->all(['vacancyId' => $vacancyId], $orderBy, $limit, $offset);

    $resumeList = array();
    for ($i = 0; $i < count($resumeStatusLists); $i++)
    {
      $resumeList[$i] = $this->resumeRepository->one(['resumeId' =>  $resumeStatusLists[$i]->getResumeId()]);
    }

    return $resumeList;

  }


}
