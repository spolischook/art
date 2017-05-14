<?php

namespace Tests\Behat\Elements;

class FullDescriptionField extends InputField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Full description']];
}
