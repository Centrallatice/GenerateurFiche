<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieProduit
 *
 * @ORM\Table(name="gf_categorie_produit")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\CategorieProduitRepository")
 */
class CategorieProduit
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var int
     *
     * @ORM\Column(name="depth", type="integer")
     */
    private $depth;

    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\CategorieProduit")
     * @ORM\JoinColumn(name="categorieParente", referencedColumnName="id",nullable=true)
    */
    protected $categorieParente;
    
    /**
     * @ORM\ManyToMany(targetEntity="AdminBundle\Entity\CategorieProduit", cascade={"remove"})
     * @ORM\JoinTable(name="gf_categorie_categories",
     *      joinColumns={@ORM\JoinColumn(name="parent_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="child_id", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $categorieEnfants;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\Produit",mappedBy="categorieProduit")
    */
    private $produits;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return CategorieProduit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return CategorieProduit
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
     * Set depth
     *
     * @param integer $depth
     *
     * @return CategorieProduit
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get depth
     *
     * @return int
     */
    public function getDepth()
    {
        return $this->depth;
    }

    public function __construct() {
        $this->setDateCreation(new \DateTime());
    }

    /**
     * Set categorieParente
     *
     * @param \AdminBundle\Entity\CategorieProduit $categorieParente
     *
     * @return CategorieProduit
     */
    public function setCategorieProduitParente(\AdminBundle\Entity\CategorieProduit $categorieParente = null)
    {
        $this->categorieParente = $categorieParente;

        return $this;
    }

    /**
     * Get categorieParente
     *
     * @return \AdminBundle\Entity\CategorieProduit
     */
    public function getCategorieProduitParente()
    {
        return $this->categorieParente;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return CategorieProduit
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
     * Add categorieEnfant
     *
     * @param \AdminBundle\Entity\CategorieProduit $categorieEnfant
     *
     * @return CategorieProduit
     */
    public function addCategorieProduitEnfant(\AdminBundle\Entity\CategorieProduit $categorieEnfant)
    {
        $this->categorieEnfants[] = $categorieEnfant;

        return $this;
    }

    /**
     * Remove categorieEnfant
     *
     * @param \AdminBundle\Entity\CategorieProduit $categorieEnfant
     */
    public function removeCategorieProduitEnfant(\AdminBundle\Entity\CategorieProduit $categorieEnfant)
    {
        $this->categorieEnfants->removeElement($categorieEnfant);
    }

    /**
     * Get categorieEnfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorieProduitEnfants()
    {
        return $this->categorieEnfants;
    }

    /**
     * Set categorieParente
     *
     * @param \AdminBundle\Entity\CategorieProduit $categorieParente
     *
     * @return CategorieProduit
     */
    public function setCategorieParente(\AdminBundle\Entity\CategorieProduit $categorieParente = null)
    {
        $this->categorieParente = $categorieParente;

        return $this;
    }

    /**
     * Get categorieParente
     *
     * @return \AdminBundle\Entity\CategorieProduit
     */
    public function getCategorieParente()
    {
        return $this->categorieParente;
    }

    /**
     * Add categorieEnfant
     *
     * @param \AdminBundle\Entity\CategorieProduit $categorieEnfant
     *
     * @return CategorieProduit
     */
    public function addCategorieEnfant(\AdminBundle\Entity\CategorieProduit $categorieEnfant)
    {
        $this->categorieEnfants[] = $categorieEnfant;

        return $this;
    }

    /**
     * Remove categorieEnfant
     *
     * @param \AdminBundle\Entity\CategorieProduit $categorieEnfant
     */
    public function removeCategorieEnfant(\AdminBundle\Entity\CategorieProduit $categorieEnfant)
    {
        $this->categorieEnfants->removeElement($categorieEnfant);
    }

    /**
     * Get categorieEnfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorieEnfants()
    {
        return $this->categorieEnfants;
    }

    /**
     * Add produit
     *
     * @param \AdminBundle\Entity\Produit $produit
     *
     * @return CategorieProduit
     */
    public function addProduit(\AdminBundle\Entity\Produit $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \AdminBundle\Entity\Produit $produit
     */
    public function removeProduit(\AdminBundle\Entity\Produit $produit)
    {
        $this->produits->removeElement($produit);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduits()
    {
        return $this->produits;
    }
}
