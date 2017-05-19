<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

/**
 * @Annotation
 */
class SlugEditValidator extends ConstraintValidator
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($artWork, Constraint $constraint)
    {
        if ($artWork->getId()) {
            $dbObject = $this->em
                ->getUnitOfWork()
                ->getOriginalEntityData($artWork);
            $newSlug = $artWork->getSlug();
            $oldSlug = $dbObject['slug'];
            if ($dbObject['wasPublished'] && $oldSlug != $newSlug) {
                $this->context->buildViolation($constraint->message)
                    ->atPath('slug')
                    ->addViolation();
            }
        }
    }
}
