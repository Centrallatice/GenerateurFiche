<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lang
 *
 * @ORM\Table(name="gf_lang")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\LangRepository")
 */
class Lang
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ISO", type="string", length=255, unique=true)
     */
    private $iSO;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, unique=true)
     */
    private $description;

   
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->nom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Lang
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
     * Set iSO
     *
     * @param string $iSO
     *
     * @return Lang
     */
    public function setISO($iSO)
    {
        $this->iSO = $iSO;
    
        return $this;
    }

    /**
     * Get iSO
     *
     * @return string
     */
    public function getISO()
    {
        return $this->iSO;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Lang
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
     * Constructor
     */
    public function __construct()
    {
        $this->uniteMesureLang = new \Doctrine\Common\Collections\ArrayCollection();
    }

    
}
