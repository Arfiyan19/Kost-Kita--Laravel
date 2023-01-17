<?php
namespace App\Services\Owner;
use ErrorException;

use App\Models\DataRekening;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BankService {

    // Data Rekening Store
    public function rekening($data)
    {
        try {
        $bank = DataRekening::where('user_id', Auth::id())->count();

        if ($bank == 3) {
            Session::flash('error','Maksimal akun bank hanya boleh 3 akun.');
        } else {
            $result = DataRekening::create([
            'user_id'     => Auth::id(),
            'no_rekening' => $data['no_rekening'],
            'nama_bank'   => $data['nama_bank'],
            'nama_pemilik'=> $data['nama_pemilik'],
            'is_active'   => $data['is_active'] ?? 0,
            ]);
            Session::flash('success','Rekening bank berhasil di simpan.');
            $result->save();
        }
        return back();
        } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
        }
    }

  // Update Rekening
  public function rekeningUpdate($params)
  {
    try {
        $banks = DataRekening::find($params->id_bank);
        $banks->update([
            'nama_bank'     => $params->nama_bank,
            'nama_pemilik'  => $params->nama_pemilik,
            'no_rekening'   => $params->no_rekening,
        ]);
        Session::flash('success','Data Bank Berhasil Di Update.');
        return $banks;
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

    //Aktifkan dan Non Aktifkan Bank
    public function IsActiveBank($params)
    {
        $bank = DataRekening::find($params->id);
        $bank->update([
            'is_active' => $bank->is_active == '1' ? '0' : '1'
        ]);
        $message = $bank->is_active == 1 ? 'Aktifkan' : 'Non Aktifkan';

        Session::flash('success','Data Bank Berhasil Di '. $message);
        return $bank;
    }
}
