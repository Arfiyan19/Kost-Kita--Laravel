@extends('layouts.front.app')
@section('description')
  Papikos, cari kos dan apartement makin mudah hanya di papikos. aplikasi pencari kos di indonesia.
@endsection
@section('title')
  Selamat Datang di Pap!Kos
@endsection

@section('content')
  <div class="card {{@$cari ? 'hidden' : ''}}">
    <div class="card-body" style="padding: 1%">
      <form action="{{url('filter-kamar')}}" method="GET">
        <div class="row">
          <div class="col-sm-3 mt-1">
            <select name="nama_provinsi" id="" class="form-control" placeholder="Semua Kota">
              <option value="all">Semua Kota</option>
              @foreach ($provinsi as $province)
                <option value="{{$province->provinsi->name}}" {{$province->provinsi->name == $select['name'] ? 'selected' : ''}} >{{$province->provinsi->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-sm-2 mt-1">
            <select name="jenis_kamar" id="" class="form-control">
              <option value="all" {{$select['jenis_kamar'] == 'all' ? 'selected' : ''}}>Semua Tipe</option>
              <option value="Campur" {{$select['jenis_kamar'] == 'Campur' ? 'selected' : ''}} >Campur</option>
              <option value="Putra" {{$select['jenis_kamar'] == 'Putra' ? 'selected' : ''}}>Putra</option>
              <option value="Putri" {{$select['jenis_kamar'] == 'Putri' ? 'selected' : ''}}>Putri</option>
            </select>
          </div>

          <div class="col-sm-2 mt-1">
            <button type="submit" class="btn btn-outline-primary btn-block"> <i class="feather icon-filter"></i> Filter Kamar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <section id="search-bar" class="{{@$cari ? 'hidden' : ''}}">
    <div class="search-bar">
      <form action="{{url('show-all-room')}}" method="GET">
        <fieldset class="form-group position-relative has-icon-left">
          <input type="text" class="form-control round" name="cari" id="searchbar" placeholder="Masukan Nama Kos lokasi/kota/provinsi...">
          <div class="form-control-position">
             <i class="feather icon-search px-1"></i>
          </div>
        </fieldset>
      </form>
    </div>
  </section>

  <h2 class="mb-2 {{@$cari ? '' : 'hidden'}}" style="font-weight: bold; color:black">Ditemukan {{$allKamar->count()}} Kamar</h2>

  <div class="row match-height">
    @forelse ($allKamar as $kamars)
    <div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-content">
          <a href="{{url('room', $kamars->slug)}}">
            <img class="card-img-top img-fluid" src="{{asset('storage/images/bg_foto/' .$kamars->bg_foto)}}" alt="Card image cap" style="max-height: 180px">
          </a>
          <div class="card-body">
            <a href="{{url('room', $kamars->slug)}}">
              <h5 style="min-height: 40px">{{$kamars->nama_kamar}} {{ucfirst(strtolower($kamars->regencies->name))}}</h5>
              <div class="d-flex-justify-content-between">
                <a href="" class="btn gradient-light-primary btn-sm">{{$kamars->jenis_kamar}}</a>
                <a href="#" class="btn btn-outline-{{$kamars->sisa_kamar > 5 ? 'primary' : 'danger'}} btn-sm {{$kamars->sisa_kamar > 5 ? 'primary' : 'danger'}}">
                    @if ($kamars->sisa_kamar != 0 || $kamars->sisa_kamar != null)
                        Tersisa {{$kamars->sisa_kamar}} kamar
                    @else
                        Kamar Penuh
                    @endif
                </a>
              </div>
              <p class="card-text mt-1 mb-0"><i class="feather icon-map-pin"></i> {{$kamars->provinsi->name}}</p>
              <span class="card-text" style="color: rgb(96, 93, 93);text-decoration: line-through">
                @if ($kamars->promo != null && $kamars->promo->status == 1 && $kamars->promo->end_date_promo >= Carbon\carbon::now()->format('d F, Y'))
                    {{rupiah($kamars->harga_kamar)}}
                @endif
              </span> <br>
              <span class="card-text" style="color: black"> {{rupiah(
                $kamars->promo != null && $kamars->promo->status == 1 && $kamars->promo->end_date_promo >= Carbon\carbon::now()->format('d F, Y')
                ? $kamars->promo->harga_promo : $kamars->harga_kamar)}} / Bulan
              </span>
            </a>
            <div class="card-btn d-flex justify-content-between mt-2">
              <a href="#" class="btn gradient-light-{{$kamars->kategori == 'Kost' ? 'warning' : 'info'}} text-white btn-sm">{{$kamars->kategori}}</a>
              <a href="#" class="btn btn-outline-primary btn-sm {{$kamars->book == 0 ? 'hidden' : ''}}">Bisa Booking</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div class="col" style="text-align:center">
      <img src="{{asset('assets/images/pages/empty.svg')}}" style="max-height: 350px">
      <p class="mt-2">Kamar yang kamu cari tidak ditemukan.</p>
    </div>
    @endforelse
  </div>
  <div style="text-align: center;" class="mt-1 mb-5">
    {{ $allKamar->links() }}
  </div>
@endsection
