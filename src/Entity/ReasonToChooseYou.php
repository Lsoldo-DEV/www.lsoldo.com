<?php

namespace App\Entity;

use App\Repository\ReasonToChooseYouRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReasonToChooseYouRepository::class)]
class ReasonToChooseYou
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $lang = null;

    #[ORM\ManyToOne(inversedBy: 'reasons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ServiceDescription $serviceDescription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): static
    {
        $this->lang = $lang;

        return $this;
    }

    public function getServiceDescription(): ?ServiceDescription
    {
        return $this->serviceDescription;
    }

    public function setServiceDescription(?ServiceDescription $serviceDescription): static
    {
        $this->serviceDescription = $serviceDescription;

        return $this;
    }
}
