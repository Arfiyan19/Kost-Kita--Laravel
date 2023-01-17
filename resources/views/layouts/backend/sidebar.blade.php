@if(Auth::user()->role == 'Admin')
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{url('/home')}}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Kost Kita</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Dashboard --}}
            <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                <a href="/home"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>

            {{-- Kamar --}}
            <li class="nav-item {{ Request::is('admin/admin-kamar*') ? 'has-sub sidebar-group-active open' : ''}}">
                <a href="#"><i class="feather icon-square"></i><span class="menu-title" data-i18n="Campaign">Kamar</span></a>
                <ul class="menu-content">
                    <li class="{{Request::is('admin/admin-kamar') ? 'active' : ''}}">
                        <a href="{{route('admin-kamar.index')}}"><i></i><span class="menu-item" data-i18n="Data Kamar">Data Kamar</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@elseif (auth::user()->role == 'Pemilik')
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{url('/home')}}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Kost Kita</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Dashboard --}}
            <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                <a href="/home"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            {{-- Kamar --}}
            <li class="nav-item {{ Request::is('pemilik/kamar*') ? 'has-sub sidebar-group-active open' : ''}}">
                <a href="#"><i class="feather icon-square"></i><span class="menu-title" data-i18n="Campaign">Kamar</span></a>
                <ul class="menu-content">
                    <li class="{{Request::is('pemilik/kamar') ? 'active' : ''}}">
                        <a href="{{route('kamar.index')}}"><i></i><span class="menu-item" data-i18n="Data Kamar">Data Kamar</span></a>
                    </li>
                    <li class="{{Request::is('pemilik/promo') ? 'active' : ''}}">
                        <a href="{{route('kamar.promo')}}"><i></i><span class="menu-item" data-i18n="Promo">Promo Kamar</span></a>
                    </li>
                    <li class="{{Request::is('pemilik/kamar/create') ? 'active' : ''}}">
                        <a href="{{route('kamar.create')}}"><i></i><span class="menu-item" data-i18n="Tambah">Tambah Kamar</span></a>
                    </li>
                </ul>
            </li>

            {{-- Booking / Sewa --}}
            <li class="nav-item {{ (request()->is('')) ? 'active' : '' }}">
                <a href="{{url('pemilik/booking-list')}}"><i class="feather icon-book"></i>
                    <span class="menu-title" data-i18n="Booking">Booking</span>
                    <span class="badge badge-light-info badge-pill ml-auto mr-1">{{countBook()}}</span>
                </a>
            </li>

            {{-- Penghuni --}}
            <li class="nav-item {{ (request()->is('')) ? 'active' : '' }}">
                <a href="/pemilik/penghuni"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Penghuni">Penghuni</span>
                </a>
            </li>


        </ul>
    </div>
</div>
@elseif(auth::user()->role == 'Pencari')
<div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal fixed-top navbar-dark navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{url('/home')}}">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">Pap!Kos</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                        <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item">
                    <a class="nav-link" href="/home">
                        <i class="feather icon-home"></i><span data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('user/myroom')}}"><i class="feather icon-square"></i><span>Kamar Saya</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="feather icon-square"></i><span>Pilih Kamar</span></a>
                </li>
            </ul>
        </div>
        <!-- /horizontal menu content-->
    </div>
</div>
@endif