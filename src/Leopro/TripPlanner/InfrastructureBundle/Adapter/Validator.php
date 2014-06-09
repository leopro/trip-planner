<?php

namespace Leopro\TripPlanner\InfrastructureBundle\Adapter;

use Leopro\TripPlanner\Application\Contract\Validator as ApplicationValidatorInterface;
use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator implements ApplicationValidatorInterface
{
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $value
     * @return \Leopro\TripPlanner\Domain\Contract\Collection
     */
    public function validate($value)
    {
        $applicationErrors = new ArrayCollection();
        $errors = $this->validator->validate($value);
        foreach ($errors as $error) {
            $applicationErrors->set($error->getPropertyPath(), $error->getMessage());
        }

        return $applicationErrors;
    }
} 