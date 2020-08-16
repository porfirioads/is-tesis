<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\ObjectFactoryV2;
use Illuminate\Http\Request;

class ApoyoController extends Controller
{
    private $supportService;

    public function __construct()
    {
        $this->supportService = ObjectFactoryV2::getInstance()->getSupportService();
    }

    public function getSupports(Request $request)
    {
        $supports = $this->supportService->getSupports();
        return JsonResponse::ok($supports);
    }
}
