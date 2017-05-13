<?php

namespace Tests\Behat\Elements;

class SlugField extends InputField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Slug']];
}
