<?php

namespace Tests\Mocks;

use App\Http\Validators\InsertReportValidator;
use Mockery;

class InsertReportValidatorMockBuilder
{
    private $mock;
    private $methods = [
        'validate',
        'getErrors'
    ];

    private function __construct()
    {
        $this->mock = Mockery::mock(InsertReportValidator::class);
    }

    public static function create()
    {
        $mockBuilder = new InsertReportValidatorMockBuilder();

        foreach ($mockBuilder->methods as $method) {
            $mockBuilder->mockFunction($method, null);
        }

        return $mockBuilder;
    }

    protected function mockFunction($functionName, $returnValue)
    {
        $this->mock->allows([$functionName => $returnValue]);
        return $this;
    }

    public function mockValidateTrue()
    {
        $this->mockFunction('validate', true);
        return $this;
    }

    public function mockgetErrorsEmpty()
    {
        $this->mockFunction('getErrors', []);
        return $this;
    }

    public function getResult()
    {
        return $this->mock;
    }
}
