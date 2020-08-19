<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Http\Validators\AddSupportRequestValidator;
use App\Services\SupportService;
use Illuminate\Http\Request;

class ApoyoController extends Controller
{
    private $supportService;

    public function __construct()
    {
        // $this->supportService = ObjectFactoryV2::getInstance()->getSupportService();
        $this->supportService = new SupportService();
    }

    public function getSupports(Request $request)
    {
        $supports = $this->supportService->getSupports();
        return JsonResponse::ok($supports);
    }

    public function addSupportRequest(Request $request)
    {
        $validator = new AddSupportRequestValidator($request);

        if (!$validator->validate()) {
            return JsonResponse::error($validator->getErrors(), 400);
        }

        $result = $this->supportService->addSupportRequest($request->all());

        return JsonResponse::ok($result);
    }
}
