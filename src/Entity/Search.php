<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Search  
{
    /**
     * @var int|null
     */

    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min=10,max=400)
     */
    private $minSurface;

    /**
     * @param int|null $maxPrice
     * @return Search
     * @Assert\Range(min=500,max=1000000)
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

}
