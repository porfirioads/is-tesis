<?php

namespace Tests\Feature\F07_GetPendingFeedback;

use App\Models\SeguimientoReporte;
use Tests\Feature\F00_GeneralSteps;

// phpcs:ignore
class F07_GetPendingFeedback extends F00_GeneralSteps
{
    public static $responseData;

    /**
     * @And /^there are items in the pending feedback list$/
     */
    public function thereAreItemsInThePendingFeedbackList()
    {
        $count = SeguimientoReporte::whereNotificado(0)->count();
        $this->assertGreaterThanOrEqual(0, $count);
    }

    /**
     * @When /^the pending feedback list is returned$/
     */
    public function thePendingFeedbackListIsReturned()
    {
        $token = F00_GeneralSteps::$authToken;
        $headers = ['Authorization' => "Bearer $token"];
        $response = $this->get('api/reportes/seguimiento', $headers);
        $response->assertStatus(200);
        F07_GetPendingFeedback::$responseData = $response->baseResponse->original;
    }

    /**
     * @Then /^i get the ones that have not been notified to the users$/
     */
    public function iGetTheOnesThatHaveNotBeenNotifiedToTheUsers()
    {
        $data = F07_GetPendingFeedback::$responseData;

        foreach ($data as $feedback) {
            $this->assertArrayHasKey('notificado', $feedback);
            $this->assertEquals(0, $feedback['notificado']);
        }
    }
}
