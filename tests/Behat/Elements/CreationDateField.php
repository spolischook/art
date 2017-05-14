<?php

namespace Tests\Behat\Elements;

class CreationDateField extends DateTimeField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Creation date']];
}
