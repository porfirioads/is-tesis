<?php

namespace Tests\Unit;

use App\Http\Validators\DeleteReportValidator;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;

class U07_DeleteReportValidatorTest extends DatabaseEachTestCase
{
    public function testDeleteExistingReport()
    {
        $request = new Request(['reporte_id' => 1]);
        $validator = new DeleteReportValidator($request);
        $success = $validator->validate();
        $this->assertTrue($success);
        $this->assertCount(0, $validator->getErrors());
    }

    public function testDeleteInvalidReport()
    {
        $request = new Request();
        $validator = new DeleteReportValidator($request);
        $success = $validator->validate();
        $this->assertFalse($success);
        $this->assertCount(1, $validator->getErrors());
    }
}
