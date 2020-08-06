<?php

namespace Tests\Unit;

use App\Http\Validators\DeleteFeedbackValidator;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;

// phpcs:ignore
class U06_DeleteFeedbackValidatorTest extends DatabaseEachTestCase
{
    public function testDeleteExistingFeedback()
    {
        $request = new Request(['seguimiento_id' => 1]);
        $validator = new DeleteFeedbackValidator($request);
        $success = $validator->validate();
        $this->assertTrue($success);
        $this->assertCount(0, $validator->getErrors());
    }

    public function testDeleteInvalidFeedback()
    {
        $request = new Request([]);
        $validator = new DeleteFeedbackValidator($request);
        $success = $validator->validate();
        $this->assertFalse($success);
        $this->assertCount(1, $validator->getErrors());
    }
}
