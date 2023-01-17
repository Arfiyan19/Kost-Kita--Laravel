@extends('layouts.backend.app')
@section('title','Tambah Kosan')
@section('content')
<section id="basic-vertical-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Kosan</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="{{route('kamar.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-body ">
                <div class="row">
                  <div class="col-sm-12">
                      <label class="col-form-label">Nama Kamar</label>
                      <input type="text" class="form-control @error('nama_kamar') is-invalid @enderror" name="nama_kamar" placeholder="Nama Kamar" value="{{old('nama_kamar')}}" autocomplete="off">
                      <small style="color: red">*Tanpa nama provinsi/kota/kabupaten</small>
                      @error('nama_kamar')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                  <div class="col-sm-3">
                      <label class="col-form-label">Kategori</label>
                      <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                          <option value="">--Kategori Kamar--</option>
                          <option value="Kost" {{old('kategori') == 'Kost' ? 'selected' : ''}} >Kost</option>
                          <option value="Apartment" {{old('kategori') == 'Apartment' ? 'selected' : ''}}>Apartment</option>
                      </select>
                      @error('kategori')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                  <div class="col-sm-3">
                      <label class="col-form-label">Jenis Kamar</label>
                      <select name="jenis_kamar" class="form-control @error('jenis_kamar') is-invalid @enderror">
                          <option value="">--Putra/Putri--</option>
                          <option value="Putra" {{old('jenis_kamar') == 'Putra' ? 'selected' : ''}}>Putra</option>
                          <option value="Putri" {{old('jenis_kamar') == 'Putri' ? 'selected' : ''}}>Putri</option>
                          <option value="Campur" {{old('jenis_kamar') == 'Campur' ? 'selected' : ''}}>Campur</option>
                      </select>
                      @error('jenis_kamar')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                  <div class="col-sm-3">
                      <label class="col-form-label">Background Foto Kamar</label>
                      <input type="file" name="bg_foto" class="form-control @error('bg_foto') is-invalid @enderror ">
                      @error('bg_foto')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-3">
                      <label class="col-form-label">Status Booking</label>
                      <select name="book" class="form-control @error('book') is-invalid @enderror">
                          <option value="">-- Aktif/Non-aktif --</option>
                          <option value="1" {{old('book') == '1' ? 'selected' : ''}}>Aktif</option>
                          <option value="0" {{old('book') == '0' ? 'selected' : ''}}>Tidak</option>
                      </select>
                      @error('book')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                  <div class="col-sm-3">
                      <label class="col-form-label">Luas Kamar</label>
                      <input type="text" name="luas_kamar" class="form-control @error('luas_kamar') is-invalid @enderror" value="{{old('luas_kamar')}}" placeholder="Contoh 3 x 4">
                      @error('luas_kamar')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                  <div class="col-sm-3">
                      <label class=" col-form-label">Stok Kamar</label>
                      <input type="number" name="stok_kamar" class="form-control @error('stok_kamar') is-invalid @enderror"  value="{{old('stok_kamar')}}" placeholder="Kamar Tersedia">
                      @error('stok_kamar')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                  <div class="col-sm-3">
                      <label class="col-form-label">Harga Kamar</label>
                      <input type="number" name="harga_kamar" class="form-control @error('harga_kamar') is-invalid @enderror" value="{{old('harga_kamar')}}" placeholder="Harga Kamar">
                      @error('harga_kamar')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-3">
                      <label class="col-form-label">Biaya Listrik</label>
                      <select name="listrik" class="form-control @error('listrik') is-invalid @enderror">
                          <option value="">-- Listrik Kamar --</option>
                          <option value="1" {{old('listrik') == '1' ? 'selected' : ''}}>Termasuk Listrik</option>
                          <option value="0" {{old('listrik') == '0' ? 'selected' : ''}}>Tidak Termasuk Listrik</option>
                      </select>
                      @error('listrik')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-4">
                      <label class="col-form-label">Provinsi</label>
                      <select name="province_id" class="form-control select2 @error('province_id') is-invalid @enderror" id="province">
                        <option value="">-- Pilih Provinsi --</option>
                          @foreach ($provinsi as $item)
                              <option value="{{$item->id}}" >{{$item->name}}</option>
                          @endforeach
                      </select>
                      @error('province_id')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                  <div class="col-sm-4">
                      <label class="col-form-label">Regency</label>
                      <select name="regency_id" class="form-control select2  @error('regency_id') is-invalid @enderror" id="regency"></select>
                      @error('regency_id')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>
                  <div class="col-sm-4">
                      <label class="col-form-label">District</label>
                      <select name="district_id" class="form-control select2  @error('district_id') is-invalid @enderror" id="district"></select>
                      @error('district_id')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-4">
                      <label class="col-form-label">Biaya Deposit</label>
                      <input type="number" name="deposit" class="form-control @error('deposit') is-invalid @enderror" value="{{old('deposit')}}" placeholder="Biaya Deposit">
                      @error('deposit')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-sm-4">
                      <label class="col-form-label">Biaya Admin</label>
                      <input type="number" name="biaya_admin" class="form-control @error('biaya_admin') is-invalid @enderror" value="{{old('biaya_admin')}}" placeholder="Biaya Admin">
                      @error('biaya_admin')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                  </div>

                  <div class="col-12">
                    <label class="col-form-label">Alamat Lengkap Kos</label>
                    <textarea name="alamat" class="form-control  @error('alamat') is-invalid @enderror" id="alamat" rows="4" placeholder="Tulis lengkap alamat kos disini"></textarea>
                    @error('alamat')
                      <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                      </div>
                      @enderror
                  </div>
                </div>

                <div class="form-group ">
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="col-form-label">Keterangan Lain</label>
                            <textarea name="ket_lain" class="form-control @error('ket_lain') is-invalid @enderror" rows="4" placeholder="Opsional"> {{old('ket_lain')}} </textarea>
                            @error('ket_lain')
                              <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                              </div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label class=" col-form-label">Keterangan Biaya</label>
                            <textarea name="ket_biaya" class="form-control @error('ket_biaya') is-invalid @enderror" rows="4" placeholder="Opsional"> {{old('ket_biaya')}} </textarea>
                            @error('ket_biaya')
                              <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                              </div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label">Deskripsi</label>
                            <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" rows="4" placeholder="Opsional"> {{old('desc')}} </textarea>
                            @error('desc')
                              <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                              </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Start Fasilitas Kamar --}}
                <span id="fkamar">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-xl-5 col-10">
                            <label class="col-form-label">Fasilitas Kamar</label>
                            <input type="text" name="addmore[0][name]" class="form-control @error('addmore[0][name]') is-invalid @enderror" placeholder="Fasilitas Kamar" required>
                            @error('addmore[0][name]')
                              <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                              </div>
                            @enderror
                        </div>
                        <div class="col-2 col-lg-1 col-xl-1">
                            <label class="col-form-label">.</label>
                            <input type="button" id="addfkamar" name="addfkamar" class="form-control btn btn-success btn-sm" value="+">
                        </div>
                        </div>
                    </div>
                </span>
                {{-- End Fasilitas Kamar --}}

                {{-- Start Fasilitas Kamar Mandi --}}
                    <span id="fkm">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-5 col-xl-5 col-10">
                                    <label class="col-form-label">Fasilitas Kamar Mandi</label>
                                    <input type="text" name="addkm[0][name]" class="form-control @error('addkm[0][name]') is-invalid @enderror" placeholder="Fasilitas Kamar Mandi" required>
                                    @error('addkm[0][name]')
                                      <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                      </div>
                                    @enderror
                                </div>
                                <div class="col-2 col-lg-1 col-xl-1">
                                    <label class="col-form-label">.</label>
                                    <input type="button" id="addkm" name="addkm" class="form-control btn btn-success btn-sm" value="+">
                                </div>
                            </div>
                        </div>
                    </span>
                {{-- End Fasilitas Kamar Mandi --}}

                {{-- Start Fasilitas Bersama --}}
                    <span id="fbersama">
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-lg-5 col-xl-5 col-10">
                                    <label class="col-form-label">Fasilitas Bersama</label>
                                    <input type="text" class="form-control @error('addbersama[0][name]') is-invalid @enderror" name="addbersama[0][name]" placeholder="Fasilitas Bersama" required>
                                    @error('addbersama[0][name]')
                                      <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                      </div>
                                    @enderror
                                </div>
                                <div class="col-2 col-lg-1 col-xl-1">
                                    <label class="col-form-label">.</label>
                                    <input type="button" id="addbersama" name="addbersama" class="form-control btn btn-success btn-sm" value="+">
                                </div>
                            </div>
                        </div>
                    </span>
                {{-- End Fasilitas Bersama --}}

                {{-- Start Fasilitas Parkir --}}
                  <span id="fparkir">
                      <div class="form-group ">
                          <div class="row">
                              <div class="col-lg-5 col-xl-5 col-10">
                                  <label class="col-form-label">Fasilitas Parkir</label>
                                  <input type="text" class="form-control @error('addparkir[0][name]') is-invalid @enderror" name="addparkir[0][name]" placeholder="Fasilitas Parkir" required>
                                  @error('addparkir[0][name]')
                                    <div class="invalid-feedback">
                                      <strong>{{ $message }}</strong>
                                    </div>
                                  @enderror
                              </div>
                              <div class="col-2 col-lg-1 col-xl-1">
                                  <label class="col-form-label">.</label>
                                  <input type="button" id="addparkir" name="addparkir" class="form-control btn btn-success btn-sm" value="+">
                              </div>
                          </div>
                      </div>
                  </span>
                {{-- End Fasilitas Parkir --}}

                {{-- Start Area --}}
                  <span id="farea">
                      <div class="form-group ">
                          <div class="row">
                              <div class="col-lg-5 col-xl-5 col-10">
                                  <label class="col-form-label">Area Lingkungan</label>
                                  <input type="text" class="form-control @error('addarea[0][name]') is-invalid @enderror" name="addarea[0][name]" placeholder="Area Lingkungan" required>
                                  @error('addarea[0][name]')
                                    <div class="invalid-feedback">
                                      <strong>{{ $message }}</strong>
                                    </div>
                                  @enderror
                              </div>
                              <div class="col-2 col-lg-1 col-xl-1">
                                  <label class="col-form-label">.</label>
                                  <input type="button" id="addarea" name="addarea" class="form-control btn btn-success btn-sm" value="+">
                              </div>
                          </div>
                      </div>
                  </span>
                {{-- End Area --}}

                {{-- Start Image --}}
                  <span id="image">
                      <div class="form-group ">
                          <div class="row">
                              <div class="col-lg-5 col-xl-5 col-10">
                                  <label class="col-form-label">Foto Kamar</label>
                                  <input type="file" class="form-control @error('addfoto[0][name]') is-invalid @enderror" name="addfoto[0][foto_kamar]" required>
                                  @error('addfoto[0][name]')
                                    <div class="invalid-feedback">
                                      <strong>{{ $message }}</strong>
                                    </div>
                                  @enderror
                              </div>
                              <div class="col-2 col-lg-1 col-xl-1">
                                  <label class="col-form-label">.</label>
                                  <input type="button" id="addfoto" name="addfoto" class="form-control btn btn-success btn-sm" value="+">
                              </div>
                          </div>
                      </div>
                  </span>
                {{-- End Image --}}

                <div class="form-group row ">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah Kosan</button>
                        <a href="{{route('kamar.index')}}" class="btn btn-warning">Batal</a>
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
@section('scripts')
  <script src="{{asset('ctrl/kamar/create.js')}}"></script>

  <script type="text/javascript">
  $('#province').change(function(){
    var provinceID = $(this).val();
    if(provinceID){
      $.ajax({
        type:"GET",
        url:"{{url('select-regency')}}?province_id="+provinceID,
        success:function(res){
          console.log(res);
        if(res){
          $("#regency").empty();
          $("#regency").append('<option>Select Regency</option>');
          $.each(res,function(key,value){
            $("#regency").append('<option value="'+value.id+'">'+value.name+'</option>');
          });

        }else{
          $("#regency").empty();
        }
        }
      });
    }else{
      $("#regency").empty();
      $("#district").empty();
    }
    });
    $('#regency').on('change',function(){
    var regencyID = $(this).val();
    if(regencyID){
      $.ajax({
        type:"GET",
        url:"{{url('select-district')}}?regency_id="+regencyID,
        success:function(res){
        if(res){
          $("#district").empty();
          $("#district").append('<option>Select District</option>');
          $.each(res,function(key,value){
            $("#district").append('<option value="'+value.id+'">'+value.name+'</option>');
          });

        }else{
          $("#district").empty();
        }
        }
      });
    }else{
      $("#district").empty();
    }

    });
  </script>
@endsection