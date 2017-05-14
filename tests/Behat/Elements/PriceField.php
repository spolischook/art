<?php

namespace Tests\Behat\Elements;

class PriceField extends InputField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'Price']];
}
