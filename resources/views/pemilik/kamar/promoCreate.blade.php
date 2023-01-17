@extends('layouts.backend.app')
@section('title','Tambah Promo Kosan')
@section('content')
<section id="basic-vertical-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Promo Kosan</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="{{route('kamar.promo.store')}}" method="POST">
              @csrf
              <div class="form-body ">
                <div class="row">
                  <div class="col-sm-6">
                      <label class="col-form-label">Pilih Kamar Kosan</label>
                      <select name="kamar_id" class="form-control select2 @error('kamar_id') is-invalid @enderror">
                        <option value="">-- Pilih Kamar --</option>
                        @forelse ($kamar as $kamars)
                          <option value="{{$kamars->id}}"> {{$kamars->nama_kamar}} - {{rupiah($kamars->harga_kamar)}} </option>
                        @empty
                          <option value="">Tidak ada kamar yang bisa di pilih.</option>
                        @endforelse
                      </select>
                      @error('kamar_id')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-6">
                      <label class="col-form-label">Harga Kamar Promo</label>
                      <input type="number" class="form-control @error('harga_promo') is-invalid @enderror" name="harga_promo" placeholder="Rp.">
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
                        <button type="submit" class="btn btn-primary">Tambah Promo</button>
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
