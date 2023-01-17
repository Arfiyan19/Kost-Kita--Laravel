@extends('layouts.backend.app')
@section('title')
  {{$confirm->kamar->nama_kamar}}
@endsection
@section('content')
<div class="row">

  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="font-weight-bold">Konfirmasi Pembayaran</h4>
        <h6>Approve Pembayaran jika data pembayaran dari penyewa sudah sesuai.</h6>
        <hr>
        <form action="{{url('pemilik/payment-confirm',$confirm->key)}}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="Tanggal Approve">Tanggal Approve</label>
            <input type="text" class="form-control" value="{{date('d l Y')}}" readonly disabled>
          </div>

          <div class="form-group">
            <label for="Jumlah">Jumlah</label>
            <input type="text" value="{{rupiah($confirm->harga_total)}}" class="form-control" readonly disabled>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Approve</button>
            <a data-id-reject="{{$confirm->id}}" id="reject" class="btn btn-warning mr-sm-1 mb-1 mb-sm-0">Reject</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h6>Detail Pembayaran Dari Penyewa.</h6>
      </div>
    </div>
    <div class="card shadow">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <span>
            Jumlah <span style="font-weight: bold; color:white">{{rupiah($confirm->harga_total)}}</span>
          </span>
          <span style="font-size: 21px">
            <i class="feather icon-credit-card"></i>
          </span>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <span>
            {{$confirm->payment->nama_pemilik}} <small><em>( Atas Nama)</em></small><br>
            {{$confirm->payment->nama_bank}} <small><em>(Bank Pengirm)</em></small> <br>
            {{$confirm->payment->bank_tujuan}} <small><em>(Bank Tujuan)</em></small> <br>
            {{$confirm->payment->tgl_transfer}} <small><em>(Tanggal Transfer)</em></small>
          </span>
          <span>
            {{-- <img src=" {{asset('storage/images/bukti_bayar/' .$confirm->payment->bukti_bayar)}} " style="max-height: 60px; max-width:200px"> --}}
            <a href=" {{asset('storage/images/bukti_bayar/' .$confirm->payment->bukti_bayar)}}" target="_blank" class="btn btn-info btn-sm">
              <i class="feather icon-file"></i> File Bukti Bayar</a>
          </span>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <span>
            {{$confirm->kamar->nama_kamar}} <br>
            {{$confirm->lama_sewa}} Bulan Sewa
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
  <script src="{{asset('ctrl/backend/confirm.js')}}"></script>
@endsection