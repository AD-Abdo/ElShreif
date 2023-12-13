<!doctype html>
<html lang="en">

<!-- Mirrored from bootstrap.gallery/wafi-admin/dashboard-v2/topbar-rtl/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 03:08:07 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ URL::asset('assets/img/logo.png') }}" />

    <title>أكاديمية الشريف - تسجيل الدخول</title>


    <!-- *************
   ************ Common Css Files *************
  ************ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/fonts/style.css') }}">


    <!-- Master CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/main.css') }}" />
    <style>
        .effect {
            position: fixed;
            top:0;
            bottom:0;
            right:0;
            left:0;
            height: 100% !important;
            width: 100% !important;
            margin:0px auto;
            background: #2e323c;
            opacity: 85%;
        }

        * {
            font-family: 'cairo';
        }

    </style>

</head>

<body class="authentication">
    <div class="effect">
        <div id="particles-js"></div>
	<div class="countdown-bg"></div>

    </div>
    
    <!-- Container start -->
    <div class="container">

        <form action="{{ URL::route('login') }}" method="POST">
            @csrf
            @method('POST')
            <div class="row justify-content-md-center">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                    <div class="login-screen">
                        <div class="login-box">
                            <img src="{{ URL::asset('assets/img/logo.png') }}" class="w-100 text-center"
                                alt="أكاديمية الشريف التعليمية" />
                            @if ($errors->any())
                                @if ($errors->has('email'))
                                    <div class="row mt-2 mb-2">
                                        <div class="col-md-12 text-center bg-primary text-light pt-2 pb-2">

                                            <span class="">برجاء التحقق من المعلومات قبل تسجيل
                                                الدخول</span>

                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="form-group mt-3">
                                <input type="text" value="{{ old('email') }}" class="form-control"
                                    placeholder="البريد الالكتروني" required autocomplete="email" autofocus name="email"/>
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="كلمة المرور" />
                            </div>
                            <div class="actions mb-4 w-100 ml-0 mr-0">
                                <button type="submit" class="btn btn-primary w-100 ml-0 mr-0">تسجيل الدخول</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <!-- Container end -->
    <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
		<script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{ URL::asset('assets/js/moment.js')}}"></script>

		<!-- *************
			************ Vendor Js Files *************
		************* -->
		<!-- Particles JS -->		
		<script src="{{ URL::asset('assets/vendor/particles/particles.min.js')}}"></script>
		<script src="{{ URL::asset('assets/vendor/particles/particles-custom-error.js')}}"></script>

</body>

<!-- Mirrored from bootstrap.gallery/wafi-admin/dashboard-v2/topbar-rtl/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 May 2021 03:08:10 GMT -->

</html>
