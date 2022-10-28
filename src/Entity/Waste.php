<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\WasteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: WasteRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GET',
        'POST' => [
            'method' => 'POST',
            'path' => '/wastes/add'
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['waste.read']
            ]
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['waste.write']
            ],
            'security' => 'is_granted("ROLE_ADMIN")'
        ],
        'delete' => [
            'method' => 'DELETE',
            'security' => 'is_granted("ROLE_ADMIN")'
        ]
    ], denormalizationContext: ['groups' => ['waste.write']], normalizationContext: ['groups' => ['waste.read']]
)]
class Waste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['waste.read'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['waste.read', 'waste.write'])]
    #[Assert\NotBlank(message: 'Le nom est obligatoire')]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['waste.read', 'waste.write'])]
    private ?string $serialNumber = null;

    #[ORM\ManyToOne(inversedBy: 'wastes')]
    #[Groups(['waste.read', 'waste.write'])]
    private ?WasteType $wasteType = null;

    #[ORM\ManyToOne(inversedBy: 'wasteContainerModel')]
    #[Groups(['waste.read', 'waste.write'])]
    private ?WasteContainerModel $wasteContainerModel = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['waste.read', 'waste.write'])]
    #[Assert\DateTime]
    private ?\DateTimeInterface $installFirstDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['waste.read', 'waste.write'])]
    #[Assert\DateTime]
    private ?\DateTimeInterface $installNewDate = null;

    #[ORM\ManyToOne(inversedBy: 'wastes')]
    #[Groups(['waste.read'])]
    private ?Comune $commune = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['waste.read', 'waste.write'])]
    private ?string $localisationName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['waste.read', 'waste.write'])]
    private ?string $localisationStreet = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['waste.read', 'waste.write'])]
    private ?float $localisationLatitude = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['waste.read', 'waste.write'])]
    private ?float $localisationLongitude = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['waste.read'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['waste.read'])]
    private ?\DateTimeImmutable $updated_at = null;

    public function __construct() {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
    }

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

    public function getCommune(): ?Comune
    {
        return $this->commune;
    }

    public function setCommune(?Comune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getLocalisationName(): ?string
    {
        return $this->localisationName;
    }

    public function setLocalisationName(string $localisationName): self
    {
        $this->localisationName = $localisationName;

        return $this;
    }

    public function getLocalisationStreet(): ?string
    {
        return $this->localisationStreet;
    }

    public function setLocalisationStreet(string $localisationStreet): self
    {
        $this->localisationStreet = $localisationStreet;

        return $this;
    }

    public function getLocalisationLatitude(): ?float
    {
        return $this->localisationLatitude;
    }

    public function setLocalisationLatitude(float $localisationLatitude): self
    {
        $this->localisationLatitude = $localisationLatitude;

        return $this;
    }

    public function getLocalisationLongitude(): ?float
    {
        return $this->localisationLongitude;
    }

    public function setLocalisationLongitude(float $localisationLongitude): self
    {
        $this->localisationLongitude = $localisationLongitude;

        return $this;
    }
}
