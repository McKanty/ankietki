<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank
	 * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Twoje imię nie może zawierać liczb")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank
	 * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Twoje nazwisko nie może zawierać liczb")
     */
    private $lastname;

    /**
     * @ORM\Column(type="smallint")
	 * @Assert\Regex(
     *     pattern="/\d/",
     *     message="Wiek musi być liczbą")
	 *
     */
    private $age;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

   
}
