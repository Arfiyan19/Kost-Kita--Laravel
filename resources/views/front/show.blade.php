@extends('layouts.front.app')
<style>
  .swiper {
    max-height: 455px !important;
  }

  .alerts {
    display: none;
  }
</style>

@section('description')
  {{$kamar->nama_kamar}}
@endsection

@section('image')
  {{asset('storage/images/bg_foto/' .$kamar->bg_foto)}}
@endsection

@section('title')
  {{$kamar->nama_kamar}} {{ucfirst(strtolower($kamar->provinsi->name))}}
@endsection
@section('content')
  @if($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
  @endif
<div class="row">
  <div class="col-12">
    <h4 class="card-title">
      <a href="/" style="font-size: 15px;"><i class="feather icon-home"></i> Home ></a>
      <a href="" style="font-size: 15px;">Kost {{ucwords(strtolower($kamar->provinsi->name))}} ></a>
      <a href="" style="font-size: 15px;">Kost {{ucwords(strtolower($kamar->regencies->name))}} ></a>
      <a href="" style="font-size: 15px; color:black">{{$kamar->nama_kamar}} {{ucwords(strtolower($kamar->district->name))}} {{ucwords(strtolower($kamar->regencies->name))}} </a>
    </h4>
  </div>
  <div class="col-xl-8 col-lg-12">
    <div class="card ">
      <div class="card-content">
        <div class="card-body ">
          <div class="swiper-navigations swiper-container swiper">
            <div class="swiper-wrapper">
              @foreach ($kamar->fotoKamar as $foto)
                <div class="swiper-slide">
                  <img class="img-fluid" src="{{asset('storage/images/foto_kamar/'. $foto->foto_kamar)}}" alt="banner">
                </div>
              @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-xl-4">
    <div class="card">
      <div class="card-content">
        <div class="card-body ">
          <img src="https://cdn.pixabay.com/photo/2018/08/28/13/29/avatar-3637561_1280.png" width="50px" height="50px" class="rounded">
          <span class="font-weight-bold" style="font-size: 20px; color:black;">{{getNameUser($kamar->user_id)}}</span>
          <p class="ml-5" style="font-size: 10px; margin-top:-3%">Pemilik Kos - Aktif Sejak {{monthyear($kamar->user->created_at)}} </p>
          <span class="btn btn-outline-primary btn-sm">
            {{$kamar->user->transaksi->where('status','Proses')->count()}} Transaksi Berhasil</span>
          <span class="btn btn-outline-info btn-sm"> Total  {{getCountPelanggan($kamar->user_id)}} Pelanggan</span>
          <p class="mt-1"> <i class="feather icon-phone-call"></i> @auth <a href="tel:+62{{$kamar->user->no_wa}}"> {{$kamar->user->no_wa}}</a>  @else 0822******** @endauth </p>

          <p class="mt-2" style="font-size: 12px">Hubungi pemilik kos untuk menanyakan lebih detail terkait kamar ini.</p>
          <button class="btn btn-outline-black">Kirim pesan ke pemilik kos</button>
          <hr>
          @if ($kamar->promo != null && $kamar->promo->end_date_promo >= Carbon\carbon::now()->format('d F, Y') && $kamar->promo->status == 1 )
            <p class="mt-2" style="font-weight: bold; font-size:18px; color:black">DISKONNYA BIKIN HEMAT!</p>
            <p class="mt-1" style="text-decoration: underline">Syarat & ketentuan berlaku</p>
            <ul>
              <li>Kuota terbatas</li>
              <li>Berlaku untuk semua pengguna</li>
              <li>Periode <span style="color: rgb(236, 151, 101)"> {{Carbon\carbon::parse($kamar->promo->start_date_promo)->format('d F Y')}} - {{Carbon\carbon::parse($kamar->promo->end_date_promo)->format('d F Y')}} </span></li>
            </ul>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-8">
    <div class="alerts alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="feather icon-copy"></i>
    URL Berhasil Disalin
  </div>
    <div class="card">
      <div class="card-body">
        <h3>{{$kamar->nama_kamar}} {{ucwords(strtolower($kamar->regencies->name))}} {{ucwords(strtolower($kamar->provinsi->name))}}</h3>
        <button class="btn btn-outline-black btn-sm"><span style="font-size: 12px; font-weight:bold;">Kos {{$kamar->jenis_kamar}}</span></button>
        <div class="row">
          <div class="col-md-6 mt-1">
            @if ($kamar->sisa_kamar != 0 || $kamar->sisa_kamar != null)
                <span style="font-weight:bold">Tersisa <span style="color: {{$kamar->sisa_kamar <= 5 ? 'red' : ''}}; font-weight:bold">{{$kamar->sisa_kamar}} kamar</span></span>
            @else
                <span style="font-weight:bold; color:red">Kamar Penuh</span></span>
            @endif
          </div>
          <div class="col-md-6 mt-1">
            @auth
              @if ($kamar->favorite == null)
                {{-- Simpan kamar favorite --}}
                <a data-id-simpan="{{$kamar->id}}" id="simpan" class="btn btn-outline-black btn-sm" data-toggle="tooltip" data-placement="top" title="Simpan Kamar" style="font-size: 12px; font-weight:bold;">
                <i class="feather icon-heart"></i> Simpan</a>
              @else
                {{-- Hapus kamar favorite --}}
                @if ($fav)
                  <a data-id-hapus="{{$fav->id}}" id="hapus" class="btn btn-outline-black btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Kamar" style="font-size: 12px; font-weight:bold;">
                  <i class="feather icon-heart"></i> Hapus</a>
                @else
                  <a data-id-simpan="{{$kamar->id}}" id="simpan" class="btn btn-outline-black btn-sm" data-toggle="tooltip" data-placement="top" title="Simpan Kamar" style="font-size: 12px; font-weight:bold;">
                  <i class="feather icon-heart"></i> Simpan</a>
                @endif
              @endif
            @else
              <a href="{{route('login')}}" class="btn btn-outline-black btn-sm" data-toggle="tooltip" data-placement="top" title="Silahkan Login" style="font-size: 12px; font-weight:bold;"> <i class="feather icon-heart"></i>  Simpan</a>
            @endauth

              <div class="btn-group" data-toggle="tooltip" data-placement="top" title="Bagikan kamar">
                <div class="dropdown">
                    <button class="btn btn-outline-black btn-sm" id="share" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 12px; font-weight:bold;">
                        <i class="feather icon-share-2"></i> Bagikan
                    </button>
                    <div class="dropdown-menu" aria-labelledby="share">
                        <a class="dropdown-item" target="_blank" href="{{ Share::currentPage($kamar->nama_kamar)->facebook()->getRawLinks() }}"> <i class="fa fa-facebook"></i> Facebook</a>
                        <a class="dropdown-item" target="_blank" href="{{ Share::currentPage($kamar->nama_kamar)->twitter()->getRawLinks() }}"><i class="fa fa-twitter"></i> Twitter</a>
                        <a class="dropdown-item" target="_blank" href="{{ Share::currentPage($kamar->nama_kamar)->telegram()->getRawLinks() }}"><i class="fa fa-telegram"></i> Telegram</a>
                        <a class="dropdown-item" target="_blank" href="{{ Share::currentPage($kamar->nama_kamar)->whatsapp()->getRawLinks() }}"><i class="fa fa-whatsapp"></i> WhatsApp</a>
                    </div>
                </div>
              </div>
              <p class="hidden" id="url"> {{url('room', $kamar->slug)}} </p>
              <a onclick="copyToClipboard('#url')" id="eventshow" class="btn btn-outline-black btn-sm" data-toggle="tooltip" data-placement="top" title="Salin link" style="font-size: 12px; font-weight:bold; color:black"> <i class="feather icon-copy"></i>  Copy link</a>
          </div>
        </div>
        <hr>

        <h3 style="font-weight: bold">Fasilitas</h3>
        <p style="font-size: 13px">
          <ol>
            <li>{{$kamar->listrik == 0 ? 'Tidak Termasuk Listrik' : 'Termasuk Listrik'}} <br></li>
            <li>Tidak Ada Minimum Pembayaran <br></li>
            <li>Diskon Jutaan</li>
          </ol>
          <hr style="border-top: 1px dashed ">
        </p>
        <h5 class="mt-1" style="font-weight: bold">Luas Kamar</h5>
        {{$kamar->luas_kamar}}

        <h5 class="mt-1" style="font-weight: bold">Fasilitas yang kamu dapatkan</h5>
        <div class="row">
          <p style="font-size: 13px">
            <div class="col-md-6">
              {{-- Fasilitas Kamar --}}
              @foreach ($kamar->fkamar as $fkamar)
                {{$fkamar->name}} <br>
              @endforeach

              {{-- Fasilitas Kamar Mandi --}}
              @foreach ($kamar->kmandi as $kmandi)
                {{$kmandi->name}} <br>
              @endforeach
            </div>
            <div class="col-md-6">
              {{-- Fasilitas Bersama --}}
              @foreach ($kamar->fbersama as $fbersama)
                {{$fbersama->name}} <br>
              @endforeach

              {{-- Fasilitas Parkir --}}
              @foreach ($kamar->fparkir as $fparkir)
                {{$fparkir->name}} <br>
              @endforeach
            </div>
          </p>
        </div>

        <h5 class="mt-1" style="font-weight: bold">Fasilitas umum</h5>
        <div class="d-flex justify-content-between">
          <p style="font-size: 13px">
            @foreach ($kamar->area as $area)
              {{$area->name}} <br>
            @endforeach
          </p>
        </div>

        <h5 class="mt-1" style="font-weight: bold">Keterangan Lain</h5>
        {{$kamar->ket_lain ?? '-'}}

        <h5 class="mt-1" style="font-weight: bold">Keterangan Biaya</h5>
        {{$kamar->ket_biaya ?? '-'}}

        <h5 class="mt-1" style="font-weight: bold">Peraturan selama ngekos</h5>
        {{$kamar->desc ?? '-'}}

        <h5 class="mt-1" style="font-weight: bold">Lokasi</h5>
        {{$kamar->alamat->alamat ?? '-'}} <br>
        <small style="text-decoration:underline"> {{ucfirst(strtolower($kamar->district->name))}}, {{ucfirst(strtolower($kamar->regencies->name))}}, {{ucfirst(strtolower($kamar->provinsi->name))}} </small>
        <hr>
          <h3 style="font-weight: bold">Reviews</h3> <br>
            @foreach ($kamar->reviews as $review)
              <div class="mb-3">
                <img src="https://cdn.pixabay.com/photo/2018/08/28/13/29/avatar-3637561_1280.png" width="40px" height="40px" class="rounded">
                <span class="font-weight-bold ml-1" style="font-size: 20px; color:black;">{{getNameUser($review->user_id)}}</span>
                <p class="ml-5" style="font-size: 10px; margin-top:-2%;">{{monthyear($review->created_at)}} </p>
                <span>{{$review->ulasan}}</span>
              </div>
            @endforeach
      </div>
    </div>
  </div>
    {{-- Cek jika kamar aktif --}}
    @if ($kamar->is_active == 1 && $kamar->status == 1)
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('sewa.store', $kamar->id)}}" method="post">
                    @csrf
                    <span> {{rupiah($kamar->promo != null && $kamar->promo->end_date_promo >= Carbon\carbon::now()->format('d F, Y') ? $kamar->promo->harga_promo : $kamar->harga_kamar)}} / Bulan </span> <span style="font-size: 9px"> {{$kamar->promo != null && $kamar->promo->end_date_promo >= Carbon\carbon::now()->format('d F, Y') ? 'Harga Promo' : ''}} </span>
                    <select class="DropChange" id="hargakamar" hidden>
                        <option value="{{$kamar->promo != null && $kamar->promo->end_date_promo >= Carbon\carbon::now()->format('d F, Y') ? $kamar->promo->harga_promo : $kamar->harga_kamar}}" selected></option>
                    </select>
                    <div class="row">
                        <div class="col-md-6 mt-1">
                        <input type="text" name="tgl_sewa" class="form-control datepicker mr-2" placeholder="Mulai Kos"  autocomplete="off" required>
                        </div>
                        <div class="col-md-6 mt-1">
                        <select name="lama_sewa" id="lamasewa" class="form-control DropChange">
                        <option>Lama Sewa</option>
                        <option value="1">1 Bulan</option>
                        <option value="3">3 Bulan</option>
                        </select>
                        </div>
                    </div>
                    <small>Kamu bisa mengajukan kos 2 bulan dari sekarang.</small>
                </div>
            </div>

            <div class="card">
                <div class="card-body" id="tampil">
                    <div class="d-flex justify-content-between">
                    <div>
                        <p>Harga Sewa <br>
                        Biaya Admin <br>
                        Deposit <br>
                        Point
                        </p>
                    </div>
                    <div>
                        <p style="color: black">
                        <span id="sewakamar"></span> <br>
                        Rp. {{rupiah($kamar->biaya_admin)}} <br>
                        Rp. {{rupiah($kamar->deposit)}} <br>
                        + 2 Points
                        </p>
                        <input type="hidden" class="DropChange" id="depost" value="{{$kamar->deposit}}">
                        <input type="hidden" class="DropChange" id="biayadmin" value="{{$kamar->biaya_admin}}">
                        @auth
                        <input type="hidden" class="DropChange" id="points" value="{{calculatePointUser(Auth::id())}}">
                        @endauth
                    </div>
                    </div>
                    <div class="mb-1 d-flex justify-content-between">
                    @auth
                    <div>
                        <div class="custom-control custom-switch custom-switch-danger switch-md mr-2 mb-1">
                        <input type="checkbox" name="credit" class="custom-control-input" id="useCredit" value="false">
                        <label class="custom-control-label" for="useCredit">
                        </label>
                        </div>
                    </div>
                    <div>
                    {{getPointUser(Auth::id())}} Points ( {{rupiah(calculatePointUser(Auth::id()))}} )
                    </div>
                    @endauth
                    </div>
                    <hr>
                    <h5 style="font-weight: bold">Keterangan</h5>
                    <ul>
                    <li style="font-size: 12px"><span style="color:black">Harga Sewa</span> adalah harga kamar dalam jangka 1 bulan.</li>
                    <li style="font-size: 12px"><span style="color:black">Biaya Admin</span> adalah biaya pelayanan yang di bebankan penyewa untuk Pap!Kos.</li>
                    <li style="font-size: 12px"><span style="color:black">Deposit</span> adalah biaya untuk penjaminan selama penyewa masih menggunakan kamar/apartmenent, (biaya akan dikembalikan setelah masa sewa habis).</li>
                    <li style="font-size: 12px"><span style="color:black">Point</span> adalah jumlah reward yang di dapatkan penyewa, point dapat di tukarkan untuk pembayaran.</li>
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between">
                    <div>
                        <p style="text-decoration:underline; color:black">
                        Total Pembayaran
                        </p>
                    </div>
                    <div id="harga">
                        <p style="color: black; font-weight:bold" id="hargatotal"></p>
                    </div>
                    <p id="show">
                        <span style="color: black; font-weight:bold" id="hargatotalpoints"></span>
                    </p>
                    </div>

                    @auth
                    @if (Auth::user()->role == 'Pencari')
                        @if ($kamar->sisa_kamar != 0 || $kamar->sisa_kamar > 0)
                            <button type="submit" class="btn btn-success btn-block">Ajukan Sewa</button>
                        @else
                            <button class="btn btn-success btn-block" disabled>Penuh</button>
                        @endif
                    @else
                        <button disabled="disabled" class="btn btn-info btn-block">Hanya Login Sebagai Pencari</button>
                        <small>Silahkan masuk menggunakan akun pencari untuk melanjutkan.</small>
                    @endif
                    @else
                    <a href="{{route('login')}}" class="btn btn-outline-primary btn-block">Masuk</a>
                    @endauth
                </div>
            </div>
            </form>
        </div>
    @else
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <small class="text-danger">Kamar sedang tidak aktif dan tidak dapat dipesan.</small>
                </div>
            </div>
        </div>
    @endif
</div>

@include('front.relatedKos')
@endsection
