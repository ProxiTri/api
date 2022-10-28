<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\ChatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GET',
        'POST' => [
            'method' => 'POST',
            'path' => '/chats/add'
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['chat.read']
            ]
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['chat.write']
            ],
            'security' => 'is_granted("ROLE_ADMIN")'
        ],
        'delete' => [
            'method' => 'DELETE',
            'security' => 'is_granted("ROLE_ADMIN")'
        ]
    ],denormalizationContext: ['groups' => ['chat.write']], normalizationContext: ['groups' => ['chat.read']]
)]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['chat.read'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'chats')]
    #[Groups(['chat.read', 'chat.write'])]
    #[Assert\NotBlank(message: 'L\'utilisateur est obligatoire')]
    private ?User $user = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['chat.read', 'chat.write'])]
    #[Assert\NotBlank(message: 'Le message est obligatoire')]
    private ?string $message = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_report = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['chat.read'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    #[Groups(['chat.read'])]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function isIsReport(): ?bool
    {
        return $this->is_report;
    }

    public function setIsReport(?bool $is_report): self
    {
        $this->is_report = $is_report;

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
