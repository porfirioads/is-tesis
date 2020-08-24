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

    public function httpPut($url, $data = [], $headers = [])
    {
        $response = $this->put($url, $data, $headers);
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

    public function assertArrayHasValue($value, $array)
    {
        $obtained = json_encode($array, JSON_PRETTY_PRINT);

        \Log::debug($obtained);

        $this->assertContains(
            $value,
            $array,
            "Failed asserting that '$value' is in the array $obtained"
        );
    }

    public function assertErrorResponseHasValue($value, $field)
    {
        $data = F00_GeneralSteps::$responseData;
        $this->assertArrayHasKey('errors', $data);
        $this->assertArrayHasKey($field, $data['errors']);
        $this->assertArrayHasValue($value, $data['errors'][$field]);
    }
}
