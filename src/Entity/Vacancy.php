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
     * @ORM\Column(type="string", length=180)
     */
    private $creatorName;

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
     * @ORM\Column(type="string")
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
     * @ORM\Column(type="datetime", name="deleted_at", nullable=true)
     */
    private $deletedAt;

    public function __construct(string $creatorName, string $title, string $site,
                                string $address, string $telephone, string $description)
    {
      $this->creatorName = $creatorName;
      $this->title = $title;
      $this->site = $site;
      $this->address = $address;
      $this->telephone = $telephone;
      $this->description = $description;
      $this->createdAt = new \DateTime();

    }


    public function getId(): ?int
      {
          return $this->id;
      }

    /**
     * @return string|null
     */
      public function getCreatorName(): ?string
      {
        return $this->creatorName;
      }

    /**
     * @param $creatorName
     * @return $this
     */
      public function setCreatorName($creatorName): self
      {
        $this->creatorName = $creatorName;

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
       * @return $this
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
     * @param $description
     * @return $this
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
       * @return mixed
       */
      public function getDeletedAt()
      {
        return $this->deletedAt;
      }

      /**
       * @param mixed $deletedAt
       * @return $this
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
       * @return $this
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
       * @return $this
       */
      public function setAddress($address): self
      {
        $this->address = $address;

        return $this;
      }

      /**
       * @return integer
       */
      public function getTelephone(): ?string
      {
        return $this->telephone;
      }

      /**
       * @param mixed $telephone
       * @return $this
       */
      public function setTelephone($telephone): self
      {
        $this->telephone = $telephone;

        return $this;
      }

}
