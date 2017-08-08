<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UniteMesureLang
 *
 * @ORM\Table(name="gf_unite_mesure_lang")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\UniteMesureLangRepository")
 */
class UniteMesureLang
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
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Lang")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id",nullable=true)
    */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    
    /**
     * @var float
     *
     * @ORM\Column(name="equivalence", type="float")
     */
    private $equivalence;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="UniteMesure", inversedBy="uniteMesureLang",cascade={"persist"})
     * @ORM\JoinColumn(name="uniteMesure_id", referencedColumnName="id")
     */
    private $uniteMesure;

    

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
     * Get id
     *
     * @return integer
     */
    public function __toString()
    {
        return $this->nom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return UniteMesureLang
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
     * Set description
     *
     * @param string $description
     *
     * @return UniteMesureLang
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
     * Set lang
     *
     * @param \AdminBundle\Entity\Lang $lang
     *
     * @return UniteMesureLang
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
     * Set uniteMesure
     *
     * @param \AdminBundle\Entity\UniteMesure $uniteMesure
     *
     * @return UniteMesureLang
     */
    public function setUniteMesure(\AdminBundle\Entity\UniteMesure $uniteMesure = null)
    {
        $this->uniteMesure = $uniteMesure;
    
        return $this;
    }

    /**
     * Get uniteMesure
     *
     * @return \AdminBundle\Entity\UniteMesure
     */
    public function getUniteMesure()
    {
        return $this->uniteMesure;
    }

    /**
     * Set equivalence
     *
     * @param float $equivalence
     *
     * @return UniteMesureLang
     */
    public function setEquivalence($equivalence)
    {
        $this->equivalence = $equivalence;
    
        return $this;
    }

    /**
     * Get equivalence
     *
     * @return float
     */
    public function getEquivalence()
    {
        return $this->equivalence;
    }
}
