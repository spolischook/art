<?php

namespace AppBundle\Tests\Unit\AppBundle\Validator\Constraints;

use AppBundle\Entity\ArtWork;
use AppBundle\Validator\Constraints\SlugEdit;
use AppBundle\Validator\Constraints\SlugEditValidator;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Test\DoctrineTestHelper;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class SlugEditValidatorTest extends ConstraintValidatorTestCase
{
    /**
     * @var EntityManager
     */
    protected $em;

    protected function createValidator()
    {
        $config = DoctrineTestHelper::createTestConfiguration();
        $this->em = DoctrineTestHelper::createTestEntityManager($config);

        return new SlugEditValidator($this->em);
    }

    public function testConstraintTarget()
    {
        $constraint = new SlugEdit();
        $this->assertSame(Constraint::CLASS_CONSTRAINT, $constraint->getTargets());
    }

    public function testValidateNonObject()
    {
        $this->validator->validate([], new SlugEdit());
        $this->assertNoViolation();
    }

    public function testValidateNewEntity()
    {
        $this->validator->validate(new ArtWork(), new SlugEdit());
        $this->assertNoViolation();
    }

    public function testValidateOtherEntity()
    {
        $this->validator->validate(new \stdClass(), new SlugEdit());
        $this->assertNoViolation();
    }

    public function testValidateError()
    {
        $wasPublished = true;
        $oldSlug = 'picture';
        $newSlug = 'picture2';

        $artWork = $this->createArtWork(['slug' => $newSlug, 'id' => 5]);
        $this->em->getUnitOfWork()->setOriginalEntityData(
            $artWork,
            ['wasPublished' => $wasPublished, 'slug' => $oldSlug]
        );

        $this->validator->validate($artWork, new SlugEdit());
        $this->buildViolation("Slug shouldn't be edited because art work has been already published")
            ->atPath('property.path.slug')
            ->assertRaised();
    }

    /**
     * @dataProvider validDataProvider
     *
     * @param bool $wasPublished
     * @param string $oldSlug
     * @param string $newSlug
     */
    public function testValidateWithoutErrors($wasPublished, $oldSlug, $newSlug)
    {
        $artWork = $this->createArtWork(['slug' => $newSlug, 'id' => 5]);

        $this->em->getUnitOfWork()->setOriginalEntityData(
            $artWork,
            ['wasPublished' => $wasPublished, 'slug' => $oldSlug]
        );

        $this->validator->validate($artWork, new SlugEdit());
        $this->assertNoViolation();
    }

    public function validDataProvider()
    {
        return [
            ['wasPublished' => false, 'oldSlug' => 'picture', 'newSlug' => 'picture'],
            ['wasPublished' => false, 'oldSlug' => 'picture', 'newSlug' => 'picture2'],
            ['wasPublished' => true, 'oldSlug' => 'picture', 'newSlug' => 'picture'],
        ];
    }

    /**
     * @param array $values
     * @return ArtWork
     */
    private function createArtWork(array $values)
    {
        $artWork = new ArtWork();
        $r = new \ReflectionObject($artWork);

        foreach ($values as $property => $value) {
            $p = $r->getProperty($property);
            $p->setAccessible(true);
            $p->setValue($artWork, $value);
        }

        return $artWork;
    }
}
