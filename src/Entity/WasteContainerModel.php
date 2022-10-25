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
        'GET',
        'POST' => [
            'method' => 'POST',
            'path' => '/waste_container_models/add'
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['wastecontainermodel.read']
            ]
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['wastecontainermodel.write']
            ]
        ],
        'delete'
    ]
)]
class WasteContainerModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['wastecontainermodel.read'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write'])]
    #[Assert\NotBlank(message: 'Le nom est obligatoire')]
    private ?string $modelName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write'])]
    private ?string $modelManuFacturer = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write'])]
    private ?int $modelUsefulCapacity = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write'])]
    private ?string $modelType = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write'])]
    #[Assert\DateTime]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write'])]
    #[Assert\DateTime]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'wasteContainerModel', targetEntity: Waste::class)]
    #[Groups(['wastecontainermodel.read', 'wastecontainermodel.write'])]
    private Collection $wasteContainerModel;

    public function __construct()
    {
        $this->wasteContainerModel = new ArrayCollection();
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
