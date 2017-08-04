<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtapeTypeLang
 *
 * @ORM\Table(name="gf_etape_type_lang")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\EtapeTypeLangRepository")
 */
class EtapeTypeLang
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\EtapeType", inversedBy="etapesTypesLang",cascade={"persist"})
     * @ORM\JoinColumn(name="etapeType_id", referencedColumnName="id")
     */
    private $etapesTypes;

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
     * @return EtapeTypeLang
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return EtapeTypeLang
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set lang
     *
     * @param \AdminBundle\Entity\Lang $lang
     *
     * @return EtapeTypeLang
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
     * Set etapesTypes
     *
     * @param \AdminBundle\Entity\EtapeType $etapesTypes
     *
     * @return EtapeTypeLang
     */
    public function setEtapesTypes(\AdminBundle\Entity\EtapeType $etapesTypes = null)
    {
        $this->etapesTypes = $etapesTypes;
    
        return $this;
    }

    /**
     * Get etapesTypes
     *
     * @return \AdminBundle\Entity\EtapeType
     */
    public function getEtapesTypes()
    {
        return $this->etapesTypes;
    }
}
