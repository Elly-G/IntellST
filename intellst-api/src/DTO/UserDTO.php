<?php

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    /**
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("ID")
     */
    public int $id;

    /**
     * @Serializer\Expose()
     * @Serializer\SerializedName("firstname")
     * @Serializer\Type("string")
     * @Assert\NotBlank
     */
    public string $firstname;

    /**
     * @Serializer\Expose()
     * @Serializer\SerializedName("lastname")
     * @Serializer\Type("string")
     * @Assert\NotBlank
     */
    public string $lastname;

    /**
     * @Serializer\Type("string")
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @Serializer\Expose()
     * @Serializer\SerializedName("email")
     */
    public string $email;

    /**
     * Enterprise User
     * @var integer
     * @Assert\NotNull
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("enterprise")
     */
    public $enterprise;
}
