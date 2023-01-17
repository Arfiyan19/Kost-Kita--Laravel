@extends('layouts.backend.app')
@section('title')
  Tulis Review
@endsection

@section('content')
<section id="basic-vertical-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tulis Review Kosan</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="{{url('user/review-proses',$review->key)}}" method="POST">
              @csrf
              <div class="form-body ">
                <div class="row">
                  <div class="col-sm-12">
                      <label class="col-form-label">Nama Kosan</label>
                      <input type="text" class="form-control" value=" {{$review->kamar->nama_kamar}}" disabled>
                  </div>
                  <div class="col-sm-6">
                      <label class="col-form-label">Tanggal Mulai</label>
                      <input type="text" class="form-control" value=" {{$review->tgl_sewa}}" disabled>
                  </div>

                  <div class="col-sm-6">
                      <label class="col-form-label">Tanggal Berakhir</label>
                      <input type="text" class="form-control" value=" {{$review->end_date_sewa}}" disabled>
                  </div>

                  <div class="col-sm-12">
                      <label class="col-form-label">Ulasan Kamar/kosan</label>
                      <textarea name="ulasan" class="form-control @error('ulasan') is-invalid @enderror" rows="4"></textarea>
                      @error('ulasan')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                </div>
                <div class="form-group row ">
                    <div class="col-sm-10 mt-1">
                        <button type="submit" class="btn btn-primary">Tulis Review</button>
                        <a href="{{url('user/myroom')}}" class="btn btn-warning">Batal</a>
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
