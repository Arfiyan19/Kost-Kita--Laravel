@extends('layouts.backend.app')
@section('title')
  Kamar Saya
@endsection
@section('content')
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
            <h4 class="card-title">Data Kamar</h4>
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
                      $no = 1;
                    @endphp
                    @foreach ($kamar as $item)
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$item->transaction_number}}</td>
                        <td>
                          <a href="{{url('room', $item->kamar->slug)}}" target="_blank">{{$item->kamar->nama_kamar}}</a>
                        </td>
                        <td>{{rupiah($item->kamar->harga_kamar)}}</td>
                        <td>{{$item->lama_sewa}} Bulan</td>
                        <td>
                          @if ($item->status == 'Proses')
                            <span class="badge badge-primary">Kamar Aktif</span>
                          @elseif($item->status == 'Done')
                            <span class="badge badge-info">Sewa Selesai</span>
                          @elseif($item->status == 'Cancel')
                            <span class="badge badge-warning">Sewa Batal</span>
                          @elseif($item->status == 'Reject')
                            <span class="badge badge-danger">Sewa Ditolak</span>
                          @endif
                        </td>
                        <td>
                          @if ($item->review == null)
                            <a href=" {{url('user/review', $item->key)}} " class="btn btn-danger btn-sm">Tulis Ulasan</a>
                          @else
                            <a href=" {{url('room', $item->kamar->slug)}} " class="btn btn-info btn-sm">Lihat Ulasan</a>
                          @endif
                        </td>
                      </tr>
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