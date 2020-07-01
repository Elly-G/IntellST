<?php

namespace App\Controller;

use App\DTO\IdentifiedCaseDTO;
use App\Entity\IdentifiedCase;
use App\Services\IdentifiedCaseHandler;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Serializer\ValidationErrorSerializer;

class IdentifiedCaseController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var IdentifiedCaseHandler
     */
    private $identifiedCaseHandler;

    /**
     * @var ValidationErrorSerializer
     */
    private $validationErrorSerializer;

    public function __construct(
        IdentifiedCaseHandler $identifiedCaseHandler,
        SerializerInterface $serializer,
        ValidationErrorSerializer $validationErrorSerializer
    )
    {
        $this->serializer = $serializer;
        $this->identifiedCaseHandler = $identifiedCaseHandler;
        $this->validationErrorSerializer = $validationErrorSerializer;
    }

    /**
     * @Route("/api/identified-case", name="add_identified_case", methods={"POST"})
     */
    public function addIdentifiedCase(Request $request): JsonResponse
    {
        $data = $request->getContent();

        $addIdentifiedCaseDTO = $this->serializer->deserialize(
            $data,
            IdentifiedCaseDTO::class,
            'json'
        );

        $errors = $this->identifiedCaseHandler->updateIdentifiedCase($addIdentifiedCaseDTO);
        if ($errors->count()) {
            return new JsonResponse(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Bad Request',
                    'errors' => $this->validationErrorSerializer->serialize($errors),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(['message' => 'Identified Case added successfully'], Response::HTTP_OK);
    }

    /**
     * @Route("/api/identified-case", name="show_list_identified_case", methods={"GET"})
     */
    public function listIdentifiedCase(): JsonResponse
    {
        $list = $this->identifiedCaseHandler->getList();

        return new JsonResponse($list);
    }

    /**
     * @Route("/api/identified-case/{identified-case}", name="edit_allow_entrance", methods={"POST"})
     */
    public function editAllowEntrance(Request $request, IdentifiedCase $identifiedCase): JsonResponse
    {
        $data = $request->getContent();

        $editAllowEntrance = $this->serializer->deserialize(
            $data,
            IdentifiedCaseDTO::class,
            'json'
        );

        $errors = $this->identifiedCaseHandler->updateIdentifiedCaseAllowEntrance($editAllowEntrance,$identifiedCase);
        if ($errors->count()) {
            return new JsonResponse(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Bad Request',
                    'errors' => $this->validationErrorSerializer->serialize($errors),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(['message' => 'Entry allowed successfully'], Response::HTTP_OK);
    }
}
