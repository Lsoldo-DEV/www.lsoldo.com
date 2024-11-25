<?php

namespace App\Entity;

use App\Repository\SocialLinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocialLinkRepository::class)]
class SocialLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $facebookPage = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $tweeterPage = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $instagramPage = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $whatsapp = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $other = null;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $editedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFacebookPage(): ?string
    {
        return $this->facebookPage;
    }

    public function setFacebookPage(?string $facebookPage): self
    {
        $this->facebookPage = $facebookPage;

        return $this;
    }

    public function getTweeterPage(): ?string
    {
        return $this->tweeterPage;
    }

    public function setTweeterPage(?string $tweeterPage): self
    {
        $this->tweeterPage = $tweeterPage;

        return $this;
    }

    public function getInstagramPage(): ?string
    {
        return $this->instagramPage;
    }

    public function setInstagramPage(?string $instagramPage): self
    {
        $this->instagramPage = $instagramPage;

        return $this;
    }

    public function getWhatsapp(): ?int
    {
        return $this->whatsapp;
    }

    public function setWhatsapp(?int $whatsapp): self
    {
        $this->whatsapp = $whatsapp;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(?string $other): self
    {
        $this->other = $other;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEditedAt(): ?\DateTimeInterface
    {
        return $this->editedAt;
    }

    public function setEditedAt(?\DateTimeInterface $editedAt): self
    {
        $this->editedAt = $editedAt;

        return $this;
    }

    public function __toString(): string
    {
        return $this->id . "-" . $this->createdAt->format('Y-m-d H:i:s');
    }
}
