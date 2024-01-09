<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'createdQuizzes')]
    private ?User $creator = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: Question::class)]
    private Collection $questions;

    #[ORM\ManyToOne(inversedBy: 'quizzes')]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: Flame::class)]
    private Collection $flameCount;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->flameCount = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Flame>
     */
    public function getFlameCount(): Collection
    {
        return $this->flameCount;
    }

    public function addFlameCount(Flame $flameCount): static
    {
        if (!$this->flameCount->contains($flameCount)) {
            $this->flameCount->add($flameCount);
            $flameCount->setQuiz($this);
        }

        return $this;
    }

    public function removeFlameCount(Flame $flameCount): static
    {
        if ($this->flameCount->removeElement($flameCount)) {
            // set the owning side to null (unless already changed)
            if ($flameCount->getQuiz() === $this) {
                $flameCount->setQuiz(null);
            }
        }

        return $this;
    }
}
