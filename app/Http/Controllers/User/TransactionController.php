<?php

namespace App\Http\Controllers\User;

use Carbon\carbon;
use ErrorException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\TransactionRequest;
use App\Http\Requests\KonfirmasiPembayaranRequest;
use App\Models\{Transaction,kamar,payment,User,Bank};

class TransactionController extends Controller
{
    // Tagihan
    public function tagihan()
    {
      try {
        $tagihan = Transaction::where('user_id', Auth::id())->get();
        return view('user.payment.index', compact('tagihan'));
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    // Transaction Sewa Kamar
    public function store(TransactionRequest $request, $id)
    {

      try {
        DB::beginTransaction();

          $room = kamar::with('promo')
          ->where('id', $id)
          ->first(); // Get Room by id

            //  Cek kamar aktif / tidak
          if ($room->is_active == 0 || $room->status == 0) {
            Session::flash('error','Pemesanan kamar gagal, kamar sedang tidak aktif !');
            return back();

            //  Cek kamar tersedia atau tidak
          } elseif ($room->sisa_kamar == 0 || $room->sisa_kamar <= 0) {
            Session::flash('error','Kamar Penuh !');
            return back();
          }
          $iduser = Auth::id(); // Get ID User
          $number = mt_rand(100, 999); // Get Random Number
          $date = date('dmy'); // Get Date Now
          $key = Str::random(9999);

          $kamar = new Transaction;
          $kamar->key                 = 'confirm-payment-' .$key;
          $kamar->transaction_number  = 'BOOK-' .$number .$id .'-' .$date;
          $kamar->kamar_id            = $room->id;
          $kamar->user_id             = Auth::id();
          $kamar->pemilik_id          = $room->user_id;
          $kamar->lama_sewa           = $request->lama_sewa;
          if ($request->lama_sewa == 1) {
            $kamar->hari              = 30;
          } elseif($request->lama_sewa == 3) {
            $kamar->hari              = 90;
          }

          $points = calculatePointUser(Auth::id());

          $kamar->harga_kamar         =  $room->promo != null && $room->promo->status == '1' && $room->promo->end_date_promo >= carbon::now()->format('d F, Y') ? $room->promo->harga_promo : $room->harga_kamar;
          if ($request->credit) {
            $totalharga               =  $room->promo != null && $room->promo->status == '1' && $room->promo->end_date_promo >= carbon::now()->format('d F, Y') ? $room->promo->harga_promo : $room->harga_kamar * $request->lama_sewa;
            $kamar->harga_total       = ($totalharga + $number) - $points;
          } else {
            $harga_total       =  $room->promo != null && $room->promo->status == '1' && $room->promo->end_date_promo >= carbon::now()->format('d F, Y') ? $room->promo->harga_promo : $room->harga_kamar * $request->lama_sewa;
            $kamar->harga_total = $harga_total + $number;
          }

          $kamar->tgl_sewa            = Carbon::parse($request->tgl_sewa)->format('d-m-Y');
          $kamar->end_date_sewa       = Carbon::parse($request->tgl_sewa)->addDays($kamar->hari)->format('d-m-Y');
          $kamar->save();

          // jika sukses Simpan ke table payment
          if ($kamar) {
            $payment = new payment;
            $payment->transaction_id    = $kamar->id;
            $payment->user_id           = Auth::id();
            $payment->kamar_id          = $id;
            $payment->save();
          }

          if ($kamar = $request->credit) {
            $point = User::where('id', Auth::id())->firstOrFail();
            $credit = $point->credit - $point->credit;
            $point->credit = $credit;
            $point->save();
          }

          DB::commit();
          Session::flash('success','Berhasil, Silahkan Melakukan Pembayaran');
          return redirect('/user/tagihan');
      } catch (ErrorException $e) {
        DB::rollback();
        throw new ErrorException($e->getMessage());
      }

    }

    // Detail Pembayaran
    public function detail_payment($key)
    {
      try {
        $transaksi = Transaction::where('key',$key)->first();
        $bank = Bank::all();
        if ($transaksi->payment->status == 'Pending') {
          return view('user.payment.show', compact('transaksi','bank'));
        } else {
          Session::flash('error','Pembayaran Sudah Terkirim');
          return redirect('/user/tagihan');
        }
      } catch (ErrorException $e) {
        throw new ErrorException($e->getMessage());
      }
    }

    // konfirmasi pembayaran kamar
    public function update(KonfirmasiPembayaranRequest $request, $id)
    {
      try {
        DB::beginTransaction();
        $konfirmasi = Transaction::findOrFail($id);
        $konfirmasi->update([
          'status'  => 'Pending'
        ]);

        if ($konfirmasi) {

          $foto = $request->file('bukti_bayar');
          $bukti_bayar = time()."_".$foto->getClientOriginalName();
          // isi dengan nama folder tempat kemana file diupload
          $tujuan_upload = 'public/images/bukti_bayar';
          $foto->storeAs($tujuan_upload,$bukti_bayar);

          $payment = payment::where('transaction_id',$id)->first();
          $payment->type_transfer     = 'BANK';
          $payment->nama_bank         = $request->nama_bank;
          $payment->nama_pemilik      = $request->nama_pemilik;
          $payment->bank_tujuan       = $request->bank_tujuan;
          $payment->status            = 'Success';
          $payment->jumlah_bayar      = $konfirmasi->harga_total;
          $payment->tgl_transfer      = $request->tgl_transfer;
          $payment->bukti_bayar       = $bukti_bayar;
          $payment->save();
        }

        DB::commit();
        Session::flash('success','Pembayaran Terkirim');
        return redirect('/user/tagihan');
      } catch (ErrorException $e) {
        DB::rollback();
        throw new ErrorException($e->getMessage());
      }
    }
}
