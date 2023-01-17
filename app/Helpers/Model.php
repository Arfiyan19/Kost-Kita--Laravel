<?php
use App\Models\{Province,Regency,District,User,payment,Transaction,Promo};

// Ambil nama provinsi by id
if (! function_exists('getNameProvinsi'))
{
    function getNameProvinsi($id=0)
    {
        $model = new Province;
        $data  = $model::where('id',$id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        $name = !empty($name) ? $name : 'Not Found';
        return $name;
    }
}

// Ambil nama kota by id
if (! function_exists('getNameRegency'))
{
    function getNameRegency($id=0)
    {
        $model = new Regency;
        $data  = $model::where('id',$id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        $name = !empty($name) ? $name : 'Not Found';
        return $name;
    }
}

// Ambil nama district by id
if (! function_exists('getNameDistrict'))
{
    function getNameDistrict($id=0)
    {
        $model = new District;
        $data  = $model::where('id',$id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        $name = !empty($name) ? $name : 'Not Found';
        return $name;
    }
}

// Format Rupiah
if (! function_exists('rupiah'))
{
    function rupiah($angka)
    {
      $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
      return $hasil_rupiah;
    }
}

// Format date
if (! function_exists('forDate'))
{
    function forDate()
    {
      $showdate = date('d F Y');
      return $showdate;
    }
}

// Show bulan dan tahun
if (! function_exists('monthyear'))
{
    function monthyear()
    {
      $showdate = date('F Y');
      return $showdate;
    }
}

// Ambil nama user by id
if (! function_exists('getNameUser'))
{
    function getNameUser($id=0)
    {
        $model = new User;
        $data  = $model::where('id',$id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        $name = !empty($name) ? $name : 'Not Found';
        return $name;
    }
}

// Total pelanggan
if (! function_exists('getCountPelanggan'))
{
    function getCountPelanggan($pemilik_id=0)
    {
        $model = new Transaction;
        $data  = $model::where('pemilik_id',$pemilik_id)->groupBy('user_id')->get();
        return $data->count();
    }
}

// Get point/credit user
if (! function_exists('getPointUser'))
{
    function getPointUser($id=0)
    {
      $model = new User;
      $data  = $model::select('id','credit')->where('id',$id)->first();
      $transaksi = !empty($data) ? $data->credit : '0';
      return $transaksi;
    }
}

// Calculate point/credit user
if (! function_exists('calculatePointUser'))
{
    function calculatePointUser($id=0)
    {
      $model = new User;
      $data  = $model::select('id','credit')->where('id',$id)->first();
      $cal = $data->credit * 500;
      $transaksi = !empty($cal) ? $cal : '0';
      return $transaksi;
    }
}

// Cek Promo
if (! function_exists('cekPromo'))
{
    function cekPromo()
    {
      $model = new Promo;
      $data  = $model::where('pemilik_id',Auth::id())->get();
      foreach ($data as $datas) {
        if (
          Carbon\carbon::parse($datas->end_date_promo)->format('d') <= Carbon\carbon::now()->format('d') &&
          Carbon\carbon::parse($datas->end_date_promo)->format('m') <= Carbon\carbon::now()->format('m') &&
          Carbon\carbon::parse($datas->end_date_promo)->format('Y') <= Carbon\carbon::now()->format('Y')
          && $datas->status == 1
          ) {
          return $data->count();
        }
      }

    }
}

// Cek Pemesanan
if (! function_exists('cekPemesanan'))
{
    function cekPemesanan()
    {
      $model = new Transaction;
      $data  = $model::with('payment')->where('user_id',Auth::id())->get();
      foreach ($data as $datas) {
        if ($datas->payment->status == 'Pending') {
          return $data;
        }
      }
    }
}

// Count Book on pemilik
if (! function_exists('countBook'))
{
    function countBook()
    {
      $model = new Transaction;
      $data  = $model::with(['payment'=> function($a) {
        $a->where('status','Success');
      }])->where('pemilik_id',Auth::id())
      ->where('status','Pending')
      ->get();
      return $data->count();
    }
}

// Get Notifikasi Payment
if (! function_exists('getNotifikasi'))
{
    function getNotifikasi()
    {
      $model = new Transaction;
      $data  = $model::with(['payment'=> function($a) {
        $a->where('status','Pending');
      }])
      ->where('pemilik_id',Auth::id())
      ->where('status','Pending')
      ->get();
      return $data;
    }
}

// Get Notifikasi End Sewa
if (! function_exists('getNotifikasiEndSewa'))
{
    function getNotifikasiEndSewa()
    {
      $model = new Transaction;
      $data  = $model::where('pemilik_id',Auth::id())
      ->get();

     foreach ($data as $datas) {
        if (
          Carbon\carbon::parse($datas->end_date_sewa)->format('d') <= Carbon\carbon::now()->format('d') &&
          Carbon\carbon::parse($datas->end_date_sewa)->format('m') <= Carbon\carbon::now()->format('m') &&
          Carbon\carbon::parse($datas->end_date_sewa)->format('Y') <= Carbon\carbon::now()->format('Y')
          && $datas->status == 'Proses'
          ) {
          return $data;
        }
      }
    }
}