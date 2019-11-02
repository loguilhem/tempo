<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 *
 * @ORM\Table(name="tache")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TacheRepository")
 */
class Tache
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
     * @ORM\Column(name="intitule", type="string", length=255, unique=true)
     */
    private $intitule;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", unique=true, nullable=false)
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tache", inversedBy="tachesfilles", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, unique=false, onDelete="SET NULL")
     */
    private $tachemere;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Tache", mappedBy="tachemere", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true, unique=false)
     */
    private $tachesfilles;

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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Tache
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Tache
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set tachemere
     *
     * @param integer $tachemere
     *
     * @return Tache
     */
    public function setTachemere($tachemere)
    {
        $this->tachemere = $tachemere;

        return $this;
    }

    /**
     * Get tachemere
     *
     * @return int
     */
    public function getTachemere()
    {
        return $this->tachemere;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tachesfilles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tachesfille
     *
     * @param \AppBundle\Entity\Tache $tachesfille
     *
     * @return Tache
     */
    public function addTachesfille(\AppBundle\Entity\Tache $tachesfille)
    {
        $this->tachesfilles[] = $tachesfille;

        return $this;
    }

    /**
     * Remove tachesfille
     *
     * @param \AppBundle\Entity\Tache $tachesfille
     */
    public function removeTachesfille(\AppBundle\Entity\Tache $tachesfille)
    {
        $this->tachesfilles->removeElement($tachesfille);
    }

    /**
     * Get tachesfilles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTachesfilles()
    {
        return $this->tachesfilles;
    }
}
