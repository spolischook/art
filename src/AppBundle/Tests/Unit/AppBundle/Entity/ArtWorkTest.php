<?php

namespace AppBundle\Tests\Unit\AppBundle\Entity;

use AppBundle\Entity\ArtWork;
use PHPUnit\Framework\TestCase;

class ArtWorkTest extends TestCase
{
    public function testWasPublishedProperty()
    {
        $artWork = new ArtWork();

        $this->assertFalse($artWork->getWasPublished());
        $this->assertFalse($artWork->isWasPublished());

        $artWork->setIsPublished(false);

        $this->assertFalse($artWork->getWasPublished());
        $this->assertFalse($artWork->isWasPublished());

        $artWork->setIsPublished(true);

        $this->assertTrue($artWork->getWasPublished());
        $this->assertTrue($artWork->isWasPublished());

        $artWork->setIsPublished(false);

        $this->assertTrue($artWork->getWasPublished());
        $this->assertTrue($artWork->isWasPublished());
    }
}
