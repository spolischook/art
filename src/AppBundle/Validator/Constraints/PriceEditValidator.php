<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\ArtWork;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
class PriceEditValidator extends ConstraintValidator
{
    /**
     * @param ArtWork $artWork
     *                         {@inheritdoc}
     */
    public function validate($artWork, Constraint $constraint)
    {
        if (!is_object($artWork)) {
            return;
        }

        if (ArtWork::class !== get_class($artWork)) {
            return;
        }

        if ($artWork->getIsPublished()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('price')
                ->addViolation();
        }
    }
}
