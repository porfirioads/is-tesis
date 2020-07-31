<?php

namespace Tests\Unit;

use App\Http\Validators\RequestValidator;
use Illuminate\Http\Request;
use Tests\TestCase;

class U08_RequestValidatorTest extends TestCase
{
    public function testBaseValidatorException()
    {
        $request = new Request();
        $validator = new RequestValidator($request);
        $success = $validator->validate();
        $this->assertFalse($success);
    }
}
