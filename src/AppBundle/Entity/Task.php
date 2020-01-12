<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskRepository")
 */
class Task
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="daughterTasks", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, unique=false, onDelete="SET NULL")
     */
    private $motherTask;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="motherTask", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true, unique=false)
     */
    private $daughterTasks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->daughterTasks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Task
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set motherTask.
     *
     * @param \AppBundle\Entity\Task|null $motherTask
     *
     * @return Task
     */
    public function setMotherTask(\AppBundle\Entity\Task $motherTask = null)
    {
        $this->motherTask = $motherTask;

        return $this;
    }

    /**
     * Get motherTask.
     *
     * @return \AppBundle\Entity\Task|null
     */
    public function getMotherTask()
    {
        return $this->motherTask;
    }

    /**
     * Add daughterTask.
     *
     * @param \AppBundle\Entity\Task $daughterTask
     *
     * @return Task
     */
    public function addDaughterTask(\AppBundle\Entity\Task $daughterTask)
    {
        $this->daughterTasks[] = $daughterTask;

        return $this;
    }

    /**
     * Remove daughterTask.
     *
     * @param \AppBundle\Entity\Task $daughterTask
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDaughterTask(\AppBundle\Entity\Task $daughterTask)
    {
        return $this->daughterTasks->removeElement($daughterTask);
    }

    /**
     * Get daughterTasks.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDaughterTasks()
    {
        return $this->daughterTasks;
    }
}
