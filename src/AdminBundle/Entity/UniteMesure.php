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
     * @ORM\Column(name="auteur", type="string", length=255, nullable=false)
     */
    private $auteur;
    
    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\UniteMesureLang", mappedBy="uniteMesure",cascade={"persist"}, fetch="EAGER")
     */
    private $uniteMesureLang;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=false)
     */
    private $dateCreation;
    
    /**
     * @ORM\ManyToMany(targetEntity="Denree", mappedBy="uniteMesures", fetch="EAGER")
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
        $this->denrees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->uniteMesureLang = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add uniteMesureLang
     *
     * @param \AdminBundle\Entity\UniteMesureLang $uniteMesureLang
     *
     * @return UniteMesure
     */
    public function addUniteMesureLang(\AdminBundle\Entity\UniteMesureLang $uniteMesureLang)
    {
        $this->uniteMesureLang[] = $uniteMesureLang;
    
        return $this;
    }

    /**
     * Remove uniteMesureLang
     *
     * @param \AdminBundle\Entity\UniteMesureLang $uniteMesureLang
     */
    public function removeUniteMesureLang(\AdminBundle\Entity\UniteMesureLang $uniteMesureLang)
    {
        $this->uniteMesureLang->removeElement($uniteMesureLang);
    }

    /**
     * Get uniteMesureLang
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUniteMesureLang()
    {
        return $this->uniteMesureLang;
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
}
