<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     *  @Assert\Regex(
     *     pattern="/\d/",
     *     match=False,
     *     message="Le service ne doit pas contenir de nombre")
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=ServicesDetail::class, mappedBy="services", orphanRemoval=true)
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
            $servicesDetail->setServices($this);
        }

        return $this;
    }

    public function removeServicesDetail(ServicesDetail $servicesDetail): self
    {
        if ($this->servicesDetails->removeElement($servicesDetail)) {
            // set the owning side to null (unless already changed)
            if ($servicesDetail->getServices() === $this) {
                $servicesDetail->setServices(null);
            }
        }

        return $this;
    }
}
