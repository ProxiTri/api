<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WasteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WasteRepository::class)]
#[ApiResource]
class Waste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serialNumber = null;

    #[ORM\ManyToOne(inversedBy: 'wastes')]
    private ?WasteType $wasteType = null;

    #[ORM\ManyToOne(inversedBy: 'wasteContainerModel')]
    private ?WasteContainerModel $wasteContainerModel = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $installFirstDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $installNewDate = null;

    #[ORM\ManyToOne(inversedBy: 'wasteCity')]
    private ?Comune $localisationCityId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(?string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getWasteType(): ?WasteType
    {
        return $this->wasteType;
    }

    public function setWasteType(?WasteType $wasteType): self
    {
        $this->wasteType = $wasteType;

        return $this;
    }

    public function getWasteContainerModel(): ?WasteContainerModel
    {
        return $this->wasteContainerModel;
    }

    public function setWasteContainerModel(?WasteContainerModel $wasteContainerModel): self
    {
        $this->wasteContainerModel = $wasteContainerModel;

        return $this;
    }

    public function getInstallFirstDate(): ?\DateTimeInterface
    {
        return $this->installFirstDate;
    }

    public function setInstallFirstDate(?\DateTimeInterface $installFirstDate): self
    {
        $this->installFirstDate = $installFirstDate;

        return $this;
    }

    public function getInstallNewDate(): ?\DateTimeInterface
    {
        return $this->installNewDate;
    }

    public function setInstallNewDate(?\DateTimeInterface $installNewDate): self
    {
        $this->installNewDate = $installNewDate;

        return $this;
    }

    public function getLocalisationCityId(): ?Comune
    {
        return $this->localisationCityId;
    }

    public function setLocalisationCityId(?Comune $localisationCityId): self
    {
        $this->localisationCityId = $localisationCityId;

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