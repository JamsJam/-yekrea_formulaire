<?php

namespace App\Entity;

use App\Repository\CommandRepository;
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
}
