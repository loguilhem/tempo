<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
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
     * @ORM\Column(type="string", length=255, unique=false, nullable=false)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @Assert\NotBlank()
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Task", inversedBy="daughterTasks", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, unique=false, onDelete="SET NULL")
     */
    private $motherTask;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="motherTask", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true, unique=false)
     */
    private $daughterTasks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Time", mappedBy="task")
     */
    private $times;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->daughterTasks = new ArrayCollection();
        $this->times = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName($name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setMotherTask(Task $motherTask = null): self
    {
        $this->motherTask = $motherTask;

        return $this;
    }

    public function getMotherTask(): Task
    {
        return $this->motherTask;
    }

    public function addDaughterTask(Task $daughterTask): self
    {
        $this->daughterTasks[] = $daughterTask;

        return $this;
    }

    public function removeDaughterTask(Task $daughterTask): self
    {
        $this->daughterTasks->removeElement($daughterTask);

        return $this;
    }

    public function getDaughterTasks(): ArrayCollection
    {
        return $this->daughterTasks;
    }

    public function getTimes(): ArrayCollection
    {
        return $this->times;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
