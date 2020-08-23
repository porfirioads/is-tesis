<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Http\Validators\InsertBeneficiaryValidator;
use App\Models\BenBeneficiario;
use App\Services\BeneficiaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class BeneficiarioController extends Controller
{
    private $beneficiaryService;

    public function __construct()
    {
        $this->beneficiaryService = new BeneficiaryService();
    }

    public function insertBeneficiary(Request $request)
    {
        $validator = new InsertBeneficiaryValidator($request);

        if (!$validator->validate()) {
            return JsonResponse::error($validator->getErrors(), 400);
        }

        $result = $this->beneficiaryService->insertBeneficiary($request->all());
        return JsonResponse::ok($result);
    }
}
