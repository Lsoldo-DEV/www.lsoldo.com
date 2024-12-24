<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
#[ORM\HasLifecycleCallbacks]
class About
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $SubTitleMessage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $BodyTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $BodySubTitle = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $benefits = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $EndPageTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $EndPageText = null;

    #[ORM\Column(nullable: true)]
    private ?array $ServicesStats = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $lang = null;
    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $createAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $updateAt;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(?string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getSubTitleMessage(): ?string
    {
        return $this->SubTitleMessage;
    }

    public function setSubTitleMessage(?string $SubTitleMessage): static
    {
        $this->SubTitleMessage = $SubTitleMessage;

        return $this;
    }

    public function getBodyTitle(): ?string
    {
        return $this->BodyTitle;
    }

    public function setBodyTitle(?string $BodyTitle): static
    {
        $this->BodyTitle = $BodyTitle;

        return $this;
    }

    public function getBodySubTitle(): ?string
    {
        return $this->BodySubTitle;
    }

    public function setBodySubTitle(?string $BodySubTitle): static
    {
        $this->BodySubTitle = $BodySubTitle;

        return $this;
    }

    public function getBenefits(): ?array
    {
        return $this->benefits;
    }

    public function setBenefits(?array $benefits): static
    {
        $this->benefits = $benefits;

        return $this;
    }

    public function getEndPageTitle(): ?string
    {
        return $this->EndPageTitle;
    }

    public function setEndPageTitle(?string $EndPageTitle): static
    {
        $this->EndPageTitle = $EndPageTitle;

        return $this;
    }

    public function getEndPageText(): ?string
    {
        return $this->EndPageText;
    }

    public function setEndPageText(?string $EndPageText): static
    {
        $this->EndPageText = $EndPageText;

        return $this;
    }

    public function getServicesStats(): ?array
    {
        return $this->ServicesStats;
    }

    public function setServicesStats(?array $ServicesStats): static
    {
        $this->ServicesStats = $ServicesStats;

        return $this;
    }
    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(?string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }
    public function setCreateAt(DateTimeImmutable $createdAt): self
    {
        $this->createAt = $createdAt;

        return $this;
    }
    public function getCreateAt(): ?DateTimeImmutable
    {
        return $this->createAt;
    }

    public function getUpdateAt(): ?DateTimeImmutable
    {
        return $this->updateAt;
    }


    public function setUpdateAt(DateTimeImmutable $updatedAt): self
    {
        $this->updateAt = $updatedAt;

        return $this;
    }
    #[ORM\PrePersist]
    public function OnInitialSave(): void
    {
        $this->createAt = new DateTimeImmutable('now');

    }
    #[ORM\PreUpdate]
    public function OnUpdate(): void
    {
        $this->updateAt = new DateTimeImmutable('now');
    }

}
