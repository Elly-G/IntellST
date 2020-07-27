<?php

namespace App\Tests\Services;

use App\DTO\EnterpriseDTO;
use App\Entity\Enterprise;
use App\Services\EnterpriseHandler;
use App\Transformer\EnterpriseTransformer;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validation;

class EnterpriseHandlerTest extends TestCase
{
    private function getHandler(): EnterpriseHandler
    {
        $repositoryMock = $this->createMock(ObjectRepository::class);
        $emMock = $this->createMock(EntityManagerInterface::class);
        $emMock
            ->method('getRepository')
            ->willReturn($repositoryMock);

        $transformer = new EnterpriseTransformer();
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        return new EnterpriseHandler($emMock,
            $validator,
            $transformer);
    }

    private function getEnterpriseDTO(): EnterpriseDTO
    {
        $dto = new EnterpriseDTO();
        $dto->name = 'UTM';
        $dto->temperature = 38;
        $dto->restrictionPeriod = 14;

        return $dto;
    }

    public function testValidateEditEnterpriseOK(): void
    {
        $enterprise = new Enterprise();
        $enterprise->setName('UTM');
        $enterprise->setTemperature(38);
        $enterprise->setRestrictionPeriod(14);

        $handler = $this->getHandler();
        $dto = $this->getEnterpriseDTO();
        $dto->users = 1;

        $result = $handler->updateEnterprise($dto, $enterprise);

        $this->assertCount(0, $result);
    }

    public function testValidateMinTemperature(): void
    {
        $enterprise = new Enterprise();
        $enterprise->setName('UTM');
        $enterprise->setTemperature(38);
        $enterprise->setRestrictionPeriod(14);

        $handler = $this->getHandler();
        $dto = $this->getEnterpriseDTO();
        $dto->users = 1;
        $dto->temperature = 32;

        $result = $handler->updateEnterprise($dto, $enterprise);

        $this->assertCount(2, $result);
        $this->assertEquals('temperature', $result->get(0)->getPropertyPath());
        $this->assertEquals('This value should be between 34 and 38.', $result->get(0)->getMessage());
    }

    public function testValidateMaxTemperature(): void
    {
        $enterprise = new Enterprise();
        $enterprise->setName('UTM');
        $enterprise->setTemperature(38);
        $enterprise->setRestrictionPeriod(14);

        $handler = $this->getHandler();
        $dto = $this->getEnterpriseDTO();
        $dto->users = 1;
        $dto->temperature = 39;

        $result = $handler->updateEnterprise($dto, $enterprise);

        $this->assertCount(2, $result);
        $this->assertEquals('temperature', $result->get(0)->getPropertyPath());
        $this->assertEquals('This value should be between 34 and 38.', $result->get(0)->getMessage());
    }
}
