<?php

namespace App\Controller;

use App\Services\UserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserControler extends AbstractController
{
    /**
     * @var UserHandler
     */
    private $userHandler;

    public function __construct(
        UserHandler $userHandler
    )
    {
        $this->userHandler = $userHandler;
    }

    /**
     * @Route("/api/user", name="user_Conected", methods={"Get"})
     */
    public function listUser(): JsonResponse
    {
        $list = $this->userHandler->getList();

        return new JsonResponse($list);
    }
}
