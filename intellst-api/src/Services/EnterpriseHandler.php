<?php

namespace App\Services;

use App\DTO\EnterpriseDTO;
use App\Transformer\EnterpriseTransformer;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EnterpriseRepository;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Enterprise;

class EnterpriseHandler
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var EnterpriseRepository
     */
    private $enterpriseRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var EnterpriseTransformer
     */
    private $transformer;

    public function __construct(
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        EnterpriseTransformer $transformer
    ) {
        $this->em = $em;
        $this->validator = $validator;
        $this->transformer = $transformer;
        $this->enterpriseRepository = $this->em->getRepository(Enterprise::class);
    }

    public function updateEnterprise(EnterpriseDTO $dto, Enterprise $enterprise): ConstraintViolationListInterface
    {
        $enterprise = $this->transformer->transformDTOToEntity($dto, $enterprise);

        $errors = $this->validator->validate($enterprise);
        $dtoErrors = $this->validator->validate($dto, null);

        foreach ($dtoErrors as $error) {
            $errors->add($error);
        }

        if ($errors->count() === 0) {
            $this->em->persist($enterprise);
            $this->em->flush();
        }

        return $errors;
    }
}
