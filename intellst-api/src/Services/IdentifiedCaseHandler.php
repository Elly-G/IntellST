<?php

namespace App\Services;

use App\DTO\EnterpriseDTO;
use App\DTO\IdentifiedCaseDTO;
use App\Entity\Enterprise;
use App\Entity\IdentifiedCase;
use App\Repository\EnterpriseRepository;
use App\Repository\IdentifiedCaseRepository;
use App\Transformer\EnterpriseTransformer;
use App\Transformer\IdentifiedCaseTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IdentifiedCaseHandler
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var ValidatorInterface */
    private $validator;

    /** @var IdentifiedCaseTransformer */
    private $identifiedCaseTransformer;

    /** @var UserHandler */
    private $userHandler;

    /** @var EnterpriseTransformer */
    private $enterpriseTransformer;

    /**@var IdentifiedCaseRepository */
    private $identifiedCaseRepository;

    /**@var EnterpriseRepository */
    private $enterpriseRepository;

    public function __construct(
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        IdentifiedCaseTransformer $identifiedCaseTransformer,
        EnterpriseTransformer $enterpriseTransformer,
        UserHandler $userHandler
    ) {
        $this->em = $em;
        $this->validator = $validator;
        $this->identifiedCaseTransformer = $identifiedCaseTransformer;
        $this->identifiedCaseRepository = $this->em->getRepository(IdentifiedCase::class);
        $this->enterpriseRepository = $this->em->getRepository(Enterprise::class);
        $this->enterpriseTransformer = $enterpriseTransformer;
        $this->userHandler = $userHandler;
    }

    public function updateIdentifiedCase(IdentifiedCaseDTO $dto): ConstraintViolationListInterface
    {
        $identifiedCase = $this->identifiedCaseTransformer->transformDTOToEntity($dto);

        $errors = $this->validator->validate($identifiedCase);
        $dtoErrors = $this->validator->validate($dto, null);

        foreach ($dtoErrors as $error) {
            $errors->add($error);
        }

        if ($errors->count() === 0) {
            $this->em->persist($identifiedCase);
            $this->em->flush();
        }

        return $errors;
    }

    public function getList(): array
    {
        $identifiedCases = $this->identifiedCaseRepository->findAll();
        $arr = [];
        foreach ($identifiedCases as $identifiedCase) {
            $identifiedCaseDTO = $this->identifiedCaseTransformer->transformEntityToDTO($identifiedCase);
            $arr[] = $identifiedCaseDTO;
        }

        return $arr;
    }

    public function updateIdentifiedCaseAllowEntrance(IdentifiedCase $identifiedCase): ConstraintViolationListInterface
    {
        $identifiedCase = $this->identifiedCaseTransformer->transformDTOToEntityAllowEntrance($identifiedCase);

        $errors = $this->validator->validate($identifiedCase);

        if ($errors->count() === 0) {
            $this->em->persist($identifiedCase);
            $this->em->flush();
        }

        return $errors;
    }

    public function getIdentifiedCases(): array
    {
        $user = $this->userHandler->getCurrentUser();
        $dto = $this->getEnterprise($user->enterprise);
        $temperature = $dto->temperature;
        $days = $dto->restrictionPeriod;
        $cases = $this->identifiedCaseRepository->getNewIdentifiedCase($days, $temperature);
        $arr = [];
        foreach ($cases as $identifiedCase) {
            $identifiedCaseDTO = $this->identifiedCaseTransformer->transformEntityToDTO($identifiedCase);
            $arr[] = $identifiedCaseDTO;
        }

        return $arr;
    }

    public function isReturnAttempt(IdentifiedCaseDTO $dto): bool
    {
        $user = $this->userHandler->getCurrentUser();
        $enterpriseDTO = $this->getEnterprise($user->enterprise);
        $temperature = $enterpriseDTO->temperature;
        $days = $enterpriseDTO->restrictionPeriod;
        $uuid = $dto->uuid;
        $list = $this->identifiedCaseRepository->getReturnAttempts($days, $temperature, $uuid);

        return !(empty($list));
    }

    public function isEntranceAllowed(IdentifiedCaseDTO $dto): bool
    {
        return $this->identifiedCaseRepository->isEntranceAllowed($dto->uuid);
    }

    private function getEnterprise(int $id): EnterpriseDTO
    {
        $enterprise = $this->enterpriseRepository->find($id);

        return $this->enterpriseTransformer->transformEntityToDTO($enterprise);
    }

    public function getRecentReturnAttempts(): array
    {
        $user = $this->userHandler->getCurrentUser();
        $enterpriseDTO = $this->getEnterprise($user->enterprise);
        $temperature = $enterpriseDTO->temperature;
        $days = $enterpriseDTO->restrictionPeriod;
        $identifiedCases = $this->identifiedCaseRepository->getNewIdentifiedCase($days, $temperature);
        $arr = [];
        foreach ($identifiedCases as $identifiedCase) {
            $identifiedCaseDTO = $this->identifiedCaseTransformer->transformEntityToDTO($identifiedCase);
            $returnAttempt = $this->identifiedCaseRepository->getListOfReturnAttempts(
                $identifiedCaseDTO->uuid,
                $identifiedCaseDTO->firstDate
            );
            if (!empty($returnAttempt)) {
                foreach ($returnAttempt as $case) {
                    $caseDTO = $this->identifiedCaseTransformer->transformEntityToDTO($case);
                    $arr[] = $caseDTO;
                }
            }
        }

        return $arr;
    }

    public function getNumberOfEntriesPerDay(): array
    {
        $arr = [];
        $date = new \DateTime("midnight");

        for ($day = 0; $day <= 6; $day++) {
            $date->modify("-1 day");
            $stringValue = $date->format('Y-m-d');
            $sum = $this->identifiedCaseRepository->getNumberOfEntriesPerDay($day);
            $arr[$stringValue] = $sum;
        }

        return $arr;
    }

    public function getNumberOfValidEntriesPerDay(): array
    {
        $user = $this->userHandler->getCurrentUser();
        $dto = $this->getEnterprise($user->enterprise);
        $temperature = $dto->temperature;
        $arr = [];
        $date = new \DateTime("midnight");

        for ($day = 0; $day <= 6; $day++) {
            $date->modify("-1 day");
            $stringValue = $date->format('Y-m-d');
            $sum = $this->identifiedCaseRepository->getNumberOfValidEntriesPerDay($day, $temperature);
            $arr[$stringValue] = $sum;
        }

        return $arr;
    }

    public function getNumberOfReturnsOfBannedPeople(): array
    {
        $user = $this->userHandler->getCurrentUser();
        $enterprise = $this->getEnterprise($user->enterprise);
        $temperature = $enterprise->temperature;
        $days = $enterprise->restrictionPeriod;
        $arr = [];
        $date = new \DateTime("midnight");

        for ($day = 0; $day <= 6; $day++) {
            $sum = 0;
            $identifiedCases = $this->identifiedCaseRepository->getOldIdentifiedCase($days, $temperature, $day);
            foreach ($identifiedCases as $identifiedCase) {
                $identifiedCaseDTO = $this->identifiedCaseTransformer->transformEntityToDTO($identifiedCase);
                $returnAttempt = $this->identifiedCaseRepository->getNumberOfReturnsOfBannedPeople(
                    $identifiedCaseDTO->uuid,
                    $day
                );
                $sum += $returnAttempt;
            }
            $date->modify("-1 day");
            $stringValue = $date->format('Y-m-d');
            $arr [$stringValue] = $sum;
        }

        return $arr;
    }
}
