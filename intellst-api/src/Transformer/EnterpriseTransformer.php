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

}
