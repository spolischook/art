<?php

namespace Tests\Behat;

use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Element\NodeElement;
use Behat\MinkExtension\Context\RawMinkContext;
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectAware;
use Tests\Behat\Elements\SonataAdminForm;
use Tests\Behat\Elements\SonataField;
use Webmozart\Assert\Assert;

class FeatureContext extends RawMinkContext implements PageObjectAware
{
    use PageObjectAwareDictionary;

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * @var array
     */
    protected $assertedFields = [];


    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    /** @AfterScenario */
    public function after(AfterScenarioScope $scope)
    {
        if ($scope->getTestResult()->isPassed()) {
            return;
        }

        fwrite(STDOUT, $this->getSession()->getPage()->getOuterHtml());
    }

    /**
     * @Given /^(?:|I )open "(?P<pageName>[\w\s]+)"$/
     */
    public function openPage($pageName)
    {
        $this->getPage($pageName)->open();
    }

    /**
     * @Given /^(?:|I )fill form with:$/
     * @Given /^(?:|I )fill "(?P<formName>[\w\s]+)" with:$/
     */
    public function fillForm(TableNode $table, $formName = 'SonataAdminForm')
    {
        /** @var SonataAdminForm $form */
        $form = $this->getElement($formName);
        $form->fill($table);
    }

    /**
     * @Given /^(?:|I )wait a bit$/
     */
    public function waitABit()
    {
        fwrite(STDOUT, 'Press [RETURN] to continue...'.PHP_EOL);
        while (fgets(STDIN, 1024) == '') {
        }
    }

    /**
     * @When /^(?:|I )fill in "(?P<fieldName>[^"]*)" with a (?P<chapterNumber>\d+) character$/
     */
    public function fillInRandomText($fieldName, $chapterNumber)
    {
        $this->fillForm(new TableNode([
            [
                $fieldName,
                $this->faker->text($chapterNumber),
            ]
        ]));
    }

    /**
     * @Then /^filed "([^"]*)" should be editable$/
     */
    public function filedShouldBeEditable($fieldName)
    {
        $field = $this->getSession()->getPage()->findField($fieldName);
        Assert::true($field->isValid(), sprintf('Field "%s" not found', $fieldName));
        Assert::null(
            $field->getAttribute('disabled'),
            sprintf('Field "%s" is not editable, but should be', $fieldName)
        );
    }

    /**
     * @Then /^field "([^"]*)" should be not editable$/
     */
    public function fieldShouldBeNotEditable($fieldName)
    {
        $field = $this->getSession()->getPage()->findField($fieldName);
        Assert::true($field->isValid(), sprintf('Field "%s" not found', $fieldName));
        Assert::notNull(
            $field->getAttribute('disabled'),
            sprintf('Field "%s" is editable, but shouldn\'t', $fieldName)
        );
    }

    /**
     * @param TableNode $table
     * @param string $formName
     *
     * @Then /^form should contain values:$/
     * @Then /^"(?P<formName>[\w\s]+)" should contain values:$/
     */
    public function formShouldContainValues(TableNode $table, $formName = 'SonataAdminForm')
    {
        /** @var SonataAdminForm $form */
        $form = $this->getElement($formName);
        $form->assertValues($table);
    }

    /**
     * @param TableNode $table
     * @param string $formName
     *
     * @Then /^I should see form errors:$/
     * @Then /^I should see "(?P<formName>[\w\s]+)" errors:$/
     */
    public function iShouldSeeFormErrors(TableNode $table, $formName = 'SonataAdminForm')
    {
        /** @var SonataAdminForm $form */
        $form = $this->getElement($formName);
        foreach ($table->getRows() as $item) {
            $this->assertedFields[] = array_shift($item);
        }
        $form->assertErrors($table);
    }

    /**
     * @Then /^other fields has no errors$/
     * @Then /^other fields of "(?P<formName>[\w\s]+)" has no errors$/
     */
    public function otherFieldsHasNoErrors($formName = 'SonataAdminForm')
    {
        /** @var SonataAdminForm $form */
        $form = $this->getElement($formName);
        $labels = array_filter(array_unique(array_map(function (NodeElement $element) {
            return $element->getText();
        }, $form->findAll('css', 'label'))));

        $otherFields = array_diff($labels, $this->assertedFields);

        foreach ($otherFields as $otherField) {
            /** @var SonataField $element */
            $element = $this->getElement($otherField.' Field');
            Assert::implementsInterface($element, SonataField::class);
            Assert::null(
                $element->getError(),
                sprintf('Expect that "%s" field has no error but got "%s"', $otherField, $element->getError())
            );
        }
    }
}
