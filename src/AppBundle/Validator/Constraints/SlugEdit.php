<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class SlugEdit extends Constraint
{
    public $message = "Slug shouldn't be edited because art work has been already published";
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
