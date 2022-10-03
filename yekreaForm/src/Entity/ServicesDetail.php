<?php

namespace App\Entity;

use App\Repository\ServicesDetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ServicesDetailRepository::class)
 */
class ServicesDetail
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
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     *  @Assert\Regex(
    *     pattern="/\d/",
    *     match=true,
    *     message="Veuillez entrer un prix valide")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Assert\NotBlank
     */
    private $date_creation;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="servicesDetails", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $services;

    /**
     * @ORM\ManyToMany(targetEntity=Command::class, mappedBy="servicesDetail")
     */
    private $commands;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixMin;

    public function __construct()
    {
        $this->materiel = new ArrayCollection();
        $this->commands = new ArrayCollection();
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

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeImmutable $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getServices(): ?Services
    {
        return $this->services;
    }

    public function setServices(?Services $services): self
    {
        $this->services = $services;

        return $this;
    }

    /**
     * @return Collection<int, Command>
     */
    public function getCommands(): Collection
    {
        return $this->commands;
    }

    public function addCommand(Command $command): self
    {
        if (!$this->commands->contains($command)) {
            $this->commands[] = $command;
            $command->addServicesDetail($this);
        }

        return $this;
    }

    public function removeCommand(Command $command): self
    {
        if ($this->commands->removeElement($command)) {
            $command->removeServicesDetail($this);
        }

        return $this;
    }

    public function getPrixMin(): ?float
    {
        return $this->prixMin;
    }

    public function setPrixMin(?float $prixMin): self
    {
        $this->prixMin = $prixMin;

        return $this;
    }
}
