<style>
  .navbar-bottom {
    overflow: hidden;
    background-color: #333;
    position: fixed;
    bottom: 0;
    width: 100%;
  }

  .navbar-bottom a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }
</style>

  <nav class="navbar navbar-bottom navbar-dark bg-dark navbar-expand d-lg-none d-xl-none fixed-bottom">
    <ul class="navbar-nav nav-justified w-100">
      <li class="nav-item">
        <a href="/" class="nav-link text-white"><i class="feather icon-home"></i>Home</a></a>
      </li>
      <li class="nav-item">
        <a href="{{url('show-all-room')}}" class="nav-link text-white"><i class="feather icon-calendar"></i>Booking</a></a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link text-white"> <i class="feather icon-book"></i>Ketentuan</a>
      </li>
    </ul>
  </nav>
