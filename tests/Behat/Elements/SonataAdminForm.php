<?php

namespace Tests\Behat\Elements;

use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Session;
use SensioLabs\Behat\PageObjectExtension\PageObject\Element;
use SensioLabs\Behat\PageObjectExtension\PageObject\Factory;
use Webmozart\Assert\Assert;

class SonataAdminForm extends Element
{
    /**
     * @var array|string $selector
     */
    protected $selector = 'div.sonata-ba-form form';

    /**
     * @var Factory
     */
    private $factory = null;

    /**
     * @param Session $session
     * @param Factory $factory
     */
    public function __construct(Session $session, Factory $factory)
    {
        parent::__construct($session, $factory);

        $this->factory = $factory;
    }

    /**
     * Fill form with values
     * @param TableNode $table
     */
    public function fill(TableNode $table)
    {
        foreach ($table->getRows() as $row) {
            list($label, $value) = $row;
            $this->fillField($label, $value);
        }
    }

    /**
     * Assert form values
     * @param TableNode $table
     */
    public function assertValues(TableNode $table)
    {
        foreach ($table->getRows() as $row) {
            list($label, $value) = $row;
            $field = $this->findField($label);
            Assert::notNull($field, sprintf('Field with locator "%s" not found', $label));
            Assert::eq($field->getValue(), $value);
        }
    }

    /**
     * @param TableNode $table
     */
    public function assertErrors(TableNode $table)
    {
        foreach ($table->getRows() as $row) {
            list($label, $value) = $row;
            /** @var SonataField $field */
            $field = $this->findField($label);
            Assert::implementsInterface($field, SonataField::class);
            $error = $field->getError();

            Assert::notNull($error, sprintf('Field "%s" has no error', $label));
            Assert::eq($error, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findField($label)
    {
//        var_dump(parent::findField($label)->getParent()->getOuterHtml());
        try {
            return $this->factory->createElement($label.' Field');
        } catch (\InvalidArgumentException $e) {
            return parent::findField($label);
        }
    }
}
