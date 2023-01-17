<?php

namespace App\Services\Owner;
use ErrorException;
use App\Models\Transaction;
use Auth;
use Session;
use Carbon\Carbon;

class PenghuniService {

  // Penghuni
  public function penghuni()
  {
    try {
      if (!empty(Auth::user()->kamar->user_id)) {
        $penghuni = Transaction::where('status','Proses')->where('pemilik_id', Auth::user()->kamar->user_id)->orderBy('created_at','DESC')->get();

        return view('pemilik.penghuni.index', compact('penghuni'));
      } else {
        Session::flash('error','Data Kamar Masih Kosong');
        return redirect('/home');
      }
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }
}