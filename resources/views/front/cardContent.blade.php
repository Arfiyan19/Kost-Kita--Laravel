@if ($kamar->total() == null)
  <h4 style="text-align: center">Belum ada kamar yang tersedia.</h4>
@else
  <div class="card-btn d-flex justify-content-between mt-2">
    <p style="color:black; font-size:1rem; font-weight:bold">Rekomendasi</p>
    @if ($kamar->total() >= 8)
    <a href="{{url('show-all-room')}}" class="btn btn-outline-info mb-1" style="color:black">Lihat Semua</a>
    @endif
  </div>
  <div class="row match-height">
    @foreach ($kamar as $kamars)
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
                ? $kamars->promo->harga_promo : $kamars->harga_kamar
                )}} / Bulan
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
    @endforeach
  </div>
  <div style="text-align: center;" class="mt-1">
    {{ $kamar->links() }}
  </div>
@endif
