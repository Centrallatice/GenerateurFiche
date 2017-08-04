<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TechniquesEtape
 *
 * @ORM\Table(name="gf_techniques_etape")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\TechniquesEtapeRepository")
 */
class TechniquesEtape
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
     * @ORM\Column(name="Titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=4000, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="lienExterne", type="string", length=255, nullable=true)
     */
    private $lienExterne;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;
    
    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\EtapeProduit", inversedBy="techniques")
     * @ORM\JoinColumn(name="etape", referencedColumnName="id",nullable=true)
    */
    private $etapes;

     /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;
    
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
     * @return TechniquesEtape
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
     * @return TechniquesEtape
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
     * Set lienExterne
     *
     * @param string $lienExterne
     *
     * @return TechniquesEtape
     */
    public function setLienExterne($lienExterne)
    {
        $this->lienExterne = $lienExterne;

        return $this;
    }

    /**
     * Get lienExterne
     *
     * @return string
     */
    public function getLienExterne()
    {
        return $this->lienExterne;
    }

    /**
     * Set etapes
     *
     * @param \AdminBundle\Entity\EtapeProduit $etapes
     *
     * @return TechniquesEtape
     */
    public function setEtapes(\AdminBundle\Entity\EtapeProduit $etapes = null)
    {
        $this->etapes = $etapes;

        return $this;
    }

    /**
     * Get etapes
     *
     * @return \AdminBundle\Entity\EtapeProduit
     */
    public function getEtapes()
    {
        return $this->etapes;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return TechniquesEtape
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
     * Set auteur
     *
     * @param string $auteur
     *
     * @return TechniquesEtape
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
}
