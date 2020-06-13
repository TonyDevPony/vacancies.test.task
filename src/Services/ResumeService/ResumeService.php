<?php

namespace App\Services\ResumeService;


use App\Entity\Resume;
use App\Repository\ResumeRepository;
use Symfony\Component\Validator\Constraints\Date;

class ResumeService implements ResumeServiceInterface
{

  private $resumeRepository;

  public function __construct(ResumeRepository $resumeRepository)
  {
    $this->resumeRepository = $resumeRepository;
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
   * @param int $id
   * @return Resume
   */
  public function getOne(int $id): Resume
  {
    return $this->resumeRepository->one($id);
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

//  public function send(Resume $resume)
//  {
//    // TODO: Implement send() method.
//  }
//
//  public function approve(int $id)
//  {
//    // TODO: Implement approve() method.
//  }
//
//  public function reject(int $id)
//  {
//    // TODO: Implement reject() method.
//  }

}
