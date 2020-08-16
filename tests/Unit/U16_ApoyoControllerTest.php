<?php

namespace Tests\Unit;

use App\Http\Controllers\ApoyoController;
use App\ObjectFactoryV2;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;
use Tests\Mocks\SupportServiceMockBuilder;

// phpcs:ignore
class U16_ApoyoControllerTest extends DatabaseEachTestCase
{
    private function getSupports()
    {
        $controller = new ApoyoController();
        $request = new Request();
        return $controller->getSupports($request);
    }

    public function testGetSupportsReturnsStatus200()
    {
        $this->assertEquals(200, $this->getSupports()->status());
    }

    public function testGetSupportsReturnsExpectedKeys()
    {
//        $supportServiceMock = (new SupportServiceMockBuilder())
//            ->mockSuccessGetSupports()
//            ->getResult();
//
//        ObjectFactoryV2::getInstance()->setInstance(
//            SupportService::class,
//            $supportServiceMock
//        );

        $keys = [
            'id',
            'fecha_solicitud',
            'fecha_aceptacion',
            'fecha_entrega',
            'estatus',
            'monto',
            'apoyo_secretaria',
            'beneficiario',
        ];

        $apoyos = $this->getSupports()->getData();
        $this->assertIsArray($apoyos);
        $this->assertGreaterThanOrEqual(0, count($apoyos));

        foreach ($apoyos as $apoyo) {
            foreach ($keys as $key) {
                $this->assertObjectHasAttribute($key, $apoyo);
            }
        }

//        ObjectFactoryV2::getInstance()->setInstance(SupportService::class, null);
    }
}
