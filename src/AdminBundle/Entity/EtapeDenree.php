<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtapeDenree
 *
 * @ORM\Table(name="gf_etape_denree")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\EtapeDenreeRepository")
 */
class EtapeDenree
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="quantite", type="float")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\EtapeProduit", inversedBy="etapeDenrees")
     * @ORM\JoinColumn(name="etape", referencedColumnName="id",nullable=true)
    */
    private $etape;
   
    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Denree", inversedBy="etapeDenrees")
     * @ORM\JoinColumn(name="denree", referencedColumnName="id",nullable=true)
    */
    private $denree;

   


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantite
     *
     * @param float $quantite
     *
     * @return EtapeDenree
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return float
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set etape
     *
     * @param \AdminBundle\Entity\EtapeProduit $etape
     *
     * @return EtapeDenree
     */
    public function setEtape(\AdminBundle\Entity\EtapeProduit $etape = null)
    {
        $this->etape = $etape;
    
        return $this;
    }

    /**
     * Get etape
     *
     * @return \AdminBundle\Entity\EtapeProduit
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set denree
     *
     * @param \AdminBundle\Entity\Denree $denree
     *
     * @return EtapeDenree
     */
    public function setDenree(\AdminBundle\Entity\Denree $denree = null)
    {
        $this->denree = $denree;
    
        return $this;
    }

    /**
     * Get denree
     *
     * @return \AdminBundle\Entity\Denree
     */
    public function getDenree()
    {
        return $this->denree;
    }
}
