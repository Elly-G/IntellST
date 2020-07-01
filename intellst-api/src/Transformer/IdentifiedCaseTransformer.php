<?php

namespace App\Transformer;

use App\DTO\AllowEntranceDTO;
use App\DTO\IdentifiedCaseDTO;
use App\Entity\IdentifiedCase;

class IdentifiedCaseTransformer
{
    public function transformDTOToEntity(IdentifiedCaseDTO $dto): IdentifiedCase
    {
        $identifiedCase = new IdentifiedCase();
        $identifiedCase->setPhotoFilename($dto->photoFilename);
        $identifiedCase->setTemperature($dto->temperature);
        $identifiedCase->setDatePhoto(new \DateTime());
        $identifiedCase->setFirstDate(new \DateTime());

        return $identifiedCase;
    }

    public function transformEntityToDTO(IdentifiedCase $identifiedCase): IdentifiedCaseDTO
    {
        $identifiedCaseDTO = new IdentifiedCaseDTO();
        $identifiedCaseDTO->id = $identifiedCase->getId();
        $identifiedCaseDTO->photoFilename = $identifiedCase->getPhotoFilename();
        $identifiedCaseDTO->temperature = $identifiedCase->getTemperature();
        $identifiedCaseDTO->datePhoto = $identifiedCase->getDatePhoto();
        $identifiedCaseDTO->firstDate = $identifiedCase->getFirstDate();

        return $identifiedCaseDTO;
    }

    public function transformDTOToEntityAllowEntrance(AllowEntranceDTO $dto, IdentifiedCase $identifiedCase): IdentifiedCase
    {
        $identifiedCase->setAllowEntrance(new \DateTime());

        return $identifiedCase;
    }
}
