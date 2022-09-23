<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportRepository::class)]
class Report
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reports')]
    private ?User $user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localisationName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localisationNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localisationLongitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localisationLatitude = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLocalisationName(): ?string
    {
        return $this->localisationName;
    }

    public function setLocalisationName(?string $localisationName): self
    {
        $this->localisationName = $localisationName;

        return $this;
    }

    public function getLocalisationNumber(): ?string
    {
        return $this->localisationNumber;
    }

    public function setLocalisationNumber(?string $localisationNumber): self
    {
        $this->localisationNumber = $localisationNumber;

        return $this;
    }

    public function getLocalisationLongitude(): ?string
    {
        return $this->localisationLongitude;
    }

    public function setLocalisationLongitude(?string $localisationLongitude): self
    {
        $this->localisationLongitude = $localisationLongitude;

        return $this;
    }

    public function getLocalisationLatitude(): ?string
    {
        return $this->localisationLatitude;
    }

    public function setLocalisationLatitude(?string $localisationLatitude): self
    {
        $this->localisationLatitude = $localisationLatitude;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
