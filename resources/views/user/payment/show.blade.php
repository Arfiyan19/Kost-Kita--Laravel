@extends('layouts.backend.app')
@section('title')
  Konfirmasi Pembayaran Kamar
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h6>Jumlah akan ditentukan dari lama sewa pilihan kamu. Silahkan transfer sesuai dengan jumlah yang ditentukan.</h6>
      </div>
    </div>
    <div class="card shadow">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <span>
            Jumlah :
            <span style="font-weight: bold">{{rupiah($transaksi->harga_total)}}</span>
          </span>
          <span style="font-size: 21px">
            <i class="feather icon-credit-card"></i>
          </span>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <span>
            @foreach ($transaksi->bank as $banks)
              <ul>
                <li>{{$banks->nama_bank}}</li>
                <li>{{$banks->no_rekening}}</li>
                <li>{{$banks->nama_pemilik}}</li>
              </ul>
            @endforeach
          </span>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <span>
            {{$transaksi->kamar->nama_kamar}} <br>
            {{$transaksi->lama_sewa}} Bulan Sewa
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="font-weight-bold">Lakukan Konfirmasi Pembayaran</h4>
        <h6>Silahkan lakukan konfirmasi ketika Anda sudah melakukan transfer.</h6>
        <hr>
        <form action="{{url('user/konfirmasi-payment',$transaksi->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="Atas Nama">Nama Pengirim</label>
            <input type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" placeholder="Atas Nama" autocomplete="off">
            @error('nama_pemilik')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="Bank Kamu">Bank Kamu</label>
            <select name="nama_bank" class="select2 form-control">
              <option value="">-- Pilih Bank --</option>
              @foreach ($bank as $banks)
                <option value="{{$banks->nama_bank}}">{{$banks->nama_bank}}</option>
              @endforeach
            </select>
            @error('nama_bank')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="Bank Tujuan">Bank Tujuan</label>
            <select name="bank_tujuan" class="form-control select2">
              <option value="">-- Pilih Bank --</option>
              @foreach ($transaksi->bank as $banks)
                <option value="{{$banks->nama_bank}}">{{$banks->nama_bank}}</option>
              @endforeach
            </select>
            @error('bank_tujuan')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="Tanggal Transfer">Tanggal Transfer</label>
            <input type="text" name="tgl_transfer" class="form-control pickadate @error('tgl_transfer') is-invalid @enderror" placeholder="Tanggal Transfer">
            @error('tgl_transfer')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="Jumlah">Jumlah</label>
            <input type="text" value="{{rupiah($transaksi->harga_total)}}" class="form-control" placeholder="Jumlah" readonly disabled>
          </div>

          <div class="form-group">
            <label for="Jumlah">File Bukti Transfer</label>
            <input type="file" class="form-control @error('bukti_bayar') is-invalid @enderror" name="bukti_bayar">
            @error('bukti_bayar')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Konfirmasi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection