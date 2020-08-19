<?php

namespace Tests\Feature;

use Behat\Behat\Context\Context;
use Tests\DatabaseTestCase;

// phpcs:ignore
class F00_GeneralSteps extends DatabaseTestCase implements Context
{
    public static $authToken;
    public static $requestData;
    public static $responseData;
    public static $responseStatus;

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

    public function httpGet($url, $expectedStatus, $data = [], $headers = [])
    {
        // TODO: Colocar $data como url params.
        $response = $this->get($url, $headers);
        $response->assertStatus($expectedStatus);
        $responseData = $response->baseResponse->original;
        F00_GeneralSteps::$responseData = $responseData;
    }

    public function httpPost($url, $data = [], $headers = [])
    {
        $response = $this->post($url, $data, $headers);
        $this->assertNotNull($response);

        F00_GeneralSteps::$responseData = json_decode(
            json_encode($response->baseResponse->original),
            true
        );

        F00_GeneralSteps::$responseStatus = $response->status();
    }

    public function assertArrayHasKeys($keys, $array)
    {
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $array);
        }
    }
}
