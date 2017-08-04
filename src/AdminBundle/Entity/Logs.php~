<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logs
 *
 * @ORM\Table(name="gf_logs")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\LogsRepository")
 */
class Logs
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
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="typeAction", type="string", length=255)
     */
    private $typeAction;

    /**
     * @var string
     *
     * @ORM\Column(name="entity", type="string", length=255)
     */
    private $entity;
    
    /**
     * @var string
     *
     * @ORM\Column(name="idEntityText", type="string", length=255)
     */
    private $idEntityText;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAction", type="datetime")
     */
    private $dateAction;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="idEntity", type="integer", nullable=true)
     */
    private $idEntity;


    public function __construct() {
        $this->setDateAction(new \DateTime());
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
     * @return Logs
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
     * Set typeAction
     *
     * @param string $typeAction
     *
     * @return Logs
     */
    public function setTypeAction($typeAction)
    {
        $this->typeAction = $typeAction;
    
        return $this;
    }

    /**
     * Get typeAction
     *
     * @return string
     */
    public function getTypeAction()
    {
        return $this->typeAction;
    }

    /**
     * Set entity
     *
     * @param string $entity
     *
     * @return Logs
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    
        return $this;
    }

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set dateAction
     *
     * @param \DateTime $dateAction
     *
     * @return Logs
     */
    public function setDateAction($dateAction)
    {
        $this->dateAction = $dateAction;
    
        return $this;
    }

    /**
     * Get dateAction
     *
     * @return \DateTime
     */
    public function getDateAction()
    {
        return $this->dateAction;
    }

    /**
     * Set idEntityText
     *
     * @param string $idEntityText
     *
     * @return Logs
     */
    public function setIdEntityText($idEntityText)
    {
        $this->idEntityText = $idEntityText;
    
        return $this;
    }

    /**
     * Get idEntityText
     *
     * @return string
     */
    public function getIdEntityText()
    {
        return $this->idEntityText;
    }

    /**
     * Set idEntity
     *
     * @param integer $idEntity
     *
     * @return Logs
     */
    public function setIdEntity($idEntity)
    {
        $this->idEntity = $idEntity;
    
        return $this;
    }

    /**
     * Get idEntity
     *
     * @return integer
     */
    public function getIdEntity()
    {
        return $this->idEntity;
    }
}
