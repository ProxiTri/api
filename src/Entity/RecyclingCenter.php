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
        'GET',
        'POST' => [
            'method' => 'POST',
            'path' => '/recyling_centers/add'
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['recyclingcenter.read']
            ]
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['recyclingcenter.write']
            ]
        ],
        'delete'
    ]
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
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write'])]
    #[Assert\NotBlank(message: 'La commune est obligatoire')]
    private ?Comune $comune = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write'])]
    #[Assert\NotBlank(message: 'Le nom est obligatoire')]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write'])]
    private ?string $buisness_hours = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write'])]
    private ?float $latitude = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write'])]
    private ?float $longitude = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write'])]
    #[Assert\DateTime]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['recyclingcenter.read', 'recyclingcenter.write'])]
    #[Assert\DateTime]
    private ?\DateTimeInterface $updated_at = null;

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

    public function getBuisnessHours(): ?string
    {
        return $this->buisness_hours;
    }

    public function setBuisnessHours(?string $buisness_hours): self
    {
        $this->buisness_hours = $buisness_hours;

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
