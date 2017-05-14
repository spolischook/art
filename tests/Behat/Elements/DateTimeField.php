<?php

namespace Tests\Behat\Elements;

use SensioLabs\Behat\PageObjectExtension\PageObject\Element;

class DateTimeField extends Element implements SonataField
{
    /**
     * @return string
     */
    public function getError()
    {
        $error = $this->getParent()
            ->getParent()
            ->getParent()
            ->find('css', '.sonata-ba-field-error-messages');

        if (null === $error) {
            return null;
        }

        return $error->getText();
    }
}
