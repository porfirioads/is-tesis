<?php

namespace Tests\Feature;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

class F02_GetReports implements Context
{
    /**
     * @Given /^the reports list has items$/
     */
    public function theReportsListHasItems()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^the reports list is returned$/
     */
    public function theReportsListIsReturned()
    {
        throw new PendingException();
    }

    /**
     * @Then /^each element has the "([^"]*)" attribute$/
     */
    public function eachElementHasTheAttribute($arg1)
    {
        throw new PendingException();
    }
}
