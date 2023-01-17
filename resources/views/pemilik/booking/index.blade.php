@extends('layouts.backend.app')
@section('title','Booking List')

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
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Data booking</h4>
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
                      <th class="text-nowrap">Nama</th>
                      <th class="text-nowrap">No Telp</th>
                      <th class="text-nowrap">Keterangan</th>
                      <th class="text-nowrap">Status Transaksi</th>
                      <th class="text-nowrap">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no=1;
                    @endphp
                    @foreach ($booking as $bookings)
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$bookings->transaction_number}}</td>
                        <td>{{$bookings->kamar->nama_kamar}}</td>
                        <td>{{getNameUser($bookings->user_id)}}</td>
                        <td>{{$bookings->user->no_wa ?? 0}}</td>
                        <td>{{$bookings->lama_sewa}} Bulan</td>
                        <td>{{$bookings->payment->status}}</td>
                        <td>
                          @if ($bookings->status == 'Pending')
                            @if ($bookings->payment->jumlah_bayar == null || $bookings->payment->tgl_transfer == null)
                             <a href="">Menunggu Pembayaran </a>
                            @else
                             <a href="{{url('pemilik/room', $bookings->key)}}">Konfirmasi </a>
                            @endif
                          @elseif($bookings->status == 'Proses')
                            @if (
                                  Carbon\carbon::parse($bookings->end_date_sewa)->format('d') <= Carbon\carbon::now()->format('d') &&
                                  Carbon\carbon::parse($bookings->end_date_sewa)->format('m') <= Carbon\carbon::now()->format('m') &&
                                  Carbon\carbon::parse($bookings->end_date_sewa)->format('Y') <= Carbon\carbon::now()->format('Y')
                                )
                              <a data-id-done="{{$bookings->id}}" id="done" class="btn btn-info btn-sm mr-sm-1 mb-1 mb-sm-0" style="color: black">Expired</a>
                            @else
                              <span class="badge badge-primary">Aktif</span>
                            @endif
                          @elseif($bookings->status == 'Done')
                            <span class="badge badge-info">Selesai</span>
                          @elseif($bookings->status == 'Cancel')
                            <span class="badge badge-warning">Cancel</span>
                          @elseif($bookings->status == 'Reject')
                            <span class="badge badge-danger">Reject</span>
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
@section('scripts')
  <script src="{{asset('ctrl/backend/confirm.js')}}"></script>
@endsection