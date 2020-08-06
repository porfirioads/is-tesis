<?php

namespace Tests\Feature;

use Behat\Behat\Context\Context;
use Tests\DatabaseTestCase;

// phpcs:ignore
class F00_GeneralSteps extends DatabaseTestCase implements Context
{
    public static $authToken;

    /**
     * @Given /^I am logged in the system$/
     */
    public function iAmLoggedInTheSystem()
    {
        F00_GeneralSteps::$authToken = null;
        $data = ['username' => 'porfirioads', 'password' => 'porfirioads'];
        $response = $this->post('api/login', $data);
        $response->assertStatus(200);
        $responseData = $response->baseResponse->original;
        F00_GeneralSteps::$authToken = $responseData['token'];
        $this->assertNotNull(F00_GeneralSteps::$authToken);
    }
}
