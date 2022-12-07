<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\WasteTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WasteTypeRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GET' => [
            'openapi_context' => ['summary' => 'Récupérer tous les types de déchets', 'description' => 'Récupérer tous les types de déchets', 'tags' => ['Type de déchets']],
        ],
        'POST' => [
            'method' => 'POST',
            'path' => '/waste_types/add',
            'openapi_context' => ['summary' => 'Ajouter un nouveau type de déchet', 'description' => 'Ajouter un nouveau type de déchet', 'tags' => ['Type de déchets']],
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['wastetype.read']
            ],
            'openapi_context' => ['summary' => 'Récupérer un type de déchet', 'description' => 'Récupérer un type de déchet', 'tags' => ['Type de déchets']],
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['wastetype.write']
            ],
            'security' => 'is_granted("ROLE_ADMIN")',
            'openapi_context' => ['summary' => 'Modifier un type de déchet', 'description' => 'Modifier un type de déchet', 'tags' => ['Type de déchets']],
        ],
        'delete' => [
            'method' => 'DELETE',
            'security' => 'is_granted("ROLE_ADMIN")',
            'openapi_context' => ['summary' => 'Supprimer un type de déchet', 'description' => 'Supprimer un type de déchet', 'tags' => ['Type de déchets']],
        ]
    ],denormalizationContext: ['groups' => ['wastetype.write']], normalizationContext: ['groups' => ['wastetype.read']]
)]
class WasteType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['wastetype.read', 'wastetype.write', 'waste.read', 'passage.read'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['wastetype.read', 'wastetype.write', 'waste.read', 'passage.read'])]
    #[Assert\NotBlank(message: 'La désignation est obligatoire')]
    #[Assert\Length(max: 255, maxMessage: 'La désignation ne doit pas dépasser {{ limit }} caractères')]
    #[Assert\Type(type: 'string', message: 'La désignation doit être une chaîne de caractères')]
    private ?string $designation = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['wastetype.read', 'wastetype.write', 'waste.read', 'passage.read'])]
    #[Assert\Type(type: 'float', message: 'La densité doit être un nombre')]
    private ?float $density = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['wastetype.read', 'wastetype.write', 'waste.read', 'passage.read'])]
    #[Assert\Length(max: 255, maxMessage: 'La désignation personnalisée ne doit pas dépasser {{ limit }} caractères')]
    #[Assert\Type(type: 'string', message: 'La désignation personnalisée doit être une chaîne de caractères')]
    private ?string $customerDesignation = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['wastetype.read'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['wastetype.read'])]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'wasteType', targetEntity: Waste::class)]
    private Collection $wastes;

    #[ORM\OneToMany(mappedBy: 'wasteType', targetEntity: Passage::class)]
    private Collection $passages;

    public function __construct()
    {
        $this->wastes = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
        $this->passages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDensity(): ?float
    {
        return $this->density;
    }

    public function setDensity(?float $density): self
    {
        $this->density = $density;

        return $this;
    }

    public function getCustomerDesignation(): ?string
    {
        return $this->customerDesignation;
    }

    public function setCustomerDesignation(?string $customerDesignation): self
    {
        $this->customerDesignation = $customerDesignation;

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

    /**
     * @return Collection<int, Waste>
     */
    public function getWastes(): Collection
    {
        return $this->wastes;
    }

    public function addWaste(Waste $waste): self
    {
        if (!$this->wastes->contains($waste)) {
            $this->wastes->add($waste);
            $waste->setWasteType($this);
        }

        return $this;
    }

    public function removeWaste(Waste $waste): self
    {
        if ($this->wastes->removeElement($waste)) {
            // set the owning side to null (unless already changed)
            if ($waste->getWasteType() === $this) {
                $waste->setWasteType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Passage>
     */
    public function getPassages(): Collection
    {
        return $this->passages;
    }

    public function addPassage(Passage $passage): self
    {
        if (!$this->passages->contains($passage)) {
            $this->passages->add($passage);
            $passage->setWasteType($this);
        }

        return $this;
    }

    public function removePassage(Passage $passage): self
    {
        if ($this->passages->removeElement($passage)) {
            // set the owning side to null (unless already changed)
            if ($passage->getWasteType() === $this) {
                $passage->setWasteType(null);
            }
        }

        return $this;
    }
}
