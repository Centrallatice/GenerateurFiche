<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Denree
 *
 * @ORM\Table(name="gf_denree")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\DenreeRepository")
 */
class Denree
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
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="UniteMesure", inversedBy="denrees")
     * @ORM\JoinTable(name="denree_mesure")
     */
    private $uniteMesures;

    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\CategorieDenree", inversedBy="denrees")
     * @ORM\JoinColumn(name="categorieDenree", referencedColumnName="id",nullable=true)
    */
    private $categorieDenree;

     /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, unique=true, nullable=true)
     */
    private $code;

    /**
     * @var float
     *
     * @ORM\Column(name="PUHT", type="float", nullable=true)
     */
    private $pUHT;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;
    
    /**
     * @var string
     *
     * @ORM\Column(name="codeBarre", type="string", length=255, nullable=true)
     */
    private $codeBarre;
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;
    
    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\EtapeDenree",mappedBy="denree")
     */
    protected $etapeDenrees;
    
    
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Denree
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
     * Set code
     *
     * @param string $code
     *
     * @return Denree
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set pUHT
     *
     * @param float $pUHT
     *
     * @return Denree
     */
    public function setPUHT($pUHT)
    {
        $this->pUHT = $pUHT;
    
        return $this;
    }

    /**
     * Get pUHT
     *
     * @return float
     */
    public function getPUHT()
    {
        return $this->pUHT;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Denree
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
     * Set codeBarre
     *
     * @param string $codeBarre
     *
     * @return Denree
     */
    public function setCodeBarre($codeBarre)
    {
        $this->codeBarre = $codeBarre;
    
        return $this;
    }

    /**
     * Get codeBarre
     *
     * @return string
     */
    public function getCodeBarre()
    {
        return $this->codeBarre;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Denree
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
     * Add uniteMesure
     *
     * @param \AdminBundle\Entity\UniteMesure $uniteMesure
     *
     * @return Denree
     */
    public function addUniteMesure(\AdminBundle\Entity\UniteMesure $uniteMesure)
    {
        $this->uniteMesures[] = $uniteMesure;
    
        return $this;
    }

    /**
     * Remove uniteMesure
     *
     * @param \AdminBundle\Entity\UniteMesure $uniteMesure
     */
    public function removeUniteMesure(\AdminBundle\Entity\UniteMesure $uniteMesure)
    {
        $this->uniteMesures->removeElement($uniteMesure);
    }

    /**
     * Get uniteMesures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUniteMesures()
    {
        return $this->uniteMesures;
    }

    /**
     * Set categorieDenree
     *
     * @param \AdminBundle\Entity\CategorieDenree $categorieDenree
     *
     * @return Denree
     */
    public function setCategorieDenree(\AdminBundle\Entity\CategorieDenree $categorieDenree = null)
    {
        $this->categorieDenree = $categorieDenree;
    
        return $this;
    }

    /**
     * Get categorieDenree
     *
     * @return \AdminBundle\Entity\CategorieDenree
     */
    public function getCategorieDenree()
    {
        return $this->categorieDenree;
    }

    /**
     * Add etapeDenree
     *
     * @param \AdminBundle\Entity\EtapeDenree $etapeDenree
     *
     * @return Denree
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
}
