<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandRepository::class)
 */
class Command
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $createDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbCommande;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $validationDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $devis;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commands")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commands")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity=ServicesDetail::class, inversedBy="commands")
     */
    private $servicesDetail;

    public function __construct()
    {
        $this->servicesDetail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateDate(): ?\DateTimeImmutable
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTimeImmutable $createDate): self
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getNbCommande(): ?int
    {
        return $this->nbCommande;
    }

    public function setNbCommande(int $nbCommande): self
    {
        $this->nbCommande = $nbCommande;

        return $this;
    }

    public function getValidationDate(): ?\DateTimeInterface
    {
        return $this->validationDate;
    }

    public function setValidationDate(?\DateTimeInterface $validationDate): self
    {
        $this->validationDate = $validationDate;

        return $this;
    }

    public function getDevis(): ?int
    {
        return $this->devis;
    }

    public function setDevis(int $devis): self
    {
        $this->devis = $devis;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, ServicesDetail>
     */
    public function getServicesDetail(): Collection
    {
        return $this->servicesDetail;
    }

    public function addServicesDetail(ServicesDetail $servicesDetail): self
    {
        if (!$this->servicesDetail->contains($servicesDetail)) {
            $this->servicesDetail[] = $servicesDetail;
        }

        return $this;
    }

    public function removeServicesDetail(ServicesDetail $servicesDetail): self
    {
        $this->servicesDetail->removeElement($servicesDetail);

        return $this;
    }
}
