<?php

namespace Tests\Unit;

use App\Http\Validators\UpdateTipoReporteValidator;
use App\Services\DatabaseEnums;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;

// phpcs:ignore
class U12_UpdateTipoReporteValidatorTest extends DatabaseEachTestCase
{
    public function testValidationSuccess()
    {
        $data = [
            'reporte_id' => 1,
            'tipo' => DatabaseEnums::RT_JIAPAZ
        ];
        $request = new Request($data);
        $validator = new UpdateTipoReporteValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertTrue($success);
        $this->assertCount(0, $errors);
    }

    public function testValidatorAskForRequiredData()
    {
        $data = [];
        $request = new Request($data);
        $validator = new UpdateTipoReporteValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertFalse($success);
        $this->assertCount(2, $errors);
        $this->assertArrayHasKey('reporte_id', $errors);
        $this->assertContains('El id del reporte es requerido', $errors['reporte_id']);
        $this->assertArrayHasKey('tipo', $errors);
        $this->assertContains('El tipo es requerido', $errors['tipo']);
    }

    public function testValidatorCheckOptionsForTipo()
    {
        $data = [
            'reporte_id' => 1,
            'tipo' => 'otra cosa'
        ];
        $request = new Request($data);
        $validator = new UpdateTipoReporteValidator($request);
        $success = $validator->validate();
        $errors = $validator->getErrors();
        $this->assertFalse($success);
        $this->assertArrayHasKey('tipo', $errors);
        $this->assertContains(
            'El tipo debe ser alguno de los siguientes: ' .
            'baches, iluminación, basura, seguridad, jiapaz',
            $errors['tipo']
        );
    }
}
