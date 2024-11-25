<?php

namespace App\Entity;

use App\Repository\SettingsOptionRepository;
use App\Utils\DateUtilsInterface;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SettingsOptionRepository::class)]
#[UniqueEntity(fields: ['name'], message: 'There is already an account with this name')]
#[ORM\HasLifecycleCallbacks]
class SettingsOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $value = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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
    public function OnInitialSave(){
        $this->createAt = new DateTimeImmutable('now');
        if($this->getName() ===null){
            $this->setName($this->getLabel().$this->lang);
        }
    }
    #[ORM\PreUpdate]
    public function OnUpdate(){
        $this->updateAt = new DateTimeImmutable('now');
        if($this->getName() ===null){
            $this->setName($this->getLabel().$this->lang);
        }
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
}