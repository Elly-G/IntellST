<?php

namespace App\Transformer;

use App\DTO\UserDTO;
use App\Entity\User;

class UserTransformer
{
    public function transformEntityToDTO(User $user): UserDTO
    {
        $userDTO = new UserDTO();
        $userDTO->id = $user->getId();
        $userDTO->firstname = $user->getFirstname();
        $userDTO->lastname = $user->getLastname();
        $userDTO->email = $user->getEmail();

        return $userDTO;
    }
}
