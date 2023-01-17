@extends('layouts.backend.app')
@section('title')
  Tagihan Pembayaran
@endsection
@section('content')
@if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div>
@elseif($message = Session::get('error'))
  <div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div>
@endif
<section id="basic-datatable">
  <div class="row">
    <div class="col-md-3">
      <div class="card shadow">
        <div class="card-body">
          <div class="text-center">
            <img class="round" src="{{asset('assets/images/profile/profile.jpg')}}" alt="avatar" height="40" width="40">
            <p class="text-center font-weight-bold">{{Auth::user()->name}}</p>
          </div>
          <h5>Account</h5>
          <div style="margin-left:2px">
            <a href="{{url('profile')}}" style="font-size: 12px">Profile</a> <br>
            <a href="" style="font-size: 12px">Ganti Password</a>
          </div>

          <h5 class="mt-2">Payment</h5>
          <div style="margin-left: 2px">
            <a href="{{url('user/tagihan')}}" style="font-size: 12px">Tagihan</a> <br>
            <a href="{{url('user/myroom')}}" style="font-size: 12px">Kamar Kamu</a>
          </div>

          <h5 class="mt-2">Kamar</h5>
          <div style="margin-left: 2px">
            <a href="{{url('/')}}" style="font-size: 12px">Cari Kamar</a> <br>
            <a href="" style="font-size: 12px">Kamar Favorite</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Data Tagihan</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <div class="table-responsive">
                <table class="table zero-configuration">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th class="text-nowrap">Nomor Transaksi</th>
                      <th class="text-nowrap">Nama Kamar</th>
                      <th class="text-nowrap">Harga</th>
                      <th class="text-nowrap">Keterangan</th>
                      <th class="text-nowrap">Status</th>
                      <th class="text-nowrap">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no=1;
                    @endphp
                    @foreach ($tagihan as $tagihans)
                      @if ($tagihans->payment->status == 'Pending')
                        <tr>
                          <td>{{$no}}</td>
                          <td>{{$tagihans->transaction_number}}</td>
                          <td>{{$tagihans->kamar->nama_kamar}}</td>
                          <td>{{rupiah($tagihans->harga_total)}}</td>
                          <td>{{$tagihans->lama_sewa}} Bulan</td>
                          <td>{{$tagihans->payment->status}}</td>
                          <td>
                            @if ($tagihans->payment->status == 'Pending')
                              <a href="{{url('user/room', $tagihans->key)}}">Konfirmasi</a>
                            @endif
                          </td>
                        </tr>
                      @endif
                    @php
                      $no++;
                    @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
@endsection