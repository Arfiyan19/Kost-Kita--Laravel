@extends('layouts.backend.app')
@section('title','Dashboard Admin')
@section('content')
  @if($message = Session::get('success'))
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

  <section id="dashboard-analytics">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card bg-analytics text-white">
          <div class="card-content">
            <div class="card-body text-center">
              <img src="{{asset('assets/images/backgrounds/decore-left.png')}}" class="img-left" alt=" card-img-left">
              <img src="{{asset('assets/images/backgrounds/decore-right.png')}}" class="img-right" alt=" card-img-right">
                <div class="avatar avatar-xl bg-primary shadow mt-0">
                    <div class="avatar-content">
                        <i class="feather icon-heart font-large-1"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="mb-2 text-white">Welcome, {{Auth::user()->name}} </h1>
                </div>
              </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="card text-center">
            <div class="card-content">
                <div class="card-body">
                    <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                        <div class="avatar-content">
                            <i class="feather icon-user text-primary font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700">{{$total}}</h2>
                    <p class="mb-0 line-ellipsis">Total Penghuni</p>
                </div>
            </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="card text-center">
            <div class="card-content">
                <div class="card-body">
                    <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                        <div class="avatar-content">
                            <i class="feather icon-users text-danger font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700">{{$aktif}}</h2>
                    <p class="mb-0 line-ellipsis">Penghuni Aktif</p>
                </div>
            </div>
        </div>
      </div>

      <div class="col-xl-9 col-md-6 col-12">
        <div class="card card-statistics">
            <div class="card-header">
                <h4 class="card-title">Statistics</h4>
                <div class="d-flex align-items-center">
                    <p class="card-text font-small-2 mr-25 mb-0">Updated 1 minute ago</p>
                </div>
            </div>
            <div class="card-body statistics-body">
              <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                      <div class="media">
                          <div class="avatar bg-rgba-primary mr-2 p-50 m-0 mb-1">
                              <div class="avatar-content">
                                  <i class="feather icon-home" class="avatar-icon"></i>
                              </div>
                          </div>
                          <div class="media-body my-auto">
                              <h4 class="font-weight-bolder mb-0">{{$stok_kamar}}</h4>
                              <p class="card-text font-small-3 mb-1">Jumlah Kamar</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                      <div class="media">
                          <div class="avatar bg-rgba-info mr-2 p-50 m-0 mb-1">
                              <div class="avatar-content">
                                  <i class="feather icon-home" class="avatar-icon"></i>
                              </div>
                          </div>
                          <div class="media-body my-auto">
                              <h4 class="font-weight-bolder mb-0">{{$sisa_kamar}}</h4>
                              <p class="card-text font-small-3 mb-1">Kamar Kosong</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                      <div class="media">
                          <div class="avatar bg-rgba-success mr-2 p-50 m-0 mb-1">
                              <div class="avatar-content">
                                  <i class="feather icon-trending-up" class="avatar-icon"></i>
                              </div>
                          </div>
                          <div class="media-body my-auto">
                              <h4 class="font-weight-bolder mb-0">{{($stok_kamar - $sisa_kamar)}}</h4>
                              <p class="card-text font-small-3 mb-1">Kamar Aktif</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                      <div class="media">
                          <div class="avatar bg-rgba-danger mr-2 p-50 m-0 mb-1">
                              <div class="avatar-content">
                                  <i class="feather icon-heart" class="avatar-icon"></i>
                              </div>
                          </div>
                          <div class="media-body my-auto">
                              <h4 class="font-weight-bolder mb-0"> {{$favorite}} </h4>
                              <p class="card-text font-small-3 mb-1">Favorite</p>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
      </div>

      <div class="col-lg-3 col-12">
        <div class="row match-height">
            <div class="col-lg-12 col-md-3 col-6">
                <div class="card">
                    <div class="card-body pb-50">
                        <h6>Rating Rata-rata</h6>
                        <h2 class="font-weight-bolder mb-1">
                          <div class="read-only-ratings" data-rateyo-read-only="true"></div>
                        </h2>
                        <p style="font-size: 13px; color:lightcoral">Ratings: 7</p>
                    </div>
                </div>
            </div>
        </div>
      </div>

    </div>
  </section>


@endsection
