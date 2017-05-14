<?php

namespace Tests\Behat\Elements;

class IsPublishedField extends SelectField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Is Published']];
}
