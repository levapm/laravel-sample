<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Premium Bootstrap Admin Dashboard Template</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/ionicons/css/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/typicons/src/font/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css')}}" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/pagination/pagination.css')}}">
    <link rel="stylesheet" href="{{asset('assets/toastr/build/toastr.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/css/shared/style.css')}}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/demo_1/style.css')}}">
    <!-- End Layout styles -->
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="#">
            <img src="{{asset('assets/images/logo.svg')}}" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="#">
            <img src="{{asset('assets/images/logo-mini.svg')}}" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +050 2992 709</li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-shopping-cart"></i>
                <span class="count">7</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 font-weight-medium float-left"> 7 orders are pendding </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-send"></i>
                <span class="count bg-success">5</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 font-weight-medium float-left"> 5 orders are finished </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  </div>
                </a>
              </div>
            </li> -->
            <li class="nav-item">
              @if(Auth::check())
              <a href="{{url('/logout')}}">Log out</a>
              @else
              <a href="{{url('/login')}}">Login</a>
              @endif
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              @if(Auth::check())
                <p class="profile-name"><i class="fa fa-user-circle-o"></i>&nbsp;{{Auth::user()->name}}</p>
              @else
              <p class="profile-name"><i class="fa fa-user-circle-o"></i>&nbsp;Guest</p>
              @endif
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/dashboard')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">DASHBOARD</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/assign_order')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">ASSIGN ORDER</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/orders')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">ORDERS</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/pickers')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">PICKING PERSONNEL</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/users')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">USER MANAGEMENT</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          @if(Session::has('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          @if(Session::has('error'))
          <div class="alert alert-warning">
            {{ session('error') }}
          </div>
          @endif
          @yield('main-panel')
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
              </span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('assets/vendors/js/vendor.bundle.addons.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{asset('assets/js/shared/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/shared/misc.js')}}"></script>
    <script src="{{asset('assets/pagination/pagination.js')}}"></script>
    <script src="{{asset('assets/toastr/build/toastr.min.js')}}"></script>
    <script src="{{asset('assets/validation/jquery.validate.min.js')}}"></script>
    <script>
      var update_interval = {{Session::get('update_interval')}};
      var timer = setInterval(sendRequest, 1000 * 60 * update_interval);
      var update_time = "####-##-## ##:##:##";
      sendRequest();
      function sendRequest() {
        $.post("{{url('/fetchdata')}}", {_token: "{{csrf_token()}}"})
          .done(function(){
            toastr.success("Data updated from ERP System");
            var now = new Date();
            update_time = now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + now.getDate() + " " + now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
            //document.location = document.location;
          })
          .fail(function(){
            toastr.error("Connection Failed!")
          });

      }
    </script>
    @yield('script')
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
  </body>
</html>