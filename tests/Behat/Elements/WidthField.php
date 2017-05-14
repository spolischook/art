<?php

namespace Tests\Behat\Elements;

class WidthField extends InputField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Width']];
}
