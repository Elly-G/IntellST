<?php

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class EnterpriseDTO
{
    /**
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("ID")
     */
    public int $id;

    /**
     * @Serializer\Expose()
     * @Serializer\SerializedName("temperature")
     * @Serializer\Type("float")
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 34,
     *      max = 38,
     *      minMessage = "Enter a higher value",
     *      maxMessage = "Enter a lower value"
     * )
     */
    public float $temperature;

    /**
     * @Serializer\Expose()
     * @Serializer\SerializedName("restrictionPeriod")
     * @Serializer\Type("integer")
     * @Assert\NotBlank
     */
    public int $restrictionPeriod;

}
