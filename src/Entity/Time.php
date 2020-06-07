<?php

namespace App\Entity;

use App\Validator\Constraints\ValidateDatesTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Time
 *
 * @ORM\Table(name="time")
 * @ORM\Entity(repositoryClass="App\Repository\TimeRepository")
 * @ValidateDatesTime()
 */
class Time
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
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\NotBlank()
     */
    private $startTime;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\NotBlank()
     */
    private $endTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="SET NULL")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Task", inversedBy="times", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="SET NULL")
     * @Assert\NotBlank()
     */
    private $task;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="times", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="SET NULL")
     * @Assert\NotBlank()
     */
    private $project;

    public function getId(): int
    {
        return $this->id;
    }

    public function setStartTime($date): self
    {
        $this->startTime = $date;

        return $this;
    }

    public function getStartTime(): ?\DateTime
    {
        return $this->startTime;
    }

    public function setEndTime($time): self
    {
        $this->endTime = $time;

        return $this;
    }
    public function getEndTime(): ?\DateTime
    {
        return $this->endTime;
    }

    public function setUser(User $user = null): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setTask(Task $task = null): self
    {
        $this->task = $task;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setProject(Project $project = null): self
    {
        $this->project = $project;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }
}
