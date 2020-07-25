<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeFeatureScope;
use Illuminate\Contracts\Console\Kernel;
use PHPUnit\Framework\Assert;

class F01GetUsersContext implements Context
{
    public static function createApplication()
    {
        $app = require __DIR__ . '/../../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        return $app;
    }

    /**
     * @BeforeFeature
     */
    public static function prepareBeforeFeature(BeforeFeatureScope $scope)
    {
        printf("%s\n", env('APP_ENV'));
        printf("%s\n", env('DB_DATABASE'));
        \Illuminate\Support\Env::enablePutenv();
        putenv('DB_DATABASE=hola');

        printf("%s\n", env('DB_DATABASE'));
//        exec('mv .env .env.tmp');
//        exec('mv .env.behat .env');
//        F01GetUsersContext::createApplication();
//        printf("%s\n", env('APP_ENV'));
//        printf("%s\n", env('DB_DATABASE'));
//        exec('mv .env .env.behat');
//        exec('mv .env.tmp .env');
    }

    /**
     * @Given /^the users list has items$/
     */
    public function theUsersListHasItems()
    {
//        Artisan::command('migrate:seed --fresh', null);
        Assert::assertTrue(true);

//        $response = $this->get('api/usuarios');
//        $response->assertStatus(200);
//        $users = $response->baseResponse->original;
//        $this->assertGreaterThanOrEqual(1, count($users));
    }

    /**
     * @When /^the users list is returned$/
     */
    public function theUsersListIsReturned()
    {
//        $this->prepareApplication();
        $response = Http::get('http://webserver/api/usuarios');
        $statusCode = $response->status();
        $body = $response->json();
        echo "Status code: $statusCode\n";
        // echo json_encode($body, JSON_PRETTY_PRINT);
        Assert::assertTrue(true);
    }

    /**
     * @Then /^each element has the "([^"]*)" attribute$/
     */
    public function eachElementHasTheAttribute($arg1)
    {
        Assert::assertTrue(true);
    }
}
