<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $incorporationDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Project", inversedBy="employees")
     */
    private $projects;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WorkContract", inversedBy="employees")
     * @ORM\JoinColumn(nullable=true)
     */
    private $workContract;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getIncorporationDate(): ?\DateTimeInterface
    {
        return $this->incorporationDate;
    }

    public function setIncorporationDate(\DateTimeInterface $incorporationDate): self
    {
        $this->incorporationDate = $incorporationDate;

        return $this;
    }

    public function moreThanOneYearInCompany()
    {
        $diff = $this->incorporationDate->diff(new \DateTime());

        return ($diff->format('%R%a') >= 365);
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
        }

        return $this;
    }

    public function getWorkContract(): ?WorkContract
    {
        return $this->workContract;
    }

    public function setWorkContract(?WorkContract $workContract): self
    {
        $this->workContract = $workContract;

        return $this;
    }
}
