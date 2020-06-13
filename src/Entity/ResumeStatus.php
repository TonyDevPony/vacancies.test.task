<?php

namespace App\Entity;

use App\Repository\ResumeStatusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResumeStatusRepository::class)
 */
class ResumeStatus
{
  const APPROVE = 1;
  const REJECT = 2;
  const PENDING = 0;

  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $statusId;

  /**
   * @ORM\Column(type="integer")
   */
  private $vacancyId;

  /**
   * @ORM\Column(type="integer")
   */
  private $resumeId;

  /**
   * @ORM\Column(type="integer")
   */
  private $status;

  public function __construct(int $vacancyId, int $resumeIds, int $status = self::PENDING)
  {
    $this->vacancyId = $vacancyId;
    $this->resumeId = $resumeIds;
    $this->status = $status;
  }

  /**
   * @return  int|null
   */
  public function getStatusId(): ?int
  {
    return $this->statusId;
  }

  /**
   * @return int|null
   */
  public function getVacancyId(): ?int
  {
    return $this->vacancyId;
  }

  /**
   * @param $vacancyId
   * @return $this
   */
  public function setVacancyId($vacancyId): self
  {
    $this->vacancyId = $vacancyId;

    return $this;
  }

  /**
   * @return int|null
   */
  public function getResumeId(): ?int
  {
    return $this->resumeId;
  }

  /**
   * @param $resumeIds
   * @return $this
   */
  public function setResumeId($resumeIds): self
  {
    $this->resumeId = $resumeIds;

    return $this;
  }

  /**
   * @return int|null
   */
  public function getStatus(): ?int
  {
    return $this->status;
  }

  /**
   * @param $status
   * @return $this
   */
  public function setStatus($status): self
  {
    $this->status = $status;

    return $this;
  }


  public function getApprove()
  {
    $this->status = self::APPROVE;
  }

  public function setReject()
  {
    $this->status = self::REJECT;
  }
}
