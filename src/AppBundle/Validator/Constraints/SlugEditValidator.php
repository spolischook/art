<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\ArtWork;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

/**
 * @Annotation
 */
class SlugEditValidator extends ConstraintValidator
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

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

        if (!$artWork->getId()) {
            return;
        }

        $dbObject = $this->em
            ->getUnitOfWork()
            ->getOriginalEntityData($artWork);

        // If work was not published, we don't care about slug
        if (!$dbObject['wasPublished']) {
            return;
        }

        $newSlug = $artWork->getSlug();
        $oldSlug = $dbObject['slug'];

        if ($oldSlug != $newSlug) {
            $this->context->buildViolation($constraint->message)
                ->atPath('slug')
                ->addViolation();
        }
    }
}
