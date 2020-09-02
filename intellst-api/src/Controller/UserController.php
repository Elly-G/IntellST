<?php

namespace App\Controller;

use App\Services\UserHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * @var UserHandler
     */
    private $userHandler;

    public function __construct(
        UserHandler $userHandler
    ) {
        $this->userHandler = $userHandler;
    }

    /**
     * @Route("/api/user", name="user_Conected", methods={"Get"})
     */
    public function getCurrentUser(): JsonResponse
    {
        $list = $this->userHandler->getCurrentUser();

        return new JsonResponse($list);
    }
}
