<?php

namespace Tests\Behat\Elements;

class TitleField extends InputField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Title']];
}
