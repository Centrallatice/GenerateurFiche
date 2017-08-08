<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Produit
 *
 * @ORM\Table(name="gf_produit")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\CategorieProduit", inversedBy="produits")
     * @ORM\JoinColumn(name="categorieProduit", referencedColumnName="id",nullable=true)
    */
    protected $categorieProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var float
     *
     * @ORM\Column(name="apportNutritionnelUnitaire", type="float", nullable=true)
     */
    private $apportNutritionnelUnitaire;

    
    /**
     * @var float
     *
     * @ORM\Column(name="coefficient", type="float", nullable=true)
     */
    private $coefficient;


    /**
     * @var string
     *
     * @ORM\Column(name="imageName", type="string", length=255, nullable=true)
     */
    private $imageName;
    
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;
    
    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\EtapeProduit",mappedBy="produit", cascade={"remove"})
     * @ORM\OrderBy({"ordre" = "ASC"})
    */
    private $etapes;
    
    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\ProduitLang", mappedBy="produit",cascade={"persist"}, fetch="EAGER")
     */
    private $produitLang;
    
    
    public function __construct() {
        $this->setDateCreation(new \DateTime());
    }

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
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Produit
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    
        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Produit
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set apportNutritionnelUnitaire
     *
     * @param float $apportNutritionnelUnitaire
     *
     * @return Produit
     */
    public function setApportNutritionnelUnitaire($apportNutritionnelUnitaire)
    {
        $this->apportNutritionnelUnitaire = $apportNutritionnelUnitaire;
    
        return $this;
    }

    /**
     * Get apportNutritionnelUnitaire
     *
     * @return float
     */
    public function getApportNutritionnelUnitaire()
    {
        return $this->apportNutritionnelUnitaire;
    }

    /**
     * Set coefficient
     *
     * @param float $coefficient
     *
     * @return Produit
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    
        return $this;
    }

    /**
     * Get coefficient
     *
     * @return float
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Produit
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    
        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Produit
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add etape
     *
     * @param \AdminBundle\Entity\EtapeProduit $etape
     *
     * @return Produit
     */
    public function addEtape(\AdminBundle\Entity\EtapeProduit $etape)
    {
        $this->etapes[] = $etape;
    
        return $this;
    }

    /**
     * Remove etape
     *
     * @param \AdminBundle\Entity\EtapeProduit $etape
     */
    public function removeEtape(\AdminBundle\Entity\EtapeProduit $etape)
    {
        $this->etapes->removeElement($etape);
    }

    /**
     * Get etapes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapes()
    {
        return $this->etapes;
    }

    /**
     * Add produitLang
     *
     * @param \AdminBundle\Entity\ProduitLang $produitLang
     *
     * @return Produit
     */
    public function addProduitLang(\AdminBundle\Entity\ProduitLang $produitLang)
    {
        $this->produitLang[] = $produitLang;
    
        return $this;
    }

    /**
     * Remove produitLang
     *
     * @param \AdminBundle\Entity\ProduitLang $produitLang
     */
    public function removeProduitLang(\AdminBundle\Entity\ProduitLang $produitLang)
    {
        $this->produitLang->removeElement($produitLang);
    }

    /**
     * Get produitLang
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduitLang()
    {
        return $this->produitLang;
    }

    /**
     * Set categorieProduit
     *
     * @param \AdminBundle\Entity\CategorieProduit $categorieProduit
     *
     * @return Produit
     */
    public function setCategorieProduit(\AdminBundle\Entity\CategorieProduit $categorieProduit = null)
    {
        $this->categorieProduit = $categorieProduit;
    
        return $this;
    }

    /**
     * Get categorieProduit
     *
     * @return \AdminBundle\Entity\CategorieProduit
     */
    public function getCategorieProduit()
    {
        return $this->categorieProduit;
    }
}
