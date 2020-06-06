<?php

namespace App\Entity;

use App\Repository\VacancyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VacancyRepository::class)
 */
class Vacancy
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $creatorId;

    /**
    * @ORM\Column(type="string", length=180)
    */
    private $title;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $site;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
    * @ORM\Column(type="datetime", name="created_at")
    */
    private $createdAt;


    /**
     * @ORM\Column(type="datetime", name="deleted_at")
     */
    private $deletedAt;

    public function __construct(string $title, string $site,
                                string $address, int $telephone, string $description)
    {

      $this->title = $title;
      $this->site = $site;
      $this->address = $address;
      $this->telephone = $telephone;
      $this->description = $description;

    }


  public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getCreatorId(): ?int
    {
      return $this->creatorId;
    }

    /**
     * @param mixed $creatorId
     */
    public function setCreatorId($creatorId): self
    {
      $this->creatorId = $creatorId;

      return $this;
    }
    /**
     * @return string
     */
    public function getTitle(): ?string
    {
      return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): self
    {
      $this->title = $title;

      return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
      return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): self
    {
      $this->description = $description;

      return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
      return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): self
    {
      $this->createdAt = $createdAt;

      return $this;
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
      return $this->deletedAt;
    }

    /**
     * @param mixed $deletedAt
     */
    public function setDeletedAt($deletedAt): self
    {
      $this->deletedAt = $deletedAt;

      return $this;
    }

    /**
     * @return string
     */
    public function getSite(): ?string
    {
      return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site): self
    {
      $this->site = $site;

      return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
      return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): self
    {
      $this->address = $address;

      return $this;
    }

    /**
     * @return integer
     */
    public function getTelephone(): ?int
    {
      return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone): self
    {
      $this->telephone = $telephone;

      return $this;
    }

}
