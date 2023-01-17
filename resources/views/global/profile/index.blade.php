@extends('layouts.backend.app')
@section('title','Profile')
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
<div class="content-body">
  <!-- account setting page start -->
  <section id="page-account-settings">
    <div class="row">
      <!-- left menu section -->
      <div class="col-md-3 mb-2 mb-md-0">
          <ul class="nav nav-pills flex-column mt-md-0 mt-1">
              {{-- Jika user sebagai pemilik --}}
              @if (Auth::user()->role == 'Pemilik')
                <li class="nav-item">
                  <a class="nav-link d-flex py-75 active" id="profile" data-toggle="pill" href="#data-profile" aria-expanded="true">
                    <i class="feather icon-user mr-50 font-medium-3"></i>
                      Profile
                    </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link d-flex py-75" id="rekening" data-toggle="pill" href="#data-rekening" aria-expanded="true">
                    <i class="feather icon-credit-card mr-50 font-medium-3"></i>
                      Rekening Bank
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="testimoni" data-toggle="pill" href="#data-testimoni" aria-expanded="true">
                        <i class="feather icon-cast mr-50 font-medium-3"></i>
                        Testimoni
                    </a>
                </li>
              @else
              {{-- Jika user sebagai penghuni --}}
                <li class="nav-item">
                  <a class="nav-link d-flex py-75 active" id="profile-user" data-toggle="pill" href="#data-profile-user" aria-expanded="true">
                    <i class="feather icon-user mr-50 font-medium-3"></i>
                      Profile
                    </a>
                </li>
              @endif
          </ul>
      </div>
      <!-- right content section -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="tab-content">
                {{-- Jika User sebagai pemilik --}}
                @if (Auth::user()->role == 'Pemilik')
                  {{-- Profile --}}
                  <div role="tabpanel" class="tab-pane active" id="data-profile" aria-labelledby="profile" aria-expanded="true">
                    <form action="{{url('profile', Auth::id())}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <div class="controls">
                              <label for="Nama Bank">Nama</label>
                              <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-group">
                            <div class="controls">
                              <label for="Email">Email</label>
                              <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Email">
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-group">
                            <div class="controls">
                              <label for="nomor wa">Nomor WhatsApp</label>
                              <input type="number" name="no_wa" value="{{Auth::user()->no_wa ?? '0'}}" class="form-control">
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-group">
                            <div class="controls">
                              <label for="nomor wa">{{Auth::user()->foto == null ? 'Foto Profile' : 'Update Foto Profile'}}</label>
                              <input type="file" name="foto" class="form-control">
                            </div>
                          </div>
                        </div>

                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-start">
                          <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                          <a href="/home" class="btn btn-outline-warning">Cancel</a>
                        </div>
                      </div>
                    </form>
                  </div>

                  {{-- Rekening --}}
                  <div role="tabpanel" class="tab-pane" id="data-rekening" aria-labelledby="rekening" aria-expanded="true">
                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#inlineForm">Tambah Rekening</a>
                    <p>
                      Kamu dapat menambahkan Akun Rekening Bank maksimal berjumlah 3 (tiga) akun. Rekening bank yang terdaftar dapat digunakan sebagai tujuan pembayaran.
                    </p>
                    @foreach ($bank as $banks)
                      <div class="card" style="border: 1px solid white">
                        <div class="card-body ">
                          {{$banks->nama_bank}} <br>
                          <small> {{$banks->no_rekening}} </small> <br>
                          <p>{{$banks->nama_pemilik}}</p>
                          <a class="mr-2 btn btn-outline-info btn-sm">{{$banks->is_active == 1 ? 'Aktif' : 'Inactive'}}</a>
                          <a class="mr-2 btn btn-outline-warning btn-sm" id="klik_edit_bank" data-toggle="modal" data-target="#editBank"
                          data-id="{{$banks->id}}"
                          data-rekening={{$banks->no_rekening}}
                          data-nama-pemilik={{$banks->nama_pemilik}}
                          data-nama-bank={{$banks->nama_bank}}
                          >Edit</a>
                          <a id="is_active" data-id={{$banks->id}} class="mr-2 btn btn-outline-{{$banks->is_active == 1 ? 'primary' : 'danger'}} btn-sm">{{$banks->is_active == 0 ? 'Aktifkan' : 'Non Aktifkan'}}</a>
                        </div>
                      </div>
                    @endforeach
                  </div>

                 {{-- Modal tambah rekening --}}
                 @include('pemilik.bank.index')
                 @include('pemilik.bank.edit')

                  {{-- Testimoni --}}
                  <div role="tabpanel" class="tab-pane" id="data-testimoni" aria-labelledby="testimoni" aria-expanded="true">
                    @if (empty(Auth::user()->testimoni->user_id))
                      <form action="{{url('pemilik/testimoni')}}" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <div class="controls">
                                <label for="Testimoni">Testimoni</label>
                                <textarea name="testimoni" class="form-control" rows="5" placeholder="Tulis Ulasan Kamu Disini"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="col-12 d-flex flex-sm-row flex-column justify-content-start">
                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save</button>
                            <a href="/home" class="btn btn-outline-warning">Cancel</a>
                          </div>
                        </div>
                      </form>
                    @else
                      <h3>Testimoni Sudah Diisi !</h3>
                    @endif
                  </div>
                @else
                {{-- Jika User sebagai penghuni --}}
                  {{-- Profile --}}
                  <div role="tabpanel" class="tab-pane active" id="data-profile-profile" aria-labelledby="profile-profile" aria-expanded="true">
                    <form action="{{url('profile', Auth::id())}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <div class="controls">
                              <label for="Nama Bank">Nama</label>
                              <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-group">
                            <div class="controls">
                              <label for="Email">Email</label>
                              <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Email">
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-group">
                            <div class="controls">
                              <label for="nomor wa">Nomor WhatsApp</label>
                              <input type="number" name="no_wa" value="{{Auth::user()->no_wa ?? '0'}}" class="form-control">
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-group">
                            <div class="controls">
                              <label for="nomor wa">{{Auth::user()->foto == null ? 'Foto Profile' : 'Update Foto Profile'}}</label>
                              <input type="file" name="foto" class="form-control">
                            </div>
                          </div>
                        </div>

                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-start">
                          <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                          <a href="/home" class="btn btn-outline-warning">Cancel</a>
                        </div>
                      </div>
                    </form>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- account setting page end -->
