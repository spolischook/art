<?php

namespace Tests\Behat\Elements;

use SensioLabs\Behat\PageObjectExtension\PageObject\Element;

class PictureField extends Element implements SonataField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Picture']];

    /**
     * {@inheritdoc}
     */
    public function getError()
    {
        $error = $this->getParent()->getParent()->getParent()
            ->find('css', '.sonata-ba-field-error-messages');

        if (null === $error) {
            return null;
        }

        return $error->getText();
    }
}
