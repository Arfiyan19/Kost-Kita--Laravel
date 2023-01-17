<?php

namespace App\Services\Owner;
use ErrorException;
use App\Models\{Promo,kamar};
use Session;
use Auth;


class PromoService {

  // Promo Kamar
  public function promo()
  {
    try {
      $promo = Promo::with('kamar')->where('pemilik_id',Auth::id())->get();
      // return $promo;
      return \view('pemilik.kamar.promo', \compact('promo'));
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Promo Create
  public function promoCreate()
  {
    try {
      $kamar = kamar::doesntHave('promo')
      ->where('user_id', Auth::id())
      ->get();

      // $harga
      return view('pemilik.kamar.promoCreate', \compact('kamar'));
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Promo Process
  public function promoProces($params)
  {
    try {
      $promo = Promo::create([
        'kamar_id'          => $params['kamar_id'],
        'pemilik_id'        => Auth::id(),
        'harga_promo'       => $params['harga_promo'],
        'keterangan'        => $params['keterangan'],
        'start_date_promo'  => $params['start_date_promo'],
        'end_date_promo'    => $params['end_date_promo'],
        'status'            => '1'
      ]);
      Session::flash('success','Promo berhasil ditambah');
      return redirect()->route('kamar.promo');
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Inactive Promo
  public function inactivePromo($params)
  {
    try {
      $inactive = Promo::find($params);
      $inactive->update([
        'status'  => $inactive->status == '1' ? '0' : '1',
        'start_date_promo' => NULL,
        'end_date_promo' => NULL
      ]);
      Session::flash('success','Promo berhasil di update');
      return $inactive;
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Promo Create
  public function promoEdit($id)
  {
    try {
      $kamar = Promo::with('kamar')->whereId($id)->first();
      return view('pemilik.kamar.promoEdit', \compact('kamar'));
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Promo Update
  public function promoUpdate($params,$id)
  {
    try {
      $promo = Promo::whereId($id)->first();
      $promo->harga_promo       = $params['harga_promo'];
      $promo->start_date_promo  = $params['start_date_promo'];
      $promo->end_date_promo    = $params['end_date_promo'];
      $promo->keterangan        = $params['keterangan'];
      $promo->status            = '1';
      $promo->save();

      Session::flash('success','Promo berhasil diupdate');
      return redirect()->route('kamar.promo');
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

}