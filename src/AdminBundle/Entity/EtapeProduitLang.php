<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtapeTypeLang
 *
 * @ORM\Table(name="gf_etape_produit_lang")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\EtapeProduitLangRepository")
 */
class EtapeProduitLang
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
     * @ORM\Column(name="contenu", type="string", length=4000)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\EtapeProduit", inversedBy="etapesProduitsLang",cascade={"persist"})
     * @ORM\JoinColumn(name="etapeProduit_id", referencedColumnName="id")
     */
    private $etapesProduit;


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
     * @return EtapeProduitLang
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
     * @return EtapeProduitLang
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
     * @return EtapeProduitLang
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
     * Set etapesProduit
     *
     * @param \AdminBundle\Entity\EtapeProduit $etapesProduit
     *
     * @return EtapeProduitLang
     */
    public function setEtapesProduit(\AdminBundle\Entity\EtapeProduit $etapesProduit = null)
    {
        $this->etapesProduit = $etapesProduit;
    
        return $this;
    }

    /**
     * Get etapesProduit
     *
     * @return \AdminBundle\Entity\EtapeProduit
     */
    public function getEtapesProduit()
    {
        return $this->etapesProduit;
    }
}
