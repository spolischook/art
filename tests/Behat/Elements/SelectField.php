<?php

namespace Tests\Behat\Elements;

use SensioLabs\Behat\PageObjectExtension\PageObject\Element;

class SelectField extends Element implements SonataField
{
    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->getParent()->find('css', 'span.select2-chosen')->getText();
    }

    /**
     * {@inheritdoc}
     */
    public function getError()
    {
        $error = $this->getParent()
            ->find('css', 'onata-ba-field-error-messages');

        if (null === $error) {
            return null;
        }

        return $error->getText();
    }
}
