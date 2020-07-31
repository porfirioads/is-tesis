<?php

namespace Tests\Unit;

use App\Http\Validators\InsertFeedbackValidator;
use App\Services\DatabaseEnums;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;

class U09_InsertFeedbackValidatorTest extends DatabaseEachTestCase
{
    public function testValidationSuccess()
    {
        $data = [
            'estatus' => DatabaseEnums::RE_PENDIENTE,
            'mensaje' => 'El reporte volverá a la cola de espera.',
            'reporte_id' => 1
        ];
        $request = new Request($data);
        $validator = new InsertFeedbackValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertTrue($success);
        $this->assertCount(0, $errors);
    }

    public function testValidationWithErrors()
    {
        $data = [];
        $request = new Request($data);
        $validator = new InsertFeedbackValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertFalse($success);
        $this->assertCount(3, $errors);
        $this->assertArrayHasKey('estatus', $errors);
        $this->assertArrayHasKey('mensaje', $errors);
        $this->assertArrayHasKey('reporte_id', $errors);
    }
}
