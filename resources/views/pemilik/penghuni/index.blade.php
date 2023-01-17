@extends('layouts.backend.app')
@section('title','Penghuni Kamar')
@section('content')
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
        <div class="card">
          <div class="card-header">
              <h4 class="card-title">Data Penghuni Kamar
              </h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <div class="table-responsive">
                <table class="table zero-configuration">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th class="text-nowrap">Nama Penghuni</th>
                      <th class="text-nowrap">Type Kamar</th>
                      <th class="text-nowrap">Jenis Kamar</th>
                      <th class="text-nowrap">Lama Sewa</th>
                      <th class="text-nowrap">Register Date</th>
                      <th class="text-nowrap">End Date</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php
                        $no = 1;
                      @endphp
                      @foreach ($penghuni as $item)
                        <tr>
                          <td>{{$no}}</td>
                          <td>{{getNameUser($item->user_id)}}</td>
                          <td>{{$item->kamar->kategori}}</td>
                          <td>{{$item->kamar->jenis_kamar}}</td>
                          <td>{{$item->lama_sewa}} Bulan</td>
                          <td>{{Carbon\Carbon::parse($item->tgl_sewa)->format('d-F-Y')}}</td>
                          <td>
                            {{Carbon\Carbon::parse($item->end_date_sewa)->format('d-F-Y')}}
                          </td>
                        </tr>
                      @php
                        $no++;
                      @endphp
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
@endsection