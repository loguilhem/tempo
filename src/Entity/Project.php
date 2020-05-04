<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, nullable=false, unique=false)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function getId(): int
    {
        return $this->id;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
