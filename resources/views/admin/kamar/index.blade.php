@extends('layouts.backend.app')
@section('title','Data Kosan')
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
              <h4 class="card-title">Data List Kamar
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
                      <th class="text-nowrap">Type Kamar</th>
                      <th class="text-nowrap">Jenis Kamar</th>
                      <th class="text-nowrap">Status Kamar</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($kamar as $key => $item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->nama_kamar}}</td>
                      <td>{{$item->kategori}}</td>
                      <td>{{rupiah($item->harga_kamar)}}</td>
                      <td><span class="btn btn-{{$item->is_active == 0 ? 'primary' : 'success'}} btn-sm text-white">{{$item->is_active == 1 ? 'Aktif' : 'Tidak Aktif'}}</span></td>
                      <td class="text-center">
                        <a href="{{url('room', $item->slug)}}" class="btn btn-info btn-sm">Show</a>
                        @if ($item->status == 0)
                           <a data-id-kamar="{{$item->id}}" id="statusKamar" class="btn btn-danger btn-sm">{{$item->status == 0 ? 'Setujui' : ''}}</a>
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
<script type="text/javascript">
    // Status Kamar
    $(document).on('click', '#statusKamar', function () {
    var id = $(this).attr('data-id-kamar');
    $.get('status-kamar', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(_resp){
        location.reload()
    });
    });
</script>
@endsection
