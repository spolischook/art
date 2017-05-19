<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
* @Annotation
*/
class SlugEditValidator extends ConstraintValidator
{
    /**
     * @var Registry
     */
    protected $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function validate($artWork, Constraint $constraint)
    {

        if ($artWork->getId()) {
            $dbObject = $this->doctrine->getRepository('AppBundle:ArtWork')->find($artWork->getId());
            $newSlug = $artWork->getSlug();
            $oldSlug = $dbObject->getSlug();
            if($dbObject->getWasPublished() && $oldSlug != $newSlug){
                $this->context->buildViolation($constraint->message)
                    ->atPath('slug')
                    ->addViolation();
            }

        }
    }
}
