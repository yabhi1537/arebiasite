<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pearl UI</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin_assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/vendors/iconfonts/puse-icons-feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-8 mx-auto">
            <div class="row">
              <div class="col-lg-6 bg-white">
                <div class="auth-form-light text-left p-5">
                  <h2>Login</h2>
                  <h4 class="font-weight-light">Admin Login Here</h4>

                  <form class="pt-5" method="POST" action="{{route('admin.login')}}">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Username">
                      <i class="mdi mdi-account"></i>
                    </div>
                    @error('email')
                    <label id="title-error" class="alert alert-danger" for="title" > {{ $message }}</label>
                    @enderror
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      <i class="mdi mdi-eye"></i>
                    </div>
                    @error('password')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    <div class="mt-5">
                      <!-- <a class="btn btn-block btn-success btn-lg font-weight-medium" href="../../index.html">Login</a> -->

                      <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium">Login</button>
                    </div>
                    <div class="mt-3 text-center">
                      <a href="" class="auth-link text-black">Forgot password?</a>

                      


                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-6 login-half-bg d-flex flex-row">
                <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('admin_assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin_assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('admin_assets/js/misc.js') }}"></script>
  <script src="{{ asset('admin_assets/js/settings.js') }}"></script>
  <script src="{{ asset('admin_assets/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>
