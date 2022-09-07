<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielRepository::class)
 */
class Materiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToMany(targetEntity=ServicesDetail::class, mappedBy="materiel")
     */
    private $servicesDetails;

    public function __construct()
    {
        $this->servicesDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, ServicesDetail>
     */
    public function getServicesDetails(): Collection
    {
        return $this->servicesDetails;
    }

    public function addServicesDetail(ServicesDetail $servicesDetail): self
    {
        if (!$this->servicesDetails->contains($servicesDetail)) {
            $this->servicesDetails[] = $servicesDetail;
            $servicesDetail->addMateriel($this);
        }

        return $this;
    }

    public function removeServicesDetail(ServicesDetail $servicesDetail): self
    {
        if ($this->servicesDetails->removeElement($servicesDetail)) {
            $servicesDetail->removeMateriel($this);
        }

        return $this;
    }
}
