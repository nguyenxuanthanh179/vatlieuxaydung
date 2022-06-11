<!doctype html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/backend/assets/css/style.css">
</head>

<body class="img js-fullheight" style="background-image: url('/backend/assets/image/bg.jpg');">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center new-login">Đăng nhập</h3>
                    <form role="form" action="{{route('admin.postLogin')}}" method="post" class="signin-form">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email"  class="form-control" placeholder="Email" >
                            @if ( $errors->has('email') )
                                <span style="color:red;">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password-field" name="password"  type="password" class="form-control" placeholder="Mật khẩu">
                            <span toggle="#password-field"
                                  class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            @if ( $errors->has('password') )
                                <span style="color:red;">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        @if(session('msg'))
                            <div class="form-group">
                                <span style="color: #a1341a; font-weight: 600"><i class="fa fa-exclamation-triangle" ></i>{{ session('msg') }}</span>
                            </div>
                        @endif
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <div class="checkmark">
                                    <input type="checkbox" id="">
                                    <label for="">Ghi nhớ</label>
                                </div>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="#" style="color: #fff">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Đăng nhập</button>
                        </div>

                    </form>
{{--                    <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>--}}
{{--                    <div class="social d-flex text-center">--}}
{{--                        <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span>--}}
{{--                            Facebook</a>--}}
{{--                        <a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span>--}}
{{--                            Google</a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="/backend/assets/js/main.js"></script>

</body>
</html>
