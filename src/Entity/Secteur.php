<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\SecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SecteurRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GET' => [
            'openapi_context' => ['summary' => 'Récupérer tous les secteurs', 'description' => 'Récupérer tous les secteurs', 'tags' => ['Secteur']],
        ],
        'POST' => [
            'method' => 'POST',
            'path' => '/secteurs/add',
            'openapi_context' => ['summary' => 'Ajouter un nouveau secteur', 'description' => 'Ajouter un nouveau secteur', 'tags' => ['Secteur']],
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['secteur.read']
            ],
            'openapi_context' => ['summary' => 'Récupérer un secteur', 'description' => 'Récupérer un secteur', 'tags' => ['Secteur']],
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['secteur.write']
            ],
            'security' => 'is_granted("ROLE_ADMIN")',
            'openapi_context' => ['summary' => 'Modifier un secteur', 'description' => 'Modifier un secteur', 'tags' => ['Secteur']],
        ],
        'delete' => [
            'method' => 'DELETE',
            'security' => 'is_granted("ROLE_ADMIN")',
            'openapi_context' => ['summary' => 'Supprimer un secteur', 'description' => 'Supprimer un secteur', 'tags' => ['Secteur']],
        ]
    ],denormalizationContext: ['groups' => ['secteur.write']], normalizationContext: ['groups' => ['secteur.read']]
)]
class Secteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['secteur.read', 'passage.read', 'commune.read'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['secteur.read', 'secteur.write', 'passage.read', 'commune.read'])]
    #[Assert\NotBlank(message: 'Le nom est obligatoire')]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'secteurs')]
    #[Groups(['secteur.read', 'secteur.write', 'passage.read', 'commune.read'])]
    #[Assert\NotBlank(message: 'La commune est obligatoire')]
    private ?Comune $comune = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['secteur.read'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['secteur.read'])]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'secteurs', targetEntity: Passage::class)]
    #[Groups(['secteur.read', 'secteur.write', 'comune.read'])]
    private Collection $passages;

    public function __construct()
    {
        $this->passages = new ArrayCollection();
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

    public function getComuneId(): ?Comune
    {
        return $this->comune;
    }

    public function setComuneId(?Comune $comune): self
    {
        $this->comune = $comune;

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
            $passage->setSecteurId($this);
        }

        return $this;
    }

    public function removePassage(Passage $passage): self
    {
        if ($this->passages->removeElement($passage)) {
            // set the owning side to null (unless already changed)
            if ($passage->getSecteurId() === $this) {
                $passage->setSecteurId(null);
            }
        }

        return $this;
    }
}
