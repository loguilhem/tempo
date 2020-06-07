<?php


namespace App\Validator\Constraints;

use App\Entity\Time;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class validateDatesTime
 * @package App\Validator\Constraints
 */
class ValidateDatesTimeValidator extends ConstraintValidator
{
    public function validate($protocol, Constraint $constraint)
    {
        /** @var Time $protocol */
        if ($protocol->getStartTime() >= $protocol->getEndTime()) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}