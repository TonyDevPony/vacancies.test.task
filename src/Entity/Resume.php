<?php

namespace App\Entity;

use App\Repository\ResumeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResumeRepository::class)
 */
class Resume
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $resumeId;

    /**
     * @ORM\Column(type="integer")
     */
    private $creatorId;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $positionTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $resumeText;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     */
    private $updatedAt;

    /**
     * @return int|null
     */
    public function getResumeId(): ?int
    {
        return $this->resumeId;
    }

  /**
   * @param $resumeId
   * @return $this
   */
    public function setResumeId($resumeId): self
    {
      $this->resumeId = $resumeId;

      return $this;
    }

  /**
   * @return int|null
   */
    public function getCreatorId(): ?int
    {
      return $this->creatorId;
    }

    /**
     * @param $creatorId
     * @return $this
     */
    public function setCreatorId($creatorId): self
    {
      $this->creatorId = $creatorId;

      return $this;
    }

    /**
     * @return string|null
     */
    public function getPositionTitle(): ?string
    {
      return $this->positionTitle;
    }

  /**
   * @param $positionTitle
   * @return $this
   */
    public function setPositionTitle($positionTitle): self
    {
      $this->positionTitle = $positionTitle;

      return $this;
    }

    /**
     * @return string|null
     */
    public function getResumeText(): ?string
    {
      return $this->resumeText;
    }

    /**
     * @param $resumeText
     * @return $this
     */
    public function setResumeText($resumeText): self
    {
      $this->resumeText = $resumeText;

      return $this;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt(): ?int
    {
      return $this->createdAt;
    }

    /**
     * @param $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt): self
    {
      $this->createdAt = $createdAt;

      return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
      return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
      $this->updatedAt = $updatedAt;
    }

}
