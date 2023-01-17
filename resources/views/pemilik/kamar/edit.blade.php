@extends('layouts.backend.app')
@section('title','Edit Data Kosan')
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
<section id="basic-vertical-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Kamar</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="{{route('kamar.update', $edit->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body ">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="col-form-label">Nama Kamar</label>
                            <input type="text" class="form-control" name="nama_kamar" value="{{$edit->nama_kamar}}" placeholder="Nama Kamar" autocomplete="off">
                        </div>
                        <div class="col-sm-3">
                            <label class="col-form-label">Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="">--Kategori Kamar--</option>
                                <option value="Kost" {{$edit->kategori == 'Kost' ? 'selected' : ''}} >Kost</option>
                                <option value="Apartment" {{$edit->kategori == 'Apartment' ? 'selected' : ''}}>Apartment</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-form-label">Jenis Kamar</label>
                            <select name="jenis_kamar" class="form-control">
                                <option value="">--Putra/Putri--</option>
                                <option value="Putra" {{$edit->jenis_kamar == 'Putra' ? 'selected' : ''}}>Putra</option>
                                <option value="Putri" {{$edit->jenis_kamar == 'Putri' ? 'selected' : ''}}>Putri</option>
                                <option value="Campur" {{$edit->jenis_kamar == 'Campur' ? 'selected' : ''}}>Campur</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="col-form-label">Status Booking</label>
                            <select name="book" class="form-control">
                                <option value="">-- Aktif/Non-aktif --</option>
                                <option value="1" {{$edit->book == '1' ? 'selected' : ''}}>Aktif</option>
                                <option value="0" {{$edit->book == '0' ? 'selected' : ''}}>Tidak</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-form-label">Luas Kamar</label>
                            <input type="text" class="form-control" name="luas_kamar" value="{{$edit->luas_kamar}}" placeholder="Contoh 3 x 4">
                        </div>
                        <div class="col-sm-3">
                            <label class=" col-form-label">Stok Kamar</label>
                            <input type="number" class="form-control" name="stok_kamar" value="{{$edit->stok_kamar}}" placeholder="Kamar Tersedia">
                        </div>
                        <div class="col-sm-3">
                            <label class="col-form-label">Harga Kamar</label>
                            <input type="number" class="form-control" name="harga_kamar" value="{{$edit->harga_kamar}}" placeholder="Harga Kamar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="col-form-label">Biaya Listrik</label>
                        <select name="listrik" class="form-control">
                            <option value="">-- Listrik Kamar --</option>
                            <option value="1" {{$edit->listrik == '1' ? 'selected' : ''}}>Termasuk Listrik</option>
                            <option value="0" {{$edit->listrik == '0' ? 'selected' : ''}}>Tidak Termasuk Listrik</option>
                        </select>
                    </div>

                    <div class="col-sm-3">
                        <label class="col-form-label">Provinsi</label>
                        <select name="province_id" class="form-control" id="select2" disabled>
                            <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinsi as $item)
                                    <option value="{{$item->id}}" {{$edit->province_id == $item->id ? 'selected' : ''}} >{{$item->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Regency</label>
                        <input type="text" class="form-control" disabled value="{{$edit->regencies->name}}">
                        @error('regency_id')
                          <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">District</label>
                        <input type="text" class="form-control" disabled value="{{$edit->district->name}}">
                        @error('district_id')
                          <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                    </div>

                    <div class="col-sm-3">
                        <label class="col-form-label">Biaya Deposit</label>
                        <input type="number" name="deposit" class="form-control @error('deposit') is-invalid @enderror" value="{{$edit->deposit}}" placeholder="Biaya Deposit">
                        @error('deposit')
                          <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                    </div>

                    <div class="col-sm-3">
                        <label class="col-form-label">Biaya Admin</label>
                        <input type="number" name="biaya_admin" class="form-control @error('biaya_admin') is-invalid @enderror" value="{{$edit->biaya_admin}}" placeholder="Biaya Admin">
                        @error('biaya_admin')
                          <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                    </div>

                    <div class="col-12">
                      <label class="col-form-label">Alamat Lengkap Kos</label>
                      <textarea name="alamat" class="form-control" id="alamat" rows="4" placeholder="Tulis lengkap alamat kos disini"> {{$edit->alamat->alamat ?? '-'}} </textarea>
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
                            <textarea name="ket_lain" class="form-control" rows="4" placeholder="Opsional">{{$edit->ket_lain}}</textarea>
                        </div>
                        <div class="col-sm-4">
                            <label class=" col-form-label">Keterangan Biaya</label>
                            <textarea name="ket_biaya" class="form-control" rows="4" placeholder="Opsional">{{$edit->ket_biaya}}</textarea>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label">Deskripsi</label>
                            <textarea name="desc" class="form-control" rows="4" placeholder="Opsional">{{$edit->desc}}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Start Fasilitas Kamar --}}
                <span id="fkamar">
                    <div class="form-group">
                        <div class="row">
                          @foreach ($edit->fkamar as $fkamar)
                            <div class="col-lg-5 col-xl-5 col-10">
                              <label class="col-form-label">Fasilitas Kamar</label>
                              <input type="text" class="form-control" value="{{$fkamar->name}}" placeholder="Fasilitas Kamar" readonly>
                              <a href="{{url('pemilik/delete/fasilitas-kamar', $fkamar->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                          @endforeach
                        <div class="col-2 col-lg-1 col-xl-1">
                            <input type="button" id="addfkamar" name="addfkamar" class="form-control btn btn-success btn-sm mt-3" value="+">
                        </div>
                        </div>
                    </div>
                </span>
                {{-- End Fasilitas Kamar --}}
                <hr>
                {{-- Start Fasilitas Kamar Mandi --}}
                <span id="fkm">
                    <div class="form-group">
                        <div class="row">
                            @foreach ($edit->kmandi as $kamandis)
                              <div class="col-lg-5 col-xl-5 col-10">
                                <label class="col-form-label">Fasilitas Kama Mandi</label>
                                <input type="text" class="form-control" value="{{$kamandis->name}}" placeholder="Fasilitas Kama Mandi" readonly>
                                <a href="{{url('pemilik/delete/fasilitas-kamar-mandi', $kamandis->id)}}" class="btn btn-danger btn-sm">Delete</a>
                              </div>
                            @endforeach
                            <div class="col-2 col-lg-1 col-xl-1">
                                <input type="button" id="addkm" name="addkm" class="form-control btn btn-success btn-sm mt-3" value="+">
                            </div>
                        </div>
                    </div>
                </span>
                {{-- End Fasilitas Kamar Mandi --}}
                <hr>
                {{-- Start Fasilitas Bersama --}}
                    <span id="fbersama">
                        <div class="form-group ">
                            <div class="row">
                                @foreach ($edit->fbersama as $fbersamas)
                                  <div class="col-lg-5 col-xl-5 col-10">
                                    <label class="col-form-label">Fasilitas Bersama</label>
                                    <input type="text" class="form-control" value="{{$fbersamas->name}}" placeholder="Fasilitas Bersama" readonly>
                                    <a href="{{url('pemilik/delete/fasilitas-bersama', $fbersamas->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                  </div>
                                @endforeach
                                <div class="col-2 col-lg-1 col-xl-1">
                                    <input type="button" id="addbersama" name="addbersama" class="form-control btn btn-success btn-sm mt-3" value="+">
                                </div>
                            </div>
                        </div>
                    </span>
                {{-- End Fasilitas Bersama --}}
                  <hr>
                {{-- Start Fasilitas Parkir --}}
                <span id="fparkir">
                  <div class="form-group ">
                      <div class="row">
                          @foreach ($edit->fparkir as $parkir)
                            <div class="col-lg-5 col-xl-5 col-10">
                              <label class="col-form-label">Fasilitas Parkir</label>
                              <input type="text" class="form-control" value="{{$parkir->name}}" placeholder="Fasilitas Parkir" readonly>
                              <a href="{{url('pemilik/delete/fasilitas-parkir', $parkir->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                          @endforeach
                          <div class="col-2 col-lg-1 col-xl-1">
                              <input type="button" id="addparkir" name="addparkir" class="form-control btn btn-success btn-sm mt-3" value="+">
                          </div>
                      </div>
                  </div>
                </span>
                {{-- End Fasilitas Parkir --}}
                <hr>
                {{-- Start Area --}}
                <span id="farea">
                  <div class="form-group ">
                      <div class="row">
                          @foreach ($edit->area as $area)
                            <div class="col-lg-5 col-xl-5 col-10">
                              <label class="col-form-label">Area Lingkungan</label>
                              <input type="text" class="form-control" value="{{$area->name}}" placeholder="Area Lingkungan" readonly>
                              <a href="{{url('pemilik/delete/area', $parkir->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                          @endforeach
                          <div class="col-2 col-lg-1 col-xl-1">
                              <input type="button" id="addarea" name="addarea" class="form-control btn btn-success btn-sm mt-3" value="+">
                          </div>
                      </div>
                  </div>
                </span>
                {{-- End Area --}}

                {{-- Start Image --}}
                <div class="form-group ">
                    <div class="row">
                      @foreach ($edit->fotoKamar as $foto)
                        <div class="col-lg-1 col-xl-1 col-2">
                            <label class="col-form-label">Foto Kamar</label> <br>
                            <img src="{{asset('storage/images/foto_kamar/' .$foto->foto_kamar)}}" style="width: 80px">
                            <a href="{{url('pemilik/delete/foto-kamar', $foto->foto_kamar)}}" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                      @endforeach
                    </div>
                </div>

                <span id="image">
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-lg-5 col-xl-5 col-10">
                              <label class="col-form-label">Tambah Foto Kamar</label>
                                <input type="file" class="form-control @error('addfoto[0][name]') is-invalid @enderror" name="addfoto[0][foto_kamar]">
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
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('kamar.index')}}" class="btn btn-warning">Batal</a>
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

@endsection
