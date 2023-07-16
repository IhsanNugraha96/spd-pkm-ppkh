@php
  use App\Models\User;
  $user = Auth::user();
  $user = User::findById($user->id);
@endphp

<!DOCTYPE html>
<html lang="en">
@include('components.header')

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title">
                <img src="{{ asset('/images/logo.jpg') }}" alt="" style="width: 21%; border-radius: 50%;"> 
                <span>SPDPP-PPKH</span>
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                @if ($user->profil_image == 'users.png')
                  <img src="{{ asset('/images/peserta/'.$user->profil_image) }}" alt="profil-image" title="" class="img-circle profile_img">
                @else
                  <img src="{{ asset('/storage/images/peserta/'.$user->profil_image) }}" alt="profil-image" title="" class="img-circle profile_img">
                @endif
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ auth()->user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            @include('components.sidebar')
          </div>
        </div>

        <!-- Topbar -->
        @include('components.topbar')

        <!-- Main content -->
        @yield('content')

        <!-- footer content -->
        @include('components.footer')
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->    
    <script src="{{ url('assets/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ url('assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ url('assets/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ url('assets/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ url('assets/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ url('assets/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ url('assets/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ url('assets/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ url('assets/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ url('assets/Flot/jquery.flot.js') }}"></script>
    <script src="{{ url('assets/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ url('assets/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ url('assets/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ url('assets/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ url('assets/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ url('assets/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ url('assets/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ url('assets/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ url('assets/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ url('assets/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ url('assets/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ url('assets/moment/min/moment.min.js') }}"></script>
    <script src="{{ url('assets/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ url('build/js/custom.min.js') }}"></script>
    
    @stack('scripts')
  </body>
</html>
