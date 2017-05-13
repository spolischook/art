<?php

namespace Tests\Behat\Elements;

class MaterialsField extends InputField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Materials']];
}
