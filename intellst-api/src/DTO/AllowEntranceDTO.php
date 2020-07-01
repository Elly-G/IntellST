<?php

namespace App\DTO;

use DateTime;
use JMS\Serializer\Annotation as Serializer;

class AllowEntranceDTO
{
    /**
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("ID")
     */
    public int $id;

    /**
     * @Serializer\Type("DateTime")
     * @Serializer\Expose()
     * @Serializer\SerializedName("allowEntrance")
     */
    public DateTime $allowEntrance;
}
