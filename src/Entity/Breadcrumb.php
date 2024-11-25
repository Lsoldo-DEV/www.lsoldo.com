<?php

namespace App\Entity;

use App\Repository\BreadcrumbRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

class Breadcrumb
{

    private ?int $id = null;

    private ArrayCollection $breadcrumbItems;

    private ?string $endRouteName = null;

    public function __construct(ArrayCollection $breadcrumbItems, string $endRouteName){
        $this->breadcrumbItems = $breadcrumbItems;
        $this->endRouteName = $endRouteName;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreadcrumbItems(): ArrayCollection
    {
        return $this->breadcrumbItems;
    }

    public function setBreadcrumbItems(ArrayCollection $breadcrumbItems): static
    {
        $this->breadcrumbItems = $breadcrumbItems;

        return $this;
    }

    public function getEndRouteName(): ?string
    {
        return $this->endRouteName;
    }

    public function setEndRouteName(string $endRouteName): static
    {
        $this->endRouteName = $endRouteName;

        return $this;
    }
}
