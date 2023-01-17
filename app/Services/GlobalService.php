<?php

namespace App\Services;
use ErrorException;
use App\Models\{User,DataRekening,Bank};
use Auth;
use Session;

class GlobalService {

  // Profile
  public function profile()
  {
    try {
      $listBank = Bank::all();
      $bank = DataRekening::where('user_id',Auth::id())->get();
      return view('global.profile.index', \compact('bank','listBank'));
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Profile Update
  public function profileUpdate($id, $data)
  {
    try {
      // $foto = $data->file('foto');
      // $nama_foto = time()."_".$foto->getClientOriginalName();
      // // isi dengan nama folder tempat kemana file diupload
      // $tujuan_upload = 'public/images/foto_profile';
      // $foto->storeAs($tujuan_upload,$nama_foto);

      $result = User::find($id);

      $image = $data->file('foto');
      if($image)
      {
          if($result->foto && file_exists(public_path('images/foto_profile/' . $result->foto))){
              \Storage::delete(public_path('images/foto_profile/'. $result->foto));
          }
          $images = time() . "_" . $image->getClientOriginalName();
          // folder penyimpanan
          $tujuan_upload = 'public/images/foto_profile';
          $image->storeAs($tujuan_upload, $images);
          $result->foto = $images;
      }

      $result->name   = $data['name'];
      $result->email  = $data['email'];
      $result->no_wa  = $data['no_wa'];
      // $result->foto   = $nama_foto;
      $result->update();

      Session::flash('success','Profile berhasil di update.');
      return back();
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

}