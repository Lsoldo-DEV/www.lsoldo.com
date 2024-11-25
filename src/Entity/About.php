<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
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
}
