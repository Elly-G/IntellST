<?php

namespace App\Transformer;

use App\DTO\EnterpriseDTO;
use App\Entity\Enterprise;

class EnterpriseTransformer
{
    public function transformDTOToEntity(EnterpriseDTO $dto, Enterprise $enterprise): Enterprise
    {
        $enterprise->setTemperature($dto->temperature);
        $enterprise->setRestrictionPeriod($dto->restrictionPeriod);

        return $enterprise;
    }

    public function transformEntityToDTO(Enterprise $enterprise): EnterpriseDTO
    {
        $enterpriseDTO = new EnterpriseDTO();
        $enterpriseDTO->temperature = $enterprise->getTemperature();
        $enterpriseDTO->restrictionPeriod = $enterprise->getRestrictionPeriod();

        return $enterpriseDTO;
    }
}
