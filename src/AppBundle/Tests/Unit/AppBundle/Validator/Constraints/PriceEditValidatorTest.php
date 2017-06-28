<?php

namespace AppBundle\Tests\Unit\AppBundle\Validator\Constraints;

use AppBundle\Entity\ArtWork;
use AppBundle\Validator\Constraints\PriceEdit;
use AppBundle\Validator\Constraints\PriceEditValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class PriceEditValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new PriceEditValidator();
    }

    public function testConstraintTarget()
    {
        $constraint = new PriceEdit();
        $this->assertSame(Constraint::CLASS_CONSTRAINT, $constraint->getTargets());
    }

    public function testValidateNonObject()
    {
        $this->validator->validate([], new PriceEdit());
        $this->assertNoViolation();
    }

    public function testValidateNewEntity()
    {
        $this->validator->validate(new ArtWork(), new PriceEdit());
        $this->assertNoViolation();
    }

    public function testValidateOtherEntity()
    {
        $this->validator->validate(new \stdClass(), new PriceEdit());
        $this->assertNoViolation();
    }

    public function testValidateNotPublishedWithoutPrice()
    {
        $artWork = new ArtWork();
        $artWork->setPrice(null)->setIsPublished(false);

        $this->validator->validate($artWork, new PriceEdit());
        $this->assertNoViolation();
    }

    public function testValidatePublishedWithoutPrice()
    {
        $artWork = new ArtWork();
        $artWork->setPrice(null)->setIsPublished(true);

        $this->validator->validate($artWork, new PriceEdit());

        $this->buildViolation('Price is required')
            ->atPath('property.path.price')
            ->assertRaised();
    }

    public function testValidateNotPublishedWithPrice()
    {
        $artWork = new ArtWork();
        $artWork->setPrice(100)->setIsPublished(false);

        $this->validator->validate($artWork, new PriceEdit());
        $this->assertNoViolation();
    }

    public function testValidatePublishedWithPrice()
    {
        $artWork = new ArtWork();
        $artWork->setPrice(100)->setIsPublished(true);

        $this->validator->validate($artWork, new PriceEdit());
        $this->assertNoViolation();
    }
}
