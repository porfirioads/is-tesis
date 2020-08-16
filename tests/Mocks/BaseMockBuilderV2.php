<?php

namespace Tests\Mocks;

use Mockery;

class BaseMockBuilderV2
{
    protected $mock;

    public function __construct($classToMock)
    {
        $this->mock = Mockery::mock($classToMock);
    }

    protected function mockFunction($functionName, $returnValue)
    {
        $this->mock->allows([$functionName => $returnValue]);
        return $this;
    }

    public function getResult()
    {
        return $this->mock;
    }
}
