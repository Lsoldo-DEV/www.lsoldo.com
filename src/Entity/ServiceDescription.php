<?php

namespace App\Entity;

use App\Repository\ServiceDescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ServiceDescriptionRepository::class)]
class ServiceDescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $lang = null;
    #[ORM\Column]
    private \DateTimeImmutable $publishedAt;
    #[ORM\Column(type: Types::STRING)]
    #[Assert\NotBlank]
    private ?string $title = null;
    #[ORM\Column(type: Types::STRING)]
    #[Assert\NotBlank(message: 'description.blank_summary')]
    #[Assert\Length(max: 255)]
    private ?string $summary = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'description.blank_content')]
    #[Assert\Length(min: 10, minMessage: 'description.too_short_content')]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $top_image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $end_image = null;

    /**
     * @var Collection<int, ReasonToChooseYou>
     */
    #[ORM\OneToMany(targetEntity: ReasonToChooseYou::class, mappedBy: 'serviceDescription')]
    private Collection $reasons;

    #[ORM\ManyToOne(inversedBy: 'description')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $service = null;

    public function __construct()
    {
        $this->reasons = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }
    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getPublishedAt(): \DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): void
    {
        $this->summary = $summary;
    }

    public function getTopImage(): ?string
    {
        return $this->top_image;
    }

    public function setTopImage(string $top_image): static
    {
        $this->top_image = $top_image;

        return $this;
    }

    public function getEndImage(): ?string
    {
        return $this->end_image;
    }

    public function setEndImage(?string $end_image): static
    {
        $this->end_image = $end_image;

        return $this;
    }

    /**
     * @return Collection<int, ReasonToChooseYou>
     */
    public function getReasons(): Collection
    {
        return $this->reasons;
    }

    public function addReason(ReasonToChooseYou $reason): static
    {
        if (!$this->reasons->contains($reason)) {
            $this->reasons->add($reason);
            $reason->setServiceDescription($this);
        }

        return $this;
    }

    public function removeReason(ReasonToChooseYou $reason): static
    {
        if ($this->reasons->removeElement($reason)) {
            // set the owning side to null (unless already changed)
            if ($reason->getServiceDescription() === $this) {
                $reason->setServiceDescription(null);
            }
        }

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
}
