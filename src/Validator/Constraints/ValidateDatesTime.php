<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class validateDatesTime
 * @package App\Validator\Constraints
 * @Annotation
 */
class ValidateDatesTime extends Constraint
{
    public $message = 'Start time must be inforior to End time';

    public function validatedBy()
    {
        return ValidateDatesTimeValidator::class;
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}