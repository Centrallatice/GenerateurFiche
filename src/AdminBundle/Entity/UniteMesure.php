<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UniteMesure
 *
 * @ORM\Table(name="gf_unite_mesure")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\UniteMesureRepository")
 */
class UniteMesure
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255, nullable=false)
     */
    private $auteur;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=false)
     */
    private $dateCreation;
    
    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\Denree",mappedBy="uniteMesure")
    */
    private $denrees;
    
    /**
     * @var string
     *
     * @ORM\Column(name="groupe", type="string", length=255, nullable=false)
     */
    private $groupe;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="estReference", type="boolean", nullable=false)
     */
    private $estReference;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="valeurReference", type="integer", nullable=false)
     */
    private $valeurReference;
    
    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set nom
     *
     * @param string $nom
     *
     * @return UniteMesure
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
     * @return UniteMesure
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
     * @return UniteMesure
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
     * Set description
     *
     * @param string $description
     *
     * @return UniteMesure
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
     * Add denree
     *
     * @param \AdminBundle\Entity\Denree $denree
     *
     * @return UniteMesure
     */
    public function addDenree(\AdminBundle\Entity\Denree $denree)
    {
        $this->denrees[] = $denree;
    
        return $this;
    }

    /**
     * Remove denree
     *
     * @param \AdminBundle\Entity\Denree $denree
     */
    public function removeDenree(\AdminBundle\Entity\Denree $denree)
    {
        $this->denrees->removeElement($denree);
    }

    /**
     * Get denrees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDenrees()
    {
        return $this->denrees;
    }

    /**
     * Set groupe
     *
     * @param string $groupe
     *
     * @return UniteMesure
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;
    
        return $this;
    }

    /**
     * Get groupe
     *
     * @return string
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set estReference
     *
     * @param boolean $estReference
     *
     * @return UniteMesure
     */
    public function setEstReference($estReference)
    {
        $this->estReference = $estReference;
    
        return $this;
    }

    /**
     * Get estReference
     *
     * @return boolean
     */
    public function getEstReference()
    {
        return $this->estReference;
    }

    /**
     * Set valeurReference
     *
     * @param integer $valeurReference
     *
     * @return UniteMesure
     */
    public function setValeurReference($valeurReference)
    {
        $this->valeurReference = $valeurReference;
    
        return $this;
    }

    /**
     * Get valeurReference
     *
     * @return integer
     */
    public function getValeurReference()
    {
        return $this->valeurReference;
    }
}
