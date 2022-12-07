<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\RecyclingCenterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecyclingCenterRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GET' => [
            'openapi_context' => ['summary' => 'Récupérer tous les centres de recyclage', 'description' => 'Récupérer tous les centres de recyclage', 'tags' => ['Centre de recyclage']],
        ],
        'POST' => [
            'method' => 'POST',
            'path' => '/recycling_centers/add',
            'openapi_context' => ['summary' => 'Ajouter un nouveau centre de recyclage', 'description' => 'Ajouter un nouveau centre de recyclage', 'tags' => ['Centre de recyclage']],
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['recyclingcenter.read']
            ],
            'openapi_context' => ['summary' => 'Récupérer un centre de recyclage', 'description' => 'Récupérer un centre de recyclage', 'tags' => ['Centre de recyclage']],
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['recyclingcenter.write']
            ],
            'security' => 'is_granted("ROLE_ADMIN")',
            'openapi_context' => ['summary' => 'Modifier un centre de recyclage', 'description' => 'Modifier un centre de recyclage', 'tags' => ['Centre de recyclage']],
        ],
        'delete' => [
            'method' => 'DELETE',
            'security' => 'is_granted("ROLE_ADMIN")',
            'openapi_context' => ['summary' => 'Supprimer un centre de recyclage', 'description' => 'Supprimer un centre de recyclage', 'tags' => ['Centre de recyclage']],
        ]
    ],denormalizationContext: ['groups' => ['recyclingcenter.write']], normalizationContext: ['groups' => ['recyclingcenter.read']]
)]
class RecyclingCenter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['recyclingcenter.read'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recyclingCenters')]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write', 'commune.read'])]
    #[Assert\NotBlank(message: 'La commune est obligatoire')]
    private ?Comune $comune = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write', 'commune.read'])]
    #[Assert\NotBlank(message: 'Le nom est obligatoire')]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Le nom doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le nom doit faire au plus {{ limit }} caractères'
    )]
    #[Assert\Type(type: 'string', message: 'Le nom doit être une chaîne de caractères')]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write', 'commune.read'])]
    private ?string $business_hours = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write', 'commune.read'])]
    #[Assert\Type(type: 'float', message: 'La latitude doit être un nombre')]
    private ?float $latitude = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write', 'commune.read'])]
    #[Assert\Type(type: 'float', message: 'La latitude doit être un nombre')]
    private ?float $longitude = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['recyclingcenter.read'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['recyclingcenter.read'])]
    private ?\DateTimeImmutable $updated_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComuneId(): ?Comune
    {
        return $this->comune;
    }

    public function setComuneId(?Comune $comune): self
    {
        $this->comune = $comune;

        return $this;
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

    public function getBusinessHours(): ?string
    {
        return $this->business_hours;
    }

    public function setBusinessHours(?string $business_hours): self
    {
        $this->business_hours = $business_hours;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

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
