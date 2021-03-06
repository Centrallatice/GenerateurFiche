<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtapeProduit
 *
 * @ORM\Table(name="gf_etape_produit")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\EtapeProduitRepository")
 */
class EtapeProduit
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;

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
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Produit", inversedBy="etapes")
     * @ORM\JoinColumn(name="produit", referencedColumnName="id",nullable=true)
    */
    private $produit;

    /**
     * @var string
     *
     * @ORM\Column(name="codeCouleur", type="string", length=10, nullable=true)
     */
    private $codeCouleur;

    
    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\TechniquesEtape",mappedBy="etapes",cascade={"remove"})
    */
    private $techniques;

    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\EtapeDenree",mappedBy="etape", cascade={"remove"})
     */
    protected $etapeDenrees;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dureeType", type="string", length=255, nullable=true)
     */
    private $dureeType;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dureeValeur", type="string", length=255, nullable=true)
     */
    private $dureeValeur;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dureeUnite", type="string", length=255, nullable=true)
     */
    private $dureeUnite;
    
    
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
     * Set titre
     *
     * @param string $titre
     *
     * @return EtapeProduit
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
     * Set auteur
     *
     * @param string $auteur
     *
     * @return EtapeProduit
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
     * @return EtapeProduit
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
     * Set codeCouleur
     *
     * @param string $codeCouleur
     *
     * @return EtapeProduit
     */
    public function setCodeCouleur($codeCouleur)
    {
        $this->codeCouleur = $codeCouleur;

        return $this;
    }

    /**
     * Get codeCouleur
     *
     * @return string
     */
    public function getCodeCouleur()
    {
        return $this->codeCouleur;
    }

    /**
     * Set produit
     *
     * @param \AdminBundle\Entity\Produit $produit
     *
     * @return EtapeProduit
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

    

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return EtapeProduit
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    
        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Add technique
     *
     * @param \AdminBundle\Entity\TechniquesEtape $technique
     *
     * @return EtapeProduit
     */
    public function addTechnique(\AdminBundle\Entity\TechniquesEtape $technique)
    {
        $this->techniques[] = $technique;
    
        return $this;
    }

    /**
     * Remove technique
     *
     * @param \AdminBundle\Entity\TechniquesEtape $technique
     */
    public function removeTechnique(\AdminBundle\Entity\TechniquesEtape $technique)
    {
        $this->techniques->removeElement($technique);
    }

    /**
     * Get techniques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTechniques()
    {
        return $this->techniques;
    }

    

    /**
     * Add etapeDenree
     *
     * @param \AdminBundle\Entity\EtapeDenree $etapeDenree
     *
     * @return EtapeProduit
     */
    public function addEtapeDenree(\AdminBundle\Entity\EtapeDenree $etapeDenree)
    {
        $this->etapeDenrees[] = $etapeDenree;
    
        return $this;
    }

    /**
     * Remove etapeDenree
     *
     * @param \AdminBundle\Entity\EtapeDenree $etapeDenree
     */
    public function removeEtapeDenree(\AdminBundle\Entity\EtapeDenree $etapeDenree)
    {
        $this->etapeDenrees->removeElement($etapeDenree);
    }

    /**
     * Get etapeDenrees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapeDenrees()
    {
        return $this->etapeDenrees;
    }

    /**
     * Set dureeType
     *
     * @param string $dureeType
     *
     * @return EtapeProduit
     */
    public function setDureeType($dureeType)
    {
        $this->dureeType = $dureeType;
    
        return $this;
    }

    /**
     * Get dureeType
     *
     * @return string
     */
    public function getDureeType()
    {
        return $this->dureeType;
    }

    /**
     * Set dureeValeur
     *
     * @param string $dureeValeur
     *
     * @return EtapeProduit
     */
    public function setDureeValeur($dureeValeur)
    {
        $this->dureeValeur = $dureeValeur;
    
        return $this;
    }

    /**
     * Get dureeValeur
     *
     * @return string
     */
    public function getDureeValeur()
    {
        return $this->dureeValeur;
    }

    /**
     * Set dureeUnite
     *
     * @param string $dureeUnite
     *
     * @return EtapeProduit
     */
    public function setDureeUnite($dureeUnite)
    {
        $this->dureeUnite = $dureeUnite;
    
        return $this;
    }

    /**
     * Get dureeUnite
     *
     * @return string
     */
    public function getDureeUnite()
    {
        return $this->dureeUnite;
    }
}
