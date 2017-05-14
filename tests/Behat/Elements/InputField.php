<?php

namespace Tests\Behat\Elements;

use SensioLabs\Behat\PageObjectExtension\PageObject\Element;

class InputField extends Element implements SonataField
{
    /**
     * {@inheritdoc}
     */
    public function getError()
    {
        $error = $this->getParent()
            ->find('css', '.sonata-ba-field-error-messages');

        if (null === $error) {
            return null;
        }

        return $error->getText();
    }
}
