<?php

namespace Tests\Behat\Elements;

class HeightField extends InputField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Height']];
}
