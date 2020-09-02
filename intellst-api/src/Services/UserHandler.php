<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Entity\User;
use App\Transformer\UserTransformer;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UserTransformer
     */
    private $transformer;

    /**
     * @var TokenStorageInterface
     */
    private $user;

    public function __construct(
        EntityManagerInterface $em,
        UserTransformer $transformer,
        TokenStorageInterface $tokenStorage
    ) {
        $this->em = $em;
        $this->transformer = $transformer;
        $this->userRepository = $this->em->getRepository(User::class);
        $this->user = $tokenStorage->getToken()->getUser();
    }

    public function getCurrentUser(): UserDTO
    {
        $userDTO = $this->transformer->transformEntityToDTO($this->user);

        return $userDTO;
    }
}
