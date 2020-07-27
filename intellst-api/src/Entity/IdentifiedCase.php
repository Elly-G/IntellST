<?php

namespace App\Entity;

use App\Repository\IdentifiedCaseRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IdentifiedCaseRepository::class)
 */
class IdentifiedCase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id=null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private string $photoFilename;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private float $temperature;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $datePhoto;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $firstDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $allowEntrance;


    public function __construct()
    {
        $this->datePhoto = new DateTime();
        $this->firstDate = new DateTime();
        $this->allowEntrance = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoFilename(): ?string
    {
        return $this->photoFilename;
    }

    public function setPhotoFilename(string $photoFilename): self
    {
        $this->photoFilename = $photoFilename;

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

    public function getDatePhoto(): ?DateTimeInterface
    {
        return $this->datePhoto;
    }

    public function setDatePhoto(DateTimeInterface $datePhoto): void
    {
        $this->datePhoto = $datePhoto;
    }

    public function getFirstDate(): ?DateTimeInterface
    {
        return $this->firstDate;
    }

    public function setFirstDate(DateTimeInterface $firstDate): void
    {
        $this->firstDate = $firstDate;
    }

    public function getAllowEntrance(): ?DateTimeInterface
    {
        return $this->allowEntrance;
    }

    public function setAllowEntrance(DateTimeInterface $allowEntrance): void
    {
        $this->allowEntrance = $allowEntrance;
    }
}
