<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: Quiz::class)]
    private Collection $createdQuizzes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Flame::class)]
    private Collection $givenFlames;

    public function __construct()
    {
        $this->createdQuizzes = new ArrayCollection();
        $this->givenFlames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Quiz>
     */
    public function getCreatedQuizzes(): Collection
    {
        return $this->createdQuizzes;
    }

    public function addCreatedQuiz(Quiz $createdQuiz): static
    {
        if (!$this->createdQuizzes->contains($createdQuiz)) {
            $this->createdQuizzes->add($createdQuiz);
            $createdQuiz->setCreator($this);
        }

        return $this;
    }

    public function removeCreatedQuiz(Quiz $createdQuiz): static
    {
        if ($this->createdQuizzes->removeElement($createdQuiz)) {
            // set the owning side to null (unless already changed)
            if ($createdQuiz->getCreator() === $this) {
                $createdQuiz->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Flame>
     */
    public function getGivenFlames(): Collection
    {
        return $this->givenFlames;
    }

    public function addGivenFlame(Flame $givenFlame): static
    {
        if (!$this->givenFlames->contains($givenFlame)) {
            $this->givenFlames->add($givenFlame);
            $givenFlame->setUser($this);
        }

        return $this;
    }

    public function removeGivenFlame(Flame $givenFlame): static
    {
        if ($this->givenFlames->removeElement($givenFlame)) {
            // set the owning side to null (unless already changed)
            if ($givenFlame->getUser() === $this) {
                $givenFlame->setUser(null);
            }
        }

        return $this;
    }
}
