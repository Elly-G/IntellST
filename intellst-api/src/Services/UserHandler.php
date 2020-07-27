<?php

namespace App\Services;

use App\Entity\User;
use App\Transformer\UserTransformer;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserHandler
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

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
    )
    {
        $this->em = $em;
        $this->transformer = $transformer;
        $this->userRepository = $this->em->getRepository(User::class);
        $this->user = $tokenStorage->getToken()->getUser();
    }

    public function getList(): array
    {
        $arr = [];
        $userDTO = $this->transformer->transformEntityToDTO($this->user);
        $arr[] = $userDTO;

        return $arr;
    }
}
