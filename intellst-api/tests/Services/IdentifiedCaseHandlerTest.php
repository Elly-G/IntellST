<?php

namespace App\Tests\Services;

use App\DTO\AllowEntranceDTO;
use App\DTO\IdentifiedCaseDTO;
use App\Services\IdentifiedCaseHandler;
use App\Transformer\IdentifiedCaseTransformer;
use DateTime;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validation;

class IdentifiedCaseHandlerTest extends TestCase
{
    private function getHandler(): IdentifiedCaseHandler
    {
        $repositoryMock = $this->createMock(ObjectRepository::class);
        $emMock = $this->createMock(EntityManagerInterface::class);
        $emMock
            ->method('getRepository')
            ->willReturn($repositoryMock);

        $transformer = new IdentifiedCaseTransformer();
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        return new IdentifiedCaseHandler($emMock,
            $validator,
            $transformer);
    }

    private function getIdentifiedCaseDTO(): IdentifiedCaseDTO
    {
        $dto = new IdentifiedCaseDTO();
        $dto->photoFilename = '/homme/';
        $dto->temperature = 39;
        $dto->datePhoto = new DateTime();
        $dto->firstDate = new DateTime();

        return $dto;
    }

    private function getAllowEntranceDTO(): AllowEntranceDTO
    {
        $dto = new AllowEntranceDTO();
        $dto->allowEntrance = new DateTime();

        return $dto;
    }

    public function testValidateEmptyPhotoFilename(): void
    {
        $handler = $this->getHandler();
        $dto = $this->getIdentifiedCaseDTO();
        $dto->photoFilename = '';
        $result = $handler->updateIdentifiedCase($dto);

        $this->assertCount(2, $result);
        $this->assertEquals('photoFilename', $result->get(0)->getPropertyPath());
        $this->assertEquals('This value should not be blank.', $result->get(0)->getMessage());
    }
}
