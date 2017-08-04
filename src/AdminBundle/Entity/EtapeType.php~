<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AdminBundle\Entity\EtapeTypeLang;

/**
 * EtapeType
 *
 * @ORM\Table(name="gf_etape_type")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\EtapeTypeRepository")
 */
class EtapeType
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
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\CategorieEtapeType", inversedBy="etapesTypes")
     * @ORM\JoinColumn(name="categorieEtapeType", referencedColumnName="id",nullable=true)
    */
    private $categorieEtapeType;

    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\EtapeTypeLang", mappedBy="etapesTypes",cascade={"persist"}, fetch="EAGER")
     */
    private $etapesTypesLang;
    
    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;
    
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
     * @return EtapeType
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
     * Set categorie
     *
     * @param string $categorie
     *
     * @return EtapeType
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etapesTypesLang = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set categorieEtapeType
     *
     * @param \AdminBundle\Entity\CategorieEtapeType $categorieEtapeType
     *
     * @return EtapeType
     */
    public function setCategorieEtapeType(\AdminBundle\Entity\CategorieEtapeType $categorieEtapeType = null)
    {
        $this->categorieEtapeType = $categorieEtapeType;
    
        return $this;
    }

    /**
     * Get categorieEtapeType
     *
     * @return \AdminBundle\Entity\CategorieEtapeType
     */
    public function getCategorieEtapeType()
    {
        return $this->categorieEtapeType;
    }

    /**
     * Add etapesTypesLang
     *
     * @param \AdminBundle\Entity\EtapeTypeLang $etapesTypesLang
     *
     * @return EtapeType
     */
    public function addEtapesTypesLang(EtapeTypeLang $etapesTypesLang)
    {
        $this->etapesTypesLang[] = $etapesTypesLang;
    
        return $this;
    }

    /**
     * Remove etapesTypesLang
     *
     * @param \AdminBundle\Entity\EtapeTypeLang $etapesTypesLang
     */
    public function removeEtapesTypesLang(EtapeTypeLang $etapesTypesLang)
    {
        $this->etapesTypesLang->removeElement($etapesTypesLang);
    }

    /**
     * Get etapesTypesLang
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapesTypesLang()
    {
        return $this->etapesTypesLang;
    }
   
    public function hasEtapeTypeLang()
    {
        return $this->etapesTypesLang;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return EtapeType
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
