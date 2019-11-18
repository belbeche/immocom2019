<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class Search  
{
    /**
     * @var int|null
     */

    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(
     *      min = 10,
     *      max = 500,
     *      minMessage = "Vous devez avoir renseigné {{limite}} m² pour accéder aux contenus.",
     *      maxMessage = "Vous ne pouvez pas dépasser {{limite}} m²."
     * )
     */
    private $minSurface;

    /**
     * @var ArrayCollection
     */
    private $annonces;

    /**
     * @var string|null
     */
    private $location;

    /**
     * @var string|null
     */
    private $Achat;
    
    /**
     * @var integer
     */
    private $id;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

    /**
     * @param int|null $maxPrice
     * @return Search
     */
    function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return Search
     */
    public function setMaxPrice(int $maxPrice): Search
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }
    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
        
    }
    /**
     * @return int|null
     * @return Search
     */
    public function setMinSurface(int $minSurface): Search
    {
        $this->minSurface = $minSurface;
        return $this;
    }


    /**
     * Get the value of annonces
     *
     * @return  ArrayCollection
     */ 
    public function getAnnonces()
    {
        return $this->annonces;
    }

    /**
     * Set the value of annonces
     *
     * @param  ArrayCollection  $annonces
     *
     * @return  self
     */ 
    public function setAnnonces(ArrayCollection $annonces)
    {
        $this->annonces = $annonces;

        return $this;
    }

    /**
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */ 
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of Achat
     */ 
    public function getAchat()
    {
        return $this->Achat;
    }

    /**
     * Set the value of Achat
     *
     * @return  self
     */ 
    public function setAchat($Achat)
    {
        $this->Achat = $Achat;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  integer  $id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
