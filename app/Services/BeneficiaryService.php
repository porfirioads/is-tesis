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

    public function searchBeneficiary(array $searchParams)
    {
        $wheres = [];

        foreach ($searchParams as $key => $value) {
            array_push($wheres, [$key, '=', $value]);
        }

        $beneficiaries = BenBeneficiario::where($wheres)->get();
        return $beneficiaries;
    }
}
