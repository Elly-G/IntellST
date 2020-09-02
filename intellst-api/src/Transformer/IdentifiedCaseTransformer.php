<?php

namespace App\Transformer;

use App\DTO\IdentifiedCaseDTO;
use App\Entity\IdentifiedCase;
use Doctrine\ORM\EntityManagerInterface;

class IdentifiedCaseTransformer
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function transformDTOToEntity(IdentifiedCaseDTO $dto): IdentifiedCase
    {
        $identifiedCase = new IdentifiedCase();
        $identifiedCase->setPhotoFilename($dto->photoFilename);
        $identifiedCase->setUuid($dto->uuid);
        $identifiedCase->setTemperature($dto->temperature);
        $identifiedCase->setDatePhoto(new \DateTime());
        $identifiedCase->setFirstDate(new \DateTime());
        $date = new \DateTime();
        $date->modify('-1 day');
        $identifiedCase->setAllowEntrance($date);

        return $identifiedCase;
    }

    public function transformEntityToDTO(IdentifiedCase $identifiedCase): IdentifiedCaseDTO
    {
        $identifiedCaseDTO = new IdentifiedCaseDTO();
        $identifiedCaseDTO->id = $identifiedCase->getId();
        $identifiedCaseDTO->photoFilename = $identifiedCase->getPhotoFilename();
        $identifiedCaseDTO->uuid = $identifiedCase->getUuid();
        $identifiedCaseDTO->temperature = $identifiedCase->getTemperature();
        $identifiedCaseDTO->datePhoto = $identifiedCase->getDatePhoto();
        $identifiedCaseDTO->firstDate = $identifiedCase->getFirstDate();

        return $identifiedCaseDTO;
    }

    public function transformDTOToEntityAllowEntrance(IdentifiedCase $identifiedCase): IdentifiedCase
    {
        $identifiedCase->setAllowEntrance(new \DateTime());

        return $identifiedCase;
    }
}
