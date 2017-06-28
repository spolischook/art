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
     * {@inheritdoc}
     */
    public function validate($artWork, Constraint $constraint)
    {
        if (!is_object($artWork)) {
            return;
        }

        if (ArtWork::class !== get_class($artWork)) {
            return;
        }

        // Don't check price if work is not published
        if (!$artWork->getIsPublished()) {
            return;
        }

        if ($artWork->getPrice()) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->atPath('price')
            ->addViolation();
    }
}
