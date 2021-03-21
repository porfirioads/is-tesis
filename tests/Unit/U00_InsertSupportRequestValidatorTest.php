<?php

namespace Tests\Unit;

use App\Models\BenApoyo;
use App\Services\DatabaseEnums;
use Illuminate\Http\Request;
use App\Http\Validators\AddSupportRequestValidator;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class U00_InsertSupportRequestValidatorTest extends TestCase
{
    public function assertRequest($data, $expectedSuccess)
    {
        $request = new Request($data);
        $validator = new AddSupportRequestValidator($request);
        $success = $validator->validate();
        self::assertEquals($expectedSuccess, $success);
        $errors = $validator->getErrors();
        Log::debug($errors);
        return $errors;
    }

    public function testFieldsRequired()
    {
        $data = [];
        $errors = $this->assertRequest($data, false);
        self::assertArrayHasKey('estatus', $errors);
        self::assertArrayHasKey('beneficiario_id', $errors);
        self::assertArrayHasKey('apoyo_secretaria_id', $errors);
    }

    public function testStatusHasOptions()
    {
        $data = ['estatus' => 'someInvalidValue'];
        $errors = $this->assertRequest($data, false);
        self::assertArrayHasKey('estatus', $errors);

        $data = ['estatus' => DatabaseEnums::BEN_EST_PENDIENTE];
        $errors = $this->assertRequest($data, false);
        self::assertArrayNotHasKey('estatus', $errors);
    }

    public function testBeneficiaryIdExists()
    {
        $data = ['beneficiario_id' => 123123];
        $errors = $this->assertRequest($data, false);
        self::assertArrayHasKey('beneficiario_id', $errors);

        $apoyo = BenApoyo::first();
        $data = ['beneficiario_id' => $apoyo->id];
        $errors = $this->assertRequest($data, false);
        self::assertArrayNotHasKey('beneficiario_id', $errors);

    }
}
