@extends('layouts.backend.app')
@section('title','Data Promo Kosan')
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
    <div class="col-12">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">Data List Promo Kamar
                <a href="{{route('kamar.promo.create')}}" class="btn btn-primary btn-sm">Tambah Promo Kamar</a>
              </h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <div class="table-responsive">
                <table class="table zero-configuration">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th class="text-nowrap">Nama Kamar</th>
                      <th class="text-nowrap">Status</th>
                      <th class="text-nowrap">Harga Kamar</th>
                      <th class="text-nowrap">Harga Promo</th>
                      <th class="text-nowrap">Tanggal Mulai</th>
                      <th class="text-nowrap">Tanggal Akhir</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($promo as $key => $item)
                    <tr>
                      <td style="background-color: {{$item->kamar->promo->end_date_promo <= Carbon\carbon::now()->format('Y-m-d') && $item->kamar->promo->status == 1 ? 'red' : '' }} " >{{$key+1}}</td>
                      <td style="background-color: {{$item->kamar->promo->end_date_promo <= Carbon\carbon::now()->format('Y-m-d') && $item->kamar->promo->status == 1 ? 'red' : '' }} ">{{$item->kamar->nama_kamar}}</td>
                      <td style="background-color: {{$item->kamar->promo->end_date_promo <= Carbon\carbon::now()->format('Y-m-d') && $item->kamar->promo->status == 1 ? 'red' : '' }} ">{{$item->status == 1 ? 'Aktif' : 'Expired'}}</td>
                      <td style="background-color: {{$item->kamar->promo->end_date_promo <= Carbon\carbon::now()->format('Y-m-d') && $item->kamar->promo->status == 1 ? 'red' : '' }} ">{{rupiah($item->kamar->harga_kamar)}}</td>
                      <td style="background-color: {{$item->kamar->promo->end_date_promo <= Carbon\carbon::now()->format('Y-m-d') && $item->kamar->promo->status == 1 ? 'red' : '' }} ">{{rupiah($item->harga_promo)}}</td>
                      <td style="background-color: {{$item->kamar->promo->end_date_promo <= Carbon\carbon::now()->format('Y-m-d') && $item->kamar->promo->status == 1 ? 'red' : '' }} ">{{$item->kamar->promo->start_date_promo ?? '-'}}</td>
                      <td style="background-color: {{$item->kamar->promo->end_date_promo <= Carbon\carbon::now()->format('Y-m-d') && $item->kamar->promo->status == 1 ? 'red' : '' }} ">{{$item->kamar->promo->end_date_promo ?? '-'}}</td>
                      <td class="text-center" style="background-color: {{$item->kamar->promo->end_date_promo <= Carbon\carbon::now()->format('Y-m-d') && $item->kamar->promo->status == 1 ? 'red' : '' }} ">
                        @if ($item->status == 1)
                          <a data-id-inactive="{{$item->id}}" id="inactive" class="btn btn-info btn-sm mr-sm-1 mb-1 mb-sm-0" style="color: black">{{$item->status == 1 ? 'In Active' : ''}}</a>
                        @else
                        <a href=" {{route('kamar.promo.edit',$item->id)}} " class="btn btn-info btn-sm mr-sm-1 mb-1 mb-sm-0" style="color: black">Update</a>
                        @endif
                      </td>
                    </tr>
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