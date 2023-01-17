<?php

namespace App\Http\Controllers\Owner;
use ErrorException;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Owner\BankService;
use App\Http\Requests\BankRequest;

class BankController extends Controller
{
    protected $bank;

    public function __construct(BankService $bank)
    {
        $this->bank = $bank;
    }


    // Rekening
    public function rekening(BankRequest $request)
    {
        try {
            $result = $this->bank->rekening($request->all());
        return $result;
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    // Rekening Update
    public function rekeningUpdate(BankRequest $request)
    {
        try {
            $result = $this->bank->rekeningUpdate($request);
            return $result;
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    // Aktifkan dan Non Aktifkan Bank
    public function IsActiveBank(Request $request)
    {
        $result = $this->bank->IsActiveBank($request);
        return $result;
    }
}
