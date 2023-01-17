<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{DataUser,User,Testimoni};
use Auth;
use Session;

class ProfileController extends Controller
{
    //Profile
    public function profile()
    {
      return view('pemilik.profile.index');
    }

    // Proses Payment
    public function payment_profile(Request $request, $user_id)
    {
      $request->validate([
        'nama_bank' => 'required',
        'nama_pemilik' => 'required',
        'nomor_rekening' => 'required',
      ]);

      $datauser = DataUser::where('user_id', $user_id)->first();
      $datauser->nama_bank      = $request->nama_bank;
      $datauser->nama_pemilik   = $request->nama_pemilik;
      $datauser->nomor_rekening = $request->nomor_rekening;
      $datauser->save();

      Session::flash('success','Data Payment Berhasil Disimpan');
      return back();
    }

    // Testimoni
    public function testimoni(Request $request)
    {
      Testimoni::create([
        'user_id'   => Auth::id(),
        'testimoni' => $request->testimoni
      ]);

      return back();
    }
}
