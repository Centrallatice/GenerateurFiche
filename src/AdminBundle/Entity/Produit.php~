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
     * @ORM\Column(name="titre", type="string", length=255)
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
     * @var string
     *
     * @ORM\Column(name="descriptionApport", type="text", nullable=true)
     */
    private $descriptionApport;
    
    /**
     * @var float
     *
     * @ORM\Column(name="coefficient", type="float", nullable=true)
     */
    private $coefficient;

    /**
     * @var string
     *
     * @ORM\Column(name="dressageType", type="string", length=255, nullable=true)
     */
    private $dressageType;

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
    
    public function __construct() {
        $this->setDateCreation(new \DateTime());
    }
    /**
     * Get id
     *
     * @return int
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
     * @return Produit
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
     * @return Produit
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
     * Set dressageType
     *
     * @param string $dressageType
     *
     * @return Produit
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
     * Set photo
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
     * Get photo
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
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
     * Set descriptionApport
     *
     * @param string $descriptionApport
     *
     * @return Produit
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
}
