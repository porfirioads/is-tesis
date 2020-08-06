<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Behat\Behat\Context\Context;
use Tests\DatabaseTestCase;

// phpcs:ignore
class F01_GetUsers extends DatabaseTestCase implements Context
{
    private static $users;

    /**
     * @Given /^the users list has items$/
     */
    public function theUsersListHasItems()
    {
        $count = Usuario::count();
        $this->assertGreaterThanOrEqual(1, $count);
    }

    /**
     * @Given /^the users list is empty$/
     */
    public function theUsersListIsEmpty()
    {
        Usuario::where('id', '>', 0)->delete();
        $count = Usuario::count();
        $this->assertEquals(0, $count);
    }

    /**
     * @When /^the users list is returned$/
     */
    public function theUsersListIsReturned()
    {
        $response = $this->get('api/usuarios');
        $response->assertStatus(200);
        F01_GetUsers::$users = $response->baseResponse->original;
        $this->assertNotNull(F01_GetUsers::$users);
    }

    /**
     * @Then /^each user has the "([^"]*)" attribute$/
     */
    public function eachUserHasTheAttribute($attribute)
    {
        $this->assertNotNull(F01_GetUsers::$users);

        foreach (F01_GetUsers::$users as $user) {
            $this->assertArrayHasKey($attribute, $user);
        }

        $this->assertTrue(true);
    }

    /**
     * @Then /^no users are returned$/
     */
    public function noUsersAreReturned()
    {
        $this->assertCount(0, F01_GetUsers::$users);
    }
}
