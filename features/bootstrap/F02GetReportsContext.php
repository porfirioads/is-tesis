<?php

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

class F02GetReportsContext implements Context
{
//    use CreatesApplication;

    /**
     * @Given /^the reports list has items$/
     */
    public function theReportsListHasItems()
    {
        Assert::assertTrue(true);
    }

    /**
     * @When /^the reports list is returned$/
     */
    public function theReportsListIsReturned()
    {
        Assert::assertTrue(true);
    }
}
