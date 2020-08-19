<?php

namespace App\Entity;

use App\Repository\EnterpriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EnterpriseRepository::class)
 */
class Enterprise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="enterprise")
     * @Assert\NotBlank
     */
    private $users;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 34,
     *      max = 38,
     *      minMessage = "Enter a higher value",
     *      maxMessage = "Enter a lower value",
     * )
     */
    private float $temperature;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private int $restrictionPeriod;

    /**
     * @ORM\OneToMany(targetEntity=IdentifiedCase::class, mappedBy="enterprise")
     */
    private $identifiedCases;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->identifiedCases = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setEnterprise($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getEnterprise() === $this) {
                $user->setEnterprise(null);
            }
        }

        return $this;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getRestrictionPeriod(): ?int
    {
        return $this->restrictionPeriod;
    }

    public function setRestrictionPeriod(int $restrictionPeriod): self
    {
        $this->restrictionPeriod = $restrictionPeriod;

        return $this;
    }

    /**
     * @return Collection|IdentifiedCase[]
     */
    public function getIdentifiedCases(): Collection
    {
        return $this->identifiedCases;
    }

    public function addIdentifiedCase(IdentifiedCase $identifiedCase): self
    {
        if (!$this->identifiedCases->contains($identifiedCase)) {
            $this->identifiedCases[] = $identifiedCase;
            $identifiedCase->setEnterprise($this);
        }

        return $this;
    }

    public function removeIdentifiedCase(IdentifiedCase $identifiedCase): self
    {
        if ($this->identifiedCases->contains($identifiedCase)) {
            $this->identifiedCases->removeElement($identifiedCase);
            // set the owning side to null (unless already changed)
            if ($identifiedCase->getEnterprise() === $this) {
                $identifiedCase->setEnterprise(null);
            }
        }

        return $this;
    }
}
