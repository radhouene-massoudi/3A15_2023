<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $cin = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(name:'cin_ref',referencedColumnName:'ref')]
    private ?Grade $grades = null;

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setCin(string $cin): static
    {
        $this->cin = $cin;

        return $this;
    }
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getGrades(): ?Grade
    {
        return $this->grades;
    }

    public function setGrades(?Grade $grades): static
    {
        $this->grades = $grades;

        return $this;
    }
}
