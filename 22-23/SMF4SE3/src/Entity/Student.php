<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column]
    #[Assert\NotBlank(message:"nsc obligatoire")]
    private ?int $nsc = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    private ?Classroom $classroom_id = null;

    /**
     * @return int|null
     */
    public function getNsc(): ?int
    {
        return $this->nsc;
    }

    /**
     * @param int|null $nsc
     */
    public function setNsc(?int $nsc): void
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

    public function getClassroomId(): ?Classroom
    {
        return $this->classroom_id;
    }

    public function setClassroomId(?Classroom $classroom_id): self
    {
        $this->classroom_id = $classroom_id;

        return $this;
    }
}
