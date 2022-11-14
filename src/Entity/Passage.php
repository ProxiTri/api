<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\PassageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PassageRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GET',
        'POST' => [
            'method' => 'POST',
            'path' => '/passages/add'
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['passage.read']
            ]
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['passage.write']
            ],
            'security' => 'is_granted("ROLE_ADMIN")'
        ],
        'delete' => [
            'method' => 'DELETE',
            'security' => 'is_granted("ROLE_ADMIN")'
        ]
    ], denormalizationContext: ['groups' => ['passage.write']], normalizationContext: ['groups' => ['passage.read']]
)]
class Passage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['passage.read'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['passage.read', 'passage.write'])]
    #[Assert\NotBlank(message: 'L\'heure de passage est obligatoire')]
    #[Assert\Type(type: 'string', message: 'L\'heure de passage doit être une chaîne de caractères')]
    private ?string $hours = null;

    #[ORM\ManyToOne(inversedBy: 'passages')]
    #[Groups(['passage.read', 'passage.write'])]
    #[Assert\NotBlank(message: 'Le secteur est obligatoire')]
    private ?Secteur $secteur = null;

    #[ORM\ManyToOne(inversedBy: 'passages')]
    private ?WasteType $wasteType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dayBefore = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHours(): ?string
    {
        return $this->hours;
    }

    public function setHours(?string $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getSecteurId(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteurId(?Secteur $secteur): self
    {
        $this->secteur = $secteur;

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

    public function getDayBefore(): ?string
    {
        return $this->dayBefore;
    }

    public function setDayBefore(?string $dayBefore): self
    {
        $this->dayBefore = $dayBefore;

        return $this;
    }
}