</div>
@endsection
@section('scripts')
  <script type="text/javascript">

    @if (count($errors) > 0)
      $( document ).ready(function() {
        $('#inlineForm').modal('show');
      });
    @endif

    // Tampilkan Modal Edit Bank
    $(document).on('click','#klik_edit_bank', function(){
        var id = $(this).attr('data-id');
        var no_rekening = $(this).attr('data-rekening')
        var nama_pemilik = $(this).attr('data-nama-pemilik')
        var nama_bank = $(this).attr('data-nama-bank')

        $("#id_bank").val(id)
        $("#no_rekening").val(no_rekening)
        $("#nama_pemilik").val(nama_pemilik)
        $("#nama_bank").val(nama_bank)
    });

    // Proses Edit Bank
    $(document).on('click','#update_bank', function(){
        var id_bank = $("#id_bank").val();
        var no_rekening = $("#no_rekening").val();
        var nama_pemilik = $("#nama_pemilik").val();
        var nama_bank = $("#nama_bank").val();

        $.get('{{Url("rekening/update")}}',{'_token': $('meta[name=csrf-token]').attr('content'),id_bank:id_bank,no_rekening:no_rekening,nama_pemilik:nama_pemilik,nama_bank:nama_bank}, function(resp){
            $("#id_bank").val('');
            $("#no_rekening").val('');
            $("#nama_pemilik").val('');
            $("#nama_bank").val('');
            location.reload();
        });
    });

    // Non Aktifkan / Aktifkan Bank
    $(document).on('click', '#is_active', function () {
        var id = $(this).attr('data-id');
        $.get('is-active-bank', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(_resp){
            location.reload()
        });
    });
  </script>
@endsection
