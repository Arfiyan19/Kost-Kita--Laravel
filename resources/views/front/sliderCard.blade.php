<section id="component-swiper-centered-slides">
    <div class="card bg-transparent">
        <div class="card-header">
            <h4 style="color:black">Kos Promo Bulan ini</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="swiper-centered-slides swiper-container p-1">
                    <div class="swiper-wrapper">
                      @foreach ($promo as $promos)
                        <div class="swiper-slide rounded swiper-shadow">
                          <a href="{{url('room', $promos->kamar->slug)}}">
                            <i class="feather icon-percent font-large-1"></i>
                            <div class="swiper-text pt-md-1 pt-sm-50">{{$promos->kamar->nama_kamar}}</div>
                            <span class="pt-md-1 pt-sm-50 mr-1" style="font-size: 10px; color: rgb(96, 93, 93);text-decoration: line-through">{{rupiah($promos->kamar->harga_kamar)}}</span> <br>
                            <span class="pt-md-1 pt-sm-50 mr-1" style="font-size: 10px; color:black">{{rupiah($promos->harga_promo)}} / Bulan</span>
                          </a>
                        </div>
                      @endforeach
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>