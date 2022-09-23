<?php

namespace App\Entity;

use App\Repository\PassageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassageRepository::class)]
class Passage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $hours = null;

    #[ORM\ManyToOne(inversedBy: 'passages')]
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
