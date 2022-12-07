<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\WasteContainerModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WasteContainerModelRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GET' => [
            'openapi_context' => ['summary' => 'Récupérer tous les modèles de poubelles', 'description' => 'Récupérer tous les modèles de poubelles', 'tags' => ['Modèle de poubelle']],
        ],
        'POST' => [
            'method' => 'POST',
            'path' => '/waste_container_models/add',
            'openapi_context' => ['summary' => 'Ajouter un nouveau modèle de poubelle', 'description' => 'Ajouter un nouveau modèle de poubelle', 'tags' => ['Modèle de poubelle']],
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['wastecontainermodel.read']
            ],
            'openapi_context' => ['summary' => 'Récupérer un modèle de poubelle', 'description' => 'Récupérer un modèle de poubelle', 'tags' => ['Modèle de poubelle']],
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['wastecontainermodel.write']
            ],
            'security' => 'is_granted("ROLE_ADMIN")',
            'openapi_context' => ['summary' => 'Modifier un modèle de poubelle', 'description' => 'Modifier un modèle de poubelle', 'tags' => ['Modèle de poubelle']],
        ],
        'delete' => [
            'method' => 'DELETE',
            'security' => 'is_granted("ROLE_ADMIN")',
            'openapi_context' => ['summary' => 'Supprimer un modèle de poubelle', 'description' => 'Supprimer un modèle de poubelle', 'tags' => ['Modèle de poubelle']],
        ]
    ],denormalizationContext: ['groups' => ['wastecontainermodel.write']], normalizationContext: ['groups' => ['wastecontainermodel.read']]
)]
class WasteContainerModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['wastecontainermodel.read', 'waste.read', 'passage.read'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write', 'waste.read', 'passage.read'])]
    #[Assert\NotBlank(message: 'Le nom est obligatoire')]
    #[Assert\Length(max: 255, maxMessage: 'Le nom ne peut pas dépasser {{ limit }} caractères')]
    #[Assert\Type(type: 'string', message: 'Le nom doit être une chaîne de caractères')]
    private ?string $modelName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write', 'waste.read', 'passage.read'])]
    #[Assert\Length(max: 255, maxMessage: 'Le manuFacturer ne peut pas dépasser {{ limit }} caractères')]
    #[Assert\Type(type: 'string', message: 'Le manuFacturer doit être une chaîne de caractères')]
    private ?string $modelManuFacturer = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write', 'waste.read', 'passage.read'])]
    #[Assert\Type(type: 'integer', message: 'La capacité doit être un entier')]
    private ?int $modelUsefulCapacity = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write', 'waste.read', 'passage.read'])]
    #[Assert\Length(max: 255, maxMessage: 'Le type de modèle ne peut pas dépasser {{ limit }} caractères')]
    #[Assert\Type(type: 'string', message: 'Le type de modèle doit être une chaîne de caractères')]
    private ?string $modelType = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['wastecontainermodel.read'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['wastecontainermodel.read'])]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'wasteContainerModel', targetEntity: Waste::class)]
    private Collection $wasteContainerModel;

    public function __construct()
    {
        $this->wasteContainerModel = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelName(): ?string
    {
        return $this->modelName;
    }

    public function setModelName(?string $modelName): self
    {
        $this->modelName = $modelName;

        return $this;
    }

    public function getModelManuFacturer(): ?string
    {
        return $this->modelManuFacturer;
    }

    public function setModelManuFacturer(?string $modelManuFacturer): self
    {
        $this->modelManuFacturer = $modelManuFacturer;

        return $this;
    }

    public function getModelUsefulCapacity(): ?int
    {
        return $this->modelUsefulCapacity;
    }

    public function setModelUsefulCapacity(?int $modelUsefulCapacity): self
    {
        $this->modelUsefulCapacity = $modelUsefulCapacity;

        return $this;
    }

    public function getModelType(): ?string
    {
        return $this->modelType;
    }

    public function setModelType(?string $modelType): self
    {
        $this->modelType = $modelType;

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
    public function getWasteContainerModel(): Collection
    {
        return $this->wasteContainerModel;
    }

    public function addWasteContainerModel(Waste $wasteContainerModel): self
    {
        if (!$this->wasteContainerModel->contains($wasteContainerModel)) {
            $this->wasteContainerModel->add($wasteContainerModel);
            $wasteContainerModel->setWasteContainerModel($this);
        }

        return $this;
    }

    public function removeWasteContainerModel(Waste $wasteContainerModel): self
    {
        if ($this->wasteContainerModel->removeElement($wasteContainerModel)) {
            // set the owning side to null (unless already changed)
            if ($wasteContainerModel->getWasteContainerModel() === $this) {
                $wasteContainerModel->setWasteContainerModel(null);
            }
        }

        return $this;
    }
}
