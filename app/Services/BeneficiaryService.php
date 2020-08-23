<?php

namespace App\Services;

use App\Models\BenBeneficiario;

class BeneficiaryService extends BaseService
{
    public function insertBeneficiary(array $data)
    {
        $beneficiary = new BenBeneficiario($data);
        $beneficiary->save();
        return $beneficiary;
    }
}
