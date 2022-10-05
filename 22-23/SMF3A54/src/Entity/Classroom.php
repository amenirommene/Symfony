<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Name = null;

    #[ORM\Column(length: 30)]
    private ?string $classe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $salle = null;

    /**
     * @return string|null
     */
    public function getClasse(): ?string
    {
        return $this->classe;
    }

    /**
     * @param string|null $classe
     */
    public function setClasse(?string $classe): void
    {
        $this->classe = $classe;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(?string $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
}
