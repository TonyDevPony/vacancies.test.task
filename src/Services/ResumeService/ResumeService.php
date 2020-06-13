<?php

namespace App\Services\ResumeService;


use App\Entity\Resume;
use App\Entity\ResumeStatus;
use App\Entity\User;
use App\Repository\ResumeRepository;
use App\Repository\ResumeStatusRepository;
use App\Services\ResumeStatusService\ResumeStatusService;
use Symfony\Component\Validator\Constraints\Date;

class ResumeService implements ResumeServiceInterface
{

  private $resumeRepository;

  private $resumeStatusService;



  public function __construct(ResumeRepository $resumeRepository, ResumeStatusService $resumeStatusService)
  {
    $this->resumeRepository = $resumeRepository;
    $this->resumeStatusService = $resumeStatusService;
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
    return $this->resumeRepository->all($criteria, $orderBy, $limit,$offset);
  }


  /**
   * @param int $creatorId
   * @param string $positionTitle
   * @param string $resumeText
   * @return Resume|null
   */
  public function create(int $creatorId, string $positionTitle, string $resumeText): ?Resume
  {
    $resume = new Resume($creatorId, $positionTitle, $resumeText);

    $this->resumeRepository->save($resume);

    return $resume;
  }

  /**
   * @param array $criteria
   * @return Resume
   */
  public function getOne(array $criteria = []): Resume
  {
    return $this->resumeRepository->one($criteria);
  }

  public function update(int $id, int $creatorId = null, string $positionTitle = '', $resumeText = '')
  {
    $resume = $this->resumeRepository->find($id);

    if(!$resume)
    {
      throw new \LogicException(
        'No resume found for id' .$id
      );
    }

    if($creatorId)
      $resume->setCreatorId($creatorId);

    if($positionTitle != '')
      $resume->setPositionTitle($positionTitle);

    if($resumeText != '')
      $resume->setResumeText($resumeText);


    $resume->setUpdatedAt(new \DateTime());
    $this->resumeRepository->update();

    return $resume;
  }

  /**
   * @param int $id
   * @return mixed|void
   */
  public function delete(int $id)
  {
    $this->resumeRepository->delete($id);
  }

  /**
   * @param int $vacancyId
   * @param int $resumeId
   * @return mixed|void
   */
  public function send(int $vacancyId, int $resumeId)
  {
    $this->resumeStatusService->create($vacancyId, $resumeId);
    $resume = $this->resumeRepository->one(['resumeId' => $resumeId]);
    $resume->setIsSend(1);
    $this->resumeRepository->update();
  }

  /**
   * @param int $id
   * @return mixed|void
   */
  public function approve(int $id)
  {
    $this->resumeStatusService->update($id, 1);
  }

  /**
   * @param int $id
   * @return mixed|void
   */
  public function reject(int $id)
  {
    $this->resumeStatusService->update($id, 2);
  }

}
