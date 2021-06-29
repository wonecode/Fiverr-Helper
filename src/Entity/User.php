<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Help::class, mappedBy="assist")
     */
    private $assists;

    /**
     * @ORM\OneToMany(targetEntity=Help::class, mappedBy="applicant", orphanRemoval=true)
     */
    private $helpRequests;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="integer")
     */
    private $experience;

    /**
     * @ORM\ManyToMany(targetEntity=Quest::class, inversedBy="users")
     */
    private $finishedQuest;

    /**
     * @ORM\ManyToMany(targetEntity=Badge::class, inversedBy="users")
     */
    private $badge;

    public function __construct()
    {
        $this->helps = new ArrayCollection();
        $this->helpRequests = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->finishedQuest = new ArrayCollection();
        $this->badge = new ArrayCollection();
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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Help[]
     */
    public function getAssists(): Collection
    {
        return $this->assists;
    }

    public function addAssist(Help $help): self
    {
        if (!$this->helps->contains($help)) {
            $this->assists[] = $help;
            $help->addAssist($this);
        }

        return $this;
    }

    public function removeAssist(Help $help): self
    {
        if ($this->assists->removeElement($help)) {
            $help->removeAssist($this);
        }

        return $this;
    }

    /**
     * @return Collection|Help[]
     */
    public function getHelpRequests(): Collection
    {
        return $this->helpRequests;
    }

    public function addHelpRequest(Help $helpRequest): self
    {
        if (!$this->helpRequests->contains($helpRequest)) {
            $this->helpRequests[] = $helpRequest;
            $helpRequest->setApplicant($this);
        }

        return $this;
    }

    public function removeHelpRequest(Help $helpRequest): self
    {
        if ($this->helpRequests->removeElement($helpRequest)) {
            // set the owning side to null (unless already changed)
            if ($helpRequest->getApplicant() === $this) {
                $helpRequest->setApplicant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return Collection|Quest[]
     */
    public function getFinishedQuest(): Collection
    {
        return $this->finishedQuest;
    }

    public function addFinishedQuest(Quest $finishedQuest): self
    {
        if (!$this->finishedQuest->contains($finishedQuest)) {
            $this->finishedQuest[] = $finishedQuest;
        }

        return $this;
    }

    public function removeFinishedQuest(Quest $finishedQuest): self
    {
        $this->finishedQuest->removeElement($finishedQuest);

        return $this;
    }

    /**
     * @return Collection|Badge[]
     */
    public function getBadge(): Collection
    {
        return $this->badge;
    }

    public function addBadge(Badge $badge): self
    {
        if (!$this->badge->contains($badge)) {
            $this->badge[] = $badge;
        }

        return $this;
    }

    public function removeBadge(Badge $badge): self
    {
        $this->badge->removeElement($badge);

        return $this;
    }
}
