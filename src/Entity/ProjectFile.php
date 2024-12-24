<?php

namespace App\Entity;

use App\Repository\ProjectFileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeImmutable;

#[ORM\Entity(repositoryClass: ProjectFileRepository::class)]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class ProjectFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumbnail = null;

    #[Vich\UploadableField(mapping: "project_thumbnail", fileNameProperty: "thumbnail")]
    #[Assert\Image(mimeTypes: ["image/jpeg", "image/jpg", "image/png"], allowLandscape: true, allowPortrait: true)]
    private $thumbnailFile;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videoUrl = null;

    #[Vich\UploadableField(mapping: "project_videos", fileNameProperty: "videoUrl")]
    #[Assert\File(
        maxSize: "2024M",
        extensions: ['mp4']
    )]
    private $videoFile;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'projectFiles')]
    private Collection $projects;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private DateTimeImmutable $updateAt;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addProjectFile($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            $project->removeProjectFile($this);
        }

        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(?string $videoUrl): self
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }
    /**
     * @return File|null
     */
    public function getVideoFile(): ?File
    {
        return $this->videoFile;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $videoFile
     */
    public function setVideoFile(?File $videoFile= null):void
    {
        $this->videoFile = $videoFile;

        if (null !== $videoFile) {
            $this->updateAt = new \DateTimeImmutable('now');
        }
        //$this->imageFile = null;
    }
    public function getCreateAt(): ?DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(DateTimeImmutable $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): ?DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }
    #[ORM\PrePersist]
    public function OnInitialSave()
    {
        $this->createAt = new DateTimeImmutable('now');
    }

    #[ORM\PreUpdate]
    public function OnUpdate()
    {
        $this->updateAt = new DateTimeImmutable('now');
    }
    /**
     * @return File|null
     */
    public function getThumbnailFile(): ?File
    {
        return $this->thumbnailFile;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $thumbnailFile
     */
    public function setThumbnailFile(?File $thumbnailFile= null):void
    {
        $this->thumbnailFile = $thumbnailFile;

        if (null !== $thumbnailFile) {
            $this->updateAt = new \DateTimeImmutable('now');
        }
        //$this->imageFile = null;
    }

    public function __toString(): string
    {
        return $this->name!=null?$this->name:$this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
