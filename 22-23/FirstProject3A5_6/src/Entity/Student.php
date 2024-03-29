<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column(length: 55)]
    private ?string $nsc = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    private ?Classroom $classroom = null;

    /**
     * @return string|null
     */
    public function getNsc(): ?string
    {
        return $this->nsc;
    }

    /**
     * @param string|null $nsc
     */
    public function setNsc(?string $nsc): void
    {
        $this->nsc = $nsc;
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

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }


}
