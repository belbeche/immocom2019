<?php

namespace App\Entity;

use App\Entity\Annonce;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OptionAnnonceRepository")
 */
class OptionAnnonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Annonce", mappedBy="optionAnnonces")
     */
    private $annonces;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Appartement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Maison;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Garage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Parking;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Commerce;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $Annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->contains($annonce)) {
            $this->annonces->removeElement($annonce);
        }

        return $this;
    }

    public function getAppartement(): ?string
    {
        return $this->Appartement;
    }

    public function setAppartement(string $Appartement): self
    {
        $this->Appartement = $Appartement;

        return $this;
    }

    public function getMaison(): ?string
    {
        return $this->Maison;
    }

    public function setMaison(?string $Maison): self
    {
        $this->Maison = $Maison;

        return $this;
    }

    public function getGarage(): ?string
    {
        return $this->Garage;
    }

    public function setGarage(?string $Garage): self
    {
        $this->Garage = $Garage;

        return $this;
    }

    public function getParking(): ?string
    {
        return $this->Parking;
    }

    public function setParking(?string $Parking): self
    {
        $this->Parking = $Parking;

        return $this;
    }

    public function getCommerce(): ?string
    {
        return $this->Commerce;
    }

    public function setCommerce(?string $Commerce): self
    {
        $this->Commerce = $Commerce;

        return $this;
    }
}
