@extends('layouts.backend.app')
@section('title','Update Promo Kosan')
@section('content')
<section id="basic-vertical-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Update Promo Kosan  </h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="{{route('kamar.promo.update', $kamar->id)}}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-body ">
                <div class="row">
                  <div class="col-sm-6">
                      <label class="col-form-label">Pilih Kamar Kosan</label>
                      <input type="text" class="form-control" value="{{$kamar->kamar->nama_kamar}}" disabled>
                  </div>

                  <div class="col-sm-3">
                      <label class="col-form-label">Harga Kamar Saat Ini</label>
                      <input type="text" class="form-control" value="{{rupiah($kamar->kamar->harga_kamar)}}" disabled>
                      @error('harga_promo')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-3">
                      <label class="col-form-label">Harga Kamar Promo</label>
                      <input type="text" class="form-control @error('harga_promo') is-invalid @enderror" name="harga_promo" value=" {{$kamar->harga_promo}} " placeholder="Rp.">
                      @error('harga_promo')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-6">
                      <label class="col-form-label">Tanggal Mulai</label>
                      <input type="date" class="form-control pickadate @error('start_date_promo') is-invalid @enderror" name="start_date_promo" placeholder="Tanggal Mulai">
                      @error('start_date_promo')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-6">
                      <label class="col-form-label">Tanggal Berakhir</label>
                      <input type="date" class="form-control pickadate @error('end_date_promo') is-invalid @enderror" name="end_date_promo" placeholder="Tanggal Berakhir">
                      @error('end_date_promo')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-12">
                      <label class="col-form-label">Keterangan</label>
                      <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="4"></textarea>
                      @error('keterangan')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                </div>
                <div class="form-group row ">
                    <div class="col-sm-10 mt-1">
                        <button type="submit" class="btn btn-primary">Update Promo</button>
                        <a href="{{route('kamar.promo')}}" class="btn btn-warning">Batal</a>
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
