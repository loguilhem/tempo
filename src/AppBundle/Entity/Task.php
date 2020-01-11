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
     * @ORM\Column(name="number", type="integer", unique=true)
     */
    private $number;

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
     * Set number.
     *
     * @param int $number
     *
     * @return Task
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number.
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
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
     * @param Task $daughterTask
     * @return $this
     */
    public function addDaughterTask(Task $daughterTask)
    {
        $this->daughterTasks[] = $daughterTask;

        return $this;
    }

    /**
     * @param Task $daughterTask
     * @return bool
     */
    public function removeDaughterTask(Task $daughterTask)
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
