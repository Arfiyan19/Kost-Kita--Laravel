<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Transaction,Review};
use App\Http\Requests\ReviewRequest;
use Auth;
use Session;
class MyRoomsController extends Controller
{
    // My Room
    public function myroom()
    {
      $kamar = Transaction::where('user_id', Auth::id())->whereNotIn('status',['Pending'])->get();
      return view('user.kamar.index', compact('kamar'));
    }

    // review
    public function review($key)
    {
      $review = Transaction::with('kamar','review')->where('key',$key)->first();
      return view('user.kamar.ulasan', compact('review'));
    }

    // Review Proses
    public function reviewProses(ReviewRequest $params,$key)
    {
      $kamar = Transaction::with('kamar')->where('key',$key)->first();
      $review = Review::create([
        'user_id'     => Auth::id(),
        'transaksi_id'=> $kamar->id,
        'pemilik_id'  => $kamar->kamar->user_id,
        'kamar_id'    => $kamar->kamar->id,
        'rating'      => 4,
        'ulasan'      => $params['ulasan']
      ]);

      Session::flash('success','Berhasil, Terima Kasih Sudah Memberikan Review.');
      return redirect('/user/myroom');
    }
}
