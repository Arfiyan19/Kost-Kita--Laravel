<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item">
        <a class="navbar-brand" href="/">
          <div class="brand-logo"></div>
          <h2>Kost Kita</h2>
        </a>
      </li>
    </ul>
  </div>
  <div class="navbar-wrapper">
    <div class="navbar-container content">
      <div class="navbar-collapse" id="navbar-mobile">
        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
          <ul class="nav navbar-nav ">
            <li class="nav-item mobile-menu d-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
            <li class="mr-2 d-none d-xl-block">
              <a href="" style="color: black"><i class="feather icon-airplay" data-toggle="tooltip" data-placement="bottom" title="Download Aplikasi"></i> Download Aplikasi</a>
            </li>
            <li class="d-none d-xl-block">
              <a href="{{url('show-all-room')}}" style="color: black"><i class="feather icon-calendar" data-toggle="tooltip" data-placement="top" title="Booking Kamar"></i> Booking Kamar</a>
            </li>
          </ul>
        </div>
        <ul class="nav navbar-nav float-right">
          <li class="dropdown dropdown-notification nav-item">
            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-heart"></i>
              <span class="badge badge-pill badge-primary badge-up">
                @auth
                {{Auth::user()->simpanKamars != null ? Auth::user()->simpanKamars->count() : 0}}
                @else
                0
                @endauth
              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <div class="dropdown-header m-0 p-2">
                  <h3 class="white">
                    @auth
                    {{Auth::user()->simpanKamars != null ? Auth::user()->simpanKamars->count() : 0}}
                    @else
                    0
                    @endauth
                  </h3>
                  <span class="notification-title">Kos Favorite</span>
                </div>
              </li>
              @auth
              <li class="scrollable-container media-list">
                @foreach (Auth::user()->simpanKamars as $key => $favorite)
                <a class="d-flex justify-content-between" href="{{url('room',$favorite->kamar['slug'])}}">
                  <div class="media d-flex align-items-start">
                    <div class="media-left">{{$key+1}}</div>
                    <div class="media-body">
                      <h6 class="primary media-heading">{{$favorite->kamar['nama_kamar']}}</h6>
                      <small><time class="media-meta" datetime="2015-06-11T18:29:20+08:00">{{$favorite->kamar['created_at']}}</time></small>
                    </div>
                  </div>
                </a>
                @endforeach
              </li>
              <li class="dropdown-menu-footer {{Auth::user()->simpanKamar != null ? Auth::user()->simpanKamar->count() <= 1 ? 'hidden' : '' : ''}}">
                @if (Auth::user()->simpanKamar != null)
                <a class="dropdown-item p-1 text-center" href="{{url('show-all-room?cari='.Auth::id())}}">Lihat Semua</a>
                @else
                <a class="dropdown-item p-1 text-center" href="{{url('show-all-room')}}">Belum ada kamar favorite</a>
                @endif
              </li>
              @else
              <li class="dropdown-menu-footer">
                <a class="dropdown-item p-1 text-center" href="{{url('show-all-room')}}">Belum ada kamar favorite</a>
              </li>
              @endauth

            </ul>
          </li>

          <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">0</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <div class="dropdown-header m-0 p-2">
                  <h3 class="white">0</h3><span class="notification-title">Notifications</span>
                </div>
              </li>
              <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">Read all notifications</a></li>
            </ul>
          </li>

          @auth
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name text-bold-600">{{Auth::user()->name}}</span>
                <span class="user-status">{{Auth::user()->role}}</span>
              </div>
              <span>
                @if (Auth::user()->foto == NULL)
                <img class="round" src="{{asset('assets/images/profile/profile.jpg')}}" alt="avatar" height="40" width="40">
                @else
                <img class="round" src="{{ asset('storage/images/foto_profile/'. Auth::user()->foto) }}" alt="avatar" height="40" width="40">
                @endif
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{url('profile')}}"><i class="feather icon-user"></i>Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                <i class="feather icon-power"></i> Logout
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </a>
            </div>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link nav-link-label" href="{{route('login')}}">
              <i class="feather icon-log-in"></i> <span class=" mr-2">Masuk</span></a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </div>
</nav>