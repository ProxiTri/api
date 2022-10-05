<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\PassageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
            ]
        ],
        'delete'
    ]
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
    private ?string $hours = null;

    #[ORM\ManyToOne(inversedBy: 'passages')]
    #[Groups(['passage.read', 'passage.write'])]
    private ?Secteur $secteur = null;

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
}
