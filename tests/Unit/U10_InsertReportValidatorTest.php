<?php

namespace Tests\Unit;

use App\Http\Validators\InsertReportValidator;
use App\Services\DatabaseEnums;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Tests\DatabaseEachTestCase;

// phpcs:ignore
class U10_InsertReportValidatorTest extends DatabaseEachTestCase
{
    public function testValidationSuccess()
    {
        $data = [
            'tipo' => DatabaseEnums::RT_ILUMINACION,
            'lat' => 82,
            'lng' => -101,
            'foto' => UploadedFile::fake()->image('ejemplo.png')
        ];
        $request = new Request($data);
        $validator = new InsertReportValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertTrue($success);
        $this->assertCount(0, $errors);
    }

    public function testValidationWithErrors()
    {
        $data = [];
        $request = new Request($data);
        $validator = new InsertReportValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertFalse($success);
        $this->assertCount(4, $errors);
        $this->assertArrayHasKey('tipo', $errors);
        $this->assertArrayHasKey('lat', $errors);
        $this->assertArrayHasKey('lng', $errors);
        $this->assertArrayHasKey('foto', $errors);
        $data['foto'] = 'holamundo';
        $request = new Request($data);
        $validator = new InsertReportValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertFalse($success);
        $this->assertArrayHasKey('foto', $errors);
        $this->assertContains('La fotografía debe ser una imagen', $errors['foto']);
    }
}
