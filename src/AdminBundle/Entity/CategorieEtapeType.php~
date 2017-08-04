<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieDenree
 *
 * @ORM\Table(name="gf_categorie_etape_type")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\CategorieEtapeTypeRepository")
 */
class CategorieEtapeType
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\EtapeType",mappedBy="categorieEtapeType")
    */
    private $etapesTypes;
    
    
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
     * @return CategorieDenree
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
     * @return CategorieDenree
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
     * @return CategorieDenree
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
     * Constructor
     */
    public function __construct()
    {
        $this->etapesTypes= new \Doctrine\Common\Collections\ArrayCollection();
        $this->setDateCreation(new \DateTime());
    }

   

    /**
     * Add etapesType
     *
     * @param \AdminBundle\Entity\EtapeType $etapesType
     *
     * @return CategorieEtapeType
     */
    public function addEtapesType(\AdminBundle\Entity\EtapeType $etapesType)
    {
        $this->etapesTypes[] = $etapesType;
    
        return $this;
    }

    /**
     * Remove etapesType
     *
     * @param \AdminBundle\Entity\EtapeType $etapesType
     */
    public function removeEtapesType(\AdminBundle\Entity\EtapeType $etapesType)
    {
        $this->etapesTypes->removeElement($etapesType);
    }

    /**
     * Get etapesTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapesTypes()
    {
        return $this->etapesTypes;
    }
}
