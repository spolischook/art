<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PriceEdit extends Constraint
{
    public $message = 'Price is required';
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
