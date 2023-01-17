<?php

namespace App\Services\Owner;
use ErrorException;
use App\Models\area;
use App\Models\kamar;
use App\Models\Alamat;
use App\Models\fkamar;
use App\Models\fparkir;
use App\Models\fbersama;
use App\Models\Province;
use App\Models\fotokamar;
use App\Models\fkamar_mandi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class KamarService {

  // Index
  public function index()
  {
    try {
      $kamar = kamar::where('user_id',auth::user()->id)->get();
      return view('pemilik.kamar.index', compact('kamar'));
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Create Form
  public function create()
  {
    try {
      $provinsi = Province::select('id','name')->get();
      // Cek data rekening
      if (Auth::user()->dataRekening == null || Auth::user()->no_wa == 0) {
        Session::flash('error','Data Akun Belum Lengkap !');
        return redirect('/home');
      }
      return view('pemilik.kamar.create', compact('provinsi'));
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }


  // Store
  public function store($params)
  {
    try {
      DB::beginTransaction();
      $foto = $params->file('bg_foto');
      $nama_foto = time()."_".$foto->getClientOriginalName();
      // isi dengan nama folder tempat kemana file diupload
      $tujuan_upload = 'public/images/bg_foto';
      $foto->storeAs($tujuan_upload,$nama_foto);

      $slug                   = Str::slug($params->nama_kamar) . "-" . Str::random(6);
      $kamar                  = new Kamar;
      $kamar->id              = $params->id;
      $kamar->user_id         = auth::id();
      $kamar->slug            = $slug;
      $kamar->nama_kamar      = $params->nama_kamar;
      $kamar->jenis_kamar     = $params->jenis_kamar;
      $kamar->luas_kamar      = $params->luas_kamar;
      $kamar->stok_kamar      = $params->stok_kamar;
      $kamar->sisa_kamar      = $kamar->stok_kamar;
      $kamar->harga_kamar     = $params->harga_kamar;
      $kamar->deposit         = $params->deposit;
      $kamar->biaya_admin     = $params->biaya_admin;
      $kamar->ket_lain        = $params->ket_lain;
      $kamar->ket_biaya       = $params->ket_biaya;
      $kamar->desc            = $params->desc;
      $kamar->kategori        = $params->kategori;
      $kamar->book            = $params->book;
      $kamar->bg_foto         = $nama_foto;
      $kamar->province_id     = $params->province_id;
      $kamar->regency_id      = $params->regency_id;
      $kamar->district_id     = $params->district_id;
      $kamar->save();

      if ($kamar) {
          foreach($params->addmore as $value){
            $fkamar = new fkamar;
            $fkamar->kamar_id = $kamar->id;
            $fkamar->name = $value['name'];
            $fkamar->save();
          }
      }

      if ($kamar && $fkamar) {
          foreach ($params->addkm as $value) {
            $fkamar_mandi = new fkamar_mandi;
            $fkamar_mandi->kamar_id = $kamar->id;
            $fkamar_mandi->name = $value['name'];
            $fkamar_mandi->save();
          }
      }

      if ($kamar && $fkamar && $fkamar_mandi) {
          foreach ($params->addbersama as $value) {
            $fbersama = new fbersama;
            $fbersama->kamar_id = $kamar->id;
            $fbersama->name = $value['name'];
            $fbersama->save();
          }
      }

      if ($kamar && $fkamar && $fkamar_mandi && $fbersama) {
          foreach ($params->addparkir as $value) {
            $fparkir = new fparkir;
            $fparkir->kamar_id = $kamar->id;
            $fparkir->name = $value['name'];
            $fparkir->save();
          }
      }

      if ($kamar && $fkamar && $fkamar_mandi && $fbersama && $fparkir) {
          foreach ($params->addarea as $value) {
            $area = new area;
            $area->kamar_id =  $kamar->id;
            $area->name = $value['name'];
            $area->save();
          }
      }

      if ($kamar&& $fkamar&& $fkamar_mandi&& $fbersama&& $fparkir&& $area) {
          foreach($params->addfoto as $value) {
            $foto_kamar = $value['foto_kamar'];
            $nama_foto = time()."_".$foto_kamar->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'public/images/foto_kamar';
            $foto_kamar->storeAs($tujuan_upload,$nama_foto);

            $foto = new fotokamar;
            $foto->kamar_id = $kamar->id;
            $foto->foto_kamar = $nama_foto;
            $foto->save();
          }

          $alamat = Alamat::create([
            'kamar_id'  => $kamar->id,
            'alamat'    => $params->alamat
          ]);
      }

      DB::commit();
      Session::flash('success','Kamar berhasil ditambah');
      return redirect('pemilik/kamar');
    } catch (ErrorException $e) {
      DB::rollback();
      throw new ErrorException($e->getMessage());
    }
  }

  // Show Kamar
  public function show($slug)
  {
    try {
      $show = kamar::where('slug', $slug)->where('user_id',auth::id())->first();
      return view('pemilik.kamar.show', compact('show'));
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }

  // Edit Kamar
  public function edit($slug)
  {
    try {
      $edit = kamar::where('slug', $slug)->first();
      $provinsi = Province::select('id','name')->get();
      return view('pemilik.kamar.edit', compact('edit','provinsi'));
    } catch (ErrorException $e) {
      throw new ErrorException($e->getMessage());
    }
  }


  // Update Kamar
  public function update($id, $params)
  {
    try {
      DB::beginTransaction();
      $kamar              = Kamar::find($id);
      $kamar->user_id     = auth::id();
      $kamar->nama_kamar  = $params->nama_kamar;
      $kamar->jenis_kamar = $params->jenis_kamar;
      $kamar->luas_kamar  = $params->luas_kamar;
      $kamar->stok_kamar  = $params->stok_kamar;
      $kamar->sisa_kamar  = $kamar->stok_kamar;
      $kamar->harga_kamar = $params->harga_kamar;
      $kamar->deposit     = $params->deposit;
      $kamar->biaya_admin = $params->biaya_admin;
      $kamar->ket_lain    = $params->ket_lain;
      $kamar->ket_biaya   = $params->ket_biaya;
      $kamar->desc        = $params->desc;
      $kamar->kategori    = $params->kategori;
      $kamar->book        = $params->book;
      $kamar->save();

       if ($kamar) {
        if ($params->addmore) {
          foreach($params->addmore as $key => $value){
            $fkamar = fkamar::Create([
              'kamar_id'  => $id,
              'name'      => $value['name']
            ]);
          }
        }

        if ($params->addkm) {
          foreach ($params->addkm as $value) {
            $fkamar_mandi = fkamar_mandi::create([
              'kamar_id'  => $id,
              'name'      => $value['name']
            ]);

          }
        }

        if ($params->addbersama) {
          foreach ($params->addbersama as $value) {
            $fbersama = fbersama::Create([
              'kamar_id'  => $id,
              'name'      => $value['name']
            ]);
          }
        }

        if ($params->addparkir) {
          foreach ($params->addparkir as $value) {
            $fparkir = fparkir::Create([
              'kamar_id'  => $id,
              'name'      => $value['name']
            ]);
          }
        }

        if ($params->addarea) {
          foreach ($params->addarea as $value) {
            $area = new area;
            $area->kamar_id =  $id;
            $area->name = $value['name'];
            $area->save();
          }
        }

        if ($params->addfoto) {
          foreach($params->addfoto as $value) {
            $foto_kamar = $value['foto_kamar'];
            $nama_foto = time()."_".$foto_kamar->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'public/images/foto_kamar';
            $foto_kamar->storeAs($tujuan_upload,$nama_foto);

            $foto = new fotokamar;
            $foto->kamar_id = $id;
            $foto->foto_kamar = $nama_foto;
            $foto->save();
          }
        }

      }

      DB::commit();
      Session::flash('success','Kamar Berhasil Di Update !');
      return redirect('pemilik/kamar');
    } catch (ErrorException $e) {
      DB::rollback();
      throw new ErrorException($e->getMessage());
    }
  }

  // Delete fasilitas kamar
  public function delFasilitasKamar($id)
  {
    $del = fkamar::whereId($id)->first();
    $del->delete();
    Session::flash('success','Delete Success.');
    return back();
  }

  // Delete fasilitas kamar Mandi
  public function delFasilitasKamarMandi($id)
  {
    $del = fkamar_mandi::whereId($id)->first();
    $del->delete();
    Session::flash('success','Delete Success.');
    return back();
  }

  // Delete fasilitas Bersama
  public function delFasilitasBersama($id)
  {
    $del = fbersama::whereId($id)->first();
    $del->delete();
    Session::flash('success','Delete Success.');
    return back();
  }

  // Delete fasilitas Bersama
  public function delFasilitasParkir($id)
  {
    $del = fparkir::whereId($id)->first();
    $del->delete();
    Session::flash('success','Delete Success.');
    return back();
  }

  // Delete Area
  public function delArea($id)
  {
    $del = area::whereId($id)->first();
    $del->delete();
    Session::flash('success','Delete Success.');
    return back();
  }

  // Delete Foto Kamar
  public function delFotoKamar($image)
  {
    $img = fotokamar::where('foto_kamar', $image)->first();
      if(File::exists(public_path('storage/images/foto_kamar/'. $img->foto_kamar))){
          File::delete(public_path('storage/images/foto_kamar/'. $img->foto_kamar));
          $img->delete();
      }else{
          dd('File does not exists.');
      }

      Session::flash('success','Delete Image Success.');
      return back();
  }

  public function isActive($params)
  {
    $kamar = kamar::find($params->id);
    $kamar->update([
        'is_active' =>  $kamar->is_active == 0 ? 1 : 0
    ]);
    Session::flash('success','Update Kamar Sukses.');
    return $kamar;
  }
}
