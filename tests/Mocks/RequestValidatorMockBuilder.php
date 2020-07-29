<?php

namespace Tests\Mocks;

use App\Http\Validators\RequestValidator;
use Mockery;

class RequestValidatorMockBuilder
{
    private $mock;

    private function __construct()
    {
        $this->mock = Mockery::mock(RequestValidator::class);
    }

    public static function create()
    {
        return new RequestValidatorMockBuilder();
    }

    public static function successValidation()
    {
        return RequestValidatorMockBuilder::create()
            ->mockValidateTrue()
            ->mockGetErrorsEmpty()
            ->getResult();
    }

    public static function errorValidation()
    {
        return RequestValidatorMockBuilder::create()
            ->mockValidateFalse()
            ->mockGetErrors()
            ->getResult();
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

    public function mockValidateFalse()
    {
        $this->mockFunction('validate', false);
        return $this;
    }

    public function mockGetErrorsEmpty()
    {
        $this->mockFunction('getErrors', []);
        return $this;
    }

    public function mockGetErrors()
    {
        $this->mockFunction('getErrors', ['testing' => ['Error de prueba']]);
        return $this;
    }

    public function getResult()
    {
        return $this->mock;
    }
}
