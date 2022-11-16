<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    collectionOperations: [
        'GET',
        'POST' => [
            'method' => 'POST',
            'path' => '/users/add',
            'normalization_context' => [
                'groups' => ['user.write']
            ],
        ]
    ],
    itemOperations: [
        'GET' => [
            'method' => 'GET',
            'normalization_context' => [
                'groups' => ['user.read']
            ],
            'security' => 'is_granted("ROLE_ADMIN") or object == user'
        ],
        'PUT' => [
            'method' => 'PUT',
            'normalization_context' => [
                'groups' => ['user.write']
            ],
            'security' => 'is_granted("ROLE_ADMIN") or object == user'
        ],
        'delete' => [
            'method' => 'DELETE',
            'security' => 'is_granted("ROLE_ADMIN")'
        ]
    ],denormalizationContext: ['groups' => ['user.write']], normalizationContext: ['groups' => ['user.read']]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user.read', 'chat.read', 'report.read', 'chat.write'])]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['user.read', 'user.write', 'chat.read', 'report.read'])]
    #[Assert\NotBlank(message: 'L\'email est obligatoire')]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide.'
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank(
        message: 'Le mot de passe ne peut pas être vide.'
    )]
    #[Assert\Length(
        min: 8,
        minMessage: 'Le mot de passe doit contenir au moins {{ limit }} caractères.'
    )]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user.read', 'user.write', 'chat.read', 'report.read'])]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Le prénom doit contenir au moins {{ limit }} caractères.',
        maxMessage: 'Le prénom ne peut pas contenir plus de {{ limit }} caractères.'
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Le prénom {{ value }} n\'est pas valide.'
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user.read', 'user.write', 'chat.read', 'report.read'])]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères.',
        maxMessage: 'Le nom ne peut pas contenir plus de {{ limit }} caractères.'
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Le nom {{ value }} n\'est pas valide.'
    )]
    private ?string $firstName = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['user.read', 'user.write'])]
    #[Assert\Type(type: 'integer', message: 'L\'âge {{ value }} n\'est pas valide.')]
    private ?int $age = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['user.read', 'user.write', 'chat.read', 'report.read'])]
    #[Assert\Type(
        type: 'string',
        message: 'L\'image de profil {{ value }} n\'est pas valide.'
    )]
    private ?string $imgProfile = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['user.read', 'user.write', 'chat.read', 'report.read'])]
    #[Assert\Type(type: 'boolean', message: 'Le isBan {{ value }} n\'est pas valide.')]
    private ?bool $isBan = null;

    #[ORM\Column]
    #[Groups(['user.read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['user.read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Chat::class)]
    #[Groups(['user.read'])]
    private Collection $chats;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Report::class)]
    #[Groups(['user.read'])]
    private Collection $reports;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
         $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getImgProfile(): ?string
    {
        return $this->imgProfile;
    }

    public function setImgProfile(?string $imgProfile): self
    {
        $this->imgProfile = $imgProfile;

        return $this;
    }

    public function isIsBan(): ?bool
    {
        return $this->isBan;
    }

    public function setIsBan(?bool $isBan): self
    {
        $this->isBan = $isBan;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Chat>
     */
    public function getChats(): Collection
    {
        return $this->chats;
    }

    public function addChat(Chat $chat): self
    {
        if (!$this->chats->contains($chat)) {
            $this->chats->add($chat);
            $chat->setUserId($this);
        }

        return $this;
    }

    public function removeChat(Chat $chat): self
    {
        if ($this->chats->removeElement($chat)) {
            // set the owning side to null (unless already changed)
            if ($chat->getUserId() === $this) {
                $chat->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Report>
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports->add($report);
            $report->setUserId($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->removeElement($report)) {
            // set the owning side to null (unless already changed)
            if ($report->getUserId() === $this) {
                $report->setUserId(null);
            }
        }

        return $this;
    }
}
