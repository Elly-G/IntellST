<?php

namespace App\Tests\Services;

use App\DTO\AllowEntranceDTO;
use App\DTO\IdentifiedCaseDTO;
use App\Entity\IdentifiedCase;
use App\Entity\User;
use App\Services\IdentifiedCaseHandler;
use App\Services\UserHandler;
use App\Transformer\EnterpriseTransformer;
use App\Transformer\IdentifiedCaseTransformer;
use App\Transformer\UserTransformer;
use DateTime;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
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

        $transformer = new IdentifiedCaseTransformer($emMock);
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        $enterpriseTransformer = new EnterpriseTransformer();
        $userTransformer = new UserTransformer();
        $tokenMock = $this->createMock(TokenInterface::class);
        $tokenMock->method('getUser')->willReturn(new User());
        $tokenStorageMock = $this->createMock(TokenStorageInterface::class);
        $tokenStorageMock->method('getToken')->willReturn($tokenMock);

        $userHandler = new UserHandler($emMock, $userTransformer, $tokenStorageMock);

        return new IdentifiedCaseHandler(
            $emMock,
            $validator,
            $transformer,
            $enterpriseTransformer,
            $userHandler
        );
    }

    private function getIdentifiedCaseDTO(): IdentifiedCaseDTO
    {
        $dto = new IdentifiedCaseDTO();
        $dto->photoFilename = '/homme/';
        $dto->uuid = 'jafasfrt5etgrvgdg';
        $dto->temperature = 39;
        $dto->datePhoto = new DateTime('2020-01-01T15:03:01.012345Z');
        $dto->firstDate = new DateTime('2020-01-01T15:03:01.012345Z');

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

    public function testValidateOK(): void
    {
        $handler = $this->getHandler();
        $dto = $this->getIdentifiedCaseDTO();
        $dto->temperature = 0;
        $result = $handler->updateIdentifiedCase($dto);

        $this->assertCount(0, $result);
    }

    public function testValidateAllowEntranceOK(): void
    {
        $identifiedCase = new IdentifiedCase();
        $identifiedCase->setPhotoFilename('/homme/');
        $identifiedCase->setUuid('jafasfrt5etgrvgdg');
        $identifiedCase->setTemperature(39);
        $identifiedCase->setDatePhoto(new DateTime());
        $identifiedCase->setFirstDate(new DateTime());

        $handler = $this->getHandler();

        $result = $handler->updateIdentifiedCaseAllowEntrance($identifiedCase);

        $this->assertCount(0, $result);
    }

    public function testGetListIdentifiedCase(): void
    {
        $identifiedCase1 = new IdentifiedCase();
        $identifiedCase1->setPhotoFilename('/home/images/');
        $identifiedCase1->setUuid('jafasfrtetgrvgdg');
        $identifiedCase1->setTemperature(39);
        $identifiedCase1->setFirstDate(new DateTime('2020-01-01T15:03:01.012345Z'));
        $identifiedCase1->setDatePhoto(new DateTime('2020-01-01T15:03:01.012345Z'));

        $identifiedCase2 = new IdentifiedCase();
        $identifiedCase2->setPhotoFilename('/home/images/');
        $identifiedCase2->setUuid('jafasfrtetgrvgdg');
        $identifiedCase2->setTemperature(39);
        $identifiedCase2->setFirstDate(new DateTime('2020-01-01T15:03:01.012345Z'));
        $identifiedCase2->setDatePhoto(new DateTime('2020-01-01T15:03:01.012345Z'));

        $repositoryMock = $this->createMock(ObjectRepository::class);
        $emMock = $this->createMock(EntityManagerInterface::class);
        $repositoryMock
            ->method('findAll')
            ->willReturn([$identifiedCase1, $identifiedCase2]);
        $emMock
            ->method('getRepository')
            ->willReturn($repositoryMock);

        $transformer = new IdentifiedCaseTransformer($emMock);
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $enterpriseTransformer = new EnterpriseTransformer();
        $userTransformer = new UserTransformer();
        $tokenMock = $this->createMock(TokenInterface::class);
        $tokenMock->method('getUser')->willReturn(new User());
        $tokenStorageMock = $this->createMock(TokenStorageInterface::class);
        $tokenStorageMock->method('getToken')->willReturn($tokenMock);
        $userHandler = new UserHandler($emMock, $userTransformer, $tokenStorageMock);

        $handler = new IdentifiedCaseHandler(
            $emMock,
            $validator,
            $transformer,
            $enterpriseTransformer,
            $userHandler
        );

        $result = $handler->getList();

        $dto1 = new IdentifiedCaseDTO();
        $dto1->photoFilename = '/home/images/';
        $dto1->uuid = 'jafasfrtetgrvgdg';
        $dto1->temperature = 39;
        $dto1->firstDate = new DateTime('2020-01-01T15:03:01.012345Z');
        $dto1->datePhoto = new DateTime('2020-01-01T15:03:01.012345Z');
        $arr[] = $dto1;

        $dto2 = new IdentifiedCaseDTO();
        $dto2->photoFilename = '/home/images/';
        $dto2->uuid = 'jafasfrtetgrvgdg';
        $dto2->temperature = 39;
        $dto2->firstDate = new DateTime('2020-01-01T15:03:01.012345Z');
        $dto2->datePhoto = new DateTime('2020-01-01T15:03:01.012345Z');
        $arr[] = $dto2;

        $this->assertCount(2, $result);
        $this->assertEquals($arr, $result);
    }
}
