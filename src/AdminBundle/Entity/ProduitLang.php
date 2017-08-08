<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="gf_produit_lang")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ProduitRepository")
 */
class ProduitLang
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionApport", type="text", nullable=true)
     */
    private $descriptionApport;
    
     /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Lang")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id",nullable=true)
    */
    private $lang;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dressageType", type="string", length=255, nullable=true)
     */
    private $dressageType;

    /**
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="produitLang",cascade={"persist"})
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    private $produit;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return ProduitLang
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProduitLang
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set descriptionApport
     *
     * @param string $descriptionApport
     *
     * @return ProduitLang
     */
    public function setDescriptionApport($descriptionApport)
    {
        $this->descriptionApport = $descriptionApport;
    
        return $this;
    }

    /**
     * Get descriptionApport
     *
     * @return string
     */
    public function getDescriptionApport()
    {
        return $this->descriptionApport;
    }

    /**
     * Set dressageType
     *
     * @param string $dressageType
     *
     * @return ProduitLang
     */
    public function setDressageType($dressageType)
    {
        $this->dressageType = $dressageType;
    
        return $this;
    }

    /**
     * Get dressageType
     *
     * @return string
     */
    public function getDressageType()
    {
        return $this->dressageType;
    }

    
    /**
     * Set lang
     *
     * @param \AdminBundle\Entity\Lang $lang
     *
     * @return ProduitLang
     */
    public function setLang(\AdminBundle\Entity\Lang $lang = null)
    {
        $this->lang = $lang;
    
        return $this;
    }

    /**
     * Get lang
     *
     * @return \AdminBundle\Entity\Lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set produit
     *
     * @param \AdminBundle\Entity\Produit $produit
     *
     * @return ProduitLang
     */
    public function setProduit(\AdminBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;
    
        return $this;
    }

    /**
     * Get produit
     *
     * @return \AdminBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }
}
