<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\ComuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ComuneRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GET' => [
          'method' => 'GET',
          'path' => '/communes'
        ],
        'POST' => [
            'method' => 'POST',
            'path' => '/communes/add'
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'path' => '/communes/{id}',
            'normalization_context' => [
                'groups' => ['commune.read']
            ]
        ],
        'PUT' => [
            'method' => 'PUT',
            'path' => '/communes/{id}',
            'normalization_context' => [
                'groups' => ['commune.write']
            ]
        ],
        'delete' => [
            'method' => 'DELETE',
            'path' => '/communes/{id}'
        ]
    ]
)]
class Comune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['commune.read'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['commune.read', 'commune.write'])]
    #[Assert\NotBlank(message: 'Le nom est obligatoire')]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['commune.read', 'commune.write'])]
    private ?int $localisationPostalCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['commune.read', 'commune.write'])]
    private ?string $localisationCountry = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['commune.read', 'commune.write'])]
    private ?int $localisationTownId = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['commune.read'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['commune.read'])]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'comune', targetEntity: RecyclingCenter::class)]
    #[Groups(['commune.read', 'commune.write'])]
    private Collection $recyclingCenters;

    #[ORM\OneToMany(mappedBy: 'comune', targetEntity: Secteur::class)]
    #[Groups(['commune.read', 'commune.write'])]
    private Collection $secteurs;

    #[ORM\OneToMany(mappedBy: 'localisationCityId', targetEntity: Waste::class)]
    #[Groups(['commune.read', 'commune.write'])]
    private Collection $wasteCity;

    public function __construct()
    {
        $this->recyclingCenters = new ArrayCollection();
        $this->secteurs = new ArrayCollection();
        $this->wasteCity = new ArrayCollection();
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

    public function getLocalisationPostalCode(): ?int
    {
        return $this->localisationPostalCode;
    }

    public function setLocalisationPostalCode(?int $localisationPostalCode): self
    {
        $this->localisationPostalCode = $localisationPostalCode;

        return $this;
    }

    public function getLocalisationCountry(): ?string
    {
        return $this->localisationCountry;
    }

    public function setLocalisationCountry(?string $localisationCountry): self
    {
        $this->localisationCountry = $localisationCountry;

        return $this;
    }

    public function getLocalisationTownId(): ?int
    {
        return $this->localisationTownId;
    }

    public function setLocalisationTownId(?int $localisationTownId): self
    {
        $this->localisationTownId = $localisationTownId;

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
     * @return Collection<int, RecyclingCenter>
     */
    public function getRecyclingCenters(): Collection
    {
        return $this->recyclingCenters;
    }

    public function addRecyclingCenter(RecyclingCenter $recyclingCenter): self
    {
        if (!$this->recyclingCenters->contains($recyclingCenter)) {
            $this->recyclingCenters->add($recyclingCenter);
            $recyclingCenter->setComuneId($this);
        }

        return $this;
    }

    public function removeRecyclingCenter(RecyclingCenter $recyclingCenter): self
    {
        if ($this->recyclingCenters->removeElement($recyclingCenter)) {
            // set the owning side to null (unless already changed)
            if ($recyclingCenter->getComuneId() === $this) {
                $recyclingCenter->setComuneId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Secteur>
     */
    public function getSecteurs(): Collection
    {
        return $this->secteurs;
    }

    public function addSecteur(Secteur $secteur): self
    {
        if (!$this->secteurs->contains($secteur)) {
            $this->secteurs->add($secteur);
            $secteur->setComuneId($this);
        }

        return $this;
    }

    public function removeSecteur(Secteur $secteur): self
    {
        if ($this->secteurs->removeElement($secteur)) {
            // set the owning side to null (unless already changed)
            if ($secteur->getComuneId() === $this) {
                $secteur->setComuneId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Waste>
     */
    public function getWasteCity(): Collection
    {
        return $this->wasteCity;
    }

    public function addWasteCity(Waste $wasteCity): self
    {
        if (!$this->wasteCity->contains($wasteCity)) {
            $this->wasteCity->add($wasteCity);
            $wasteCity->setLocalisationCityId($this);
        }

        return $this;
    }

    public function removeWasteCity(Waste $wasteCity): self
    {
        if ($this->wasteCity->removeElement($wasteCity)) {
            // set the owning side to null (unless already changed)
            if ($wasteCity->getLocalisationCityId() === $this) {
                $wasteCity->setLocalisationCityId(null);
            }
        }

        return $this;
    }
}
