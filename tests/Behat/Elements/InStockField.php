<?php

namespace Tests\Behat\Elements;

class InStockField extends SelectField
{
    /**
     * @var array|string
     */
    protected $selector = ['named' => ['field', 'In Stock']];
//    protected $selector = 'select[id$="_inStock"]';
}
