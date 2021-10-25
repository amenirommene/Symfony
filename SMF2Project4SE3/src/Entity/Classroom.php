<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassroomRepository::class)
 */
class Classroom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="classroom")
     */
    private $stds;

    public function __construct()
    {
        $this->stds = new ArrayCollection();
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

    /**
     * @return Collection|Student[]
     */
    public function getStds(): Collection
    {
        return $this->stds;
    }

    public function addStd(Student $std): self
    {
        if (!$this->stds->contains($std)) {
            $this->stds[] = $std;
            $std->setClassroom($this);
        }

        return $this;
    }

    public function removeStd(Student $std): self
    {
        if ($this->stds->removeElement($std)) {
            // set the owning side to null (unless already changed)
            if ($std->getClassroom() === $this) {
                $std->setClassroom(null);
            }
        }

        return $this;
    }




}
