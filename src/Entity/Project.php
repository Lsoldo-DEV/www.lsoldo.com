<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $briefDescription = null;

    #[ORM\Column(type: 'text')]
    private ?string $fullDescription = null;

    #[ORM\Column(type: 'json')]
    private array $technologies = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $projectLink = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: ProjectFile::class, inversedBy: 'projects')]
    private Collection $projectFiles;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $lang = null;
    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class)]
    private Collection $tags;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $clientName = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?Service $service = null;

    #[ORM\Column(nullable: true)]
    private ?\DateInterval $duration = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = null;
        $this->projectFiles = new ArrayCollection();
        $this->tags = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBriefDescription(): ?string
    {
        return $this->briefDescription;
    }

    public function setBriefDescription(?string $briefDescription): self
    {
        $this->briefDescription = $briefDescription;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }



    public function getTechnologies(): array
    {
        return $this->technologies;
    }

    public function setTechnologies(array $technologies): self
    {
        $this->technologies = $technologies;

        return $this;
    }


    /**
     * @return Collection<int, ProjectFile>
     */
    public function getProjectFiles(): Collection
    {
        return $this->projectFiles;
    }

    public function addProjectFile(ProjectFile $projectFile): static
    {
        if (!$this->projectFiles->contains($projectFile)) {
            $this->projectFiles->add($projectFile);
        }

        return $this;
    }

    public function removeProjectFile(ProjectFile $projectFile): static
    {
        $this->projectFiles->removeElement($projectFile);

        return $this;
    }

    public function getFirstProjectFile(): ?ProjectFile
    {
        if ($this->projectFiles->isEmpty()) {
            return null;
        }

        return $this->projectFiles->first();
    }
    public function getRemainingProjectFiles(): ArrayCollection
    {
        if ($this->projectFiles->count() <= 1) {
            return new ArrayCollection();
        }

        $remainingFiles = $this->projectFiles->slice(1);

        return new ArrayCollection($remainingFiles);
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(?string $lang): void
    {
        $this->lang = $lang;
    }
    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }
    public function getProjectLink(): ?string
    {
        return $this->projectLink;
    }

    public function setProjectLink(?string $projectLink): self
    {
        $this->projectLink = $projectLink;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(DateTimeImmutable $createAt): self
    {
        $this->createdAt = $createAt;

        return $this;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getTitle() ?? '';
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(?string $clientName): static
    {
        $this->clientName = $clientName;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getDuration(): ?\DateInterval
    {
        return $this->duration;
    }

    public function setDuration(?\DateInterval $duration): static
    {
        $this->duration = $duration;

        return $this;
    }
}
