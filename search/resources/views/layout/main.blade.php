<?php
use \Illuminate\Support\Facades\DB;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title','Gotto Online Job Portal')</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/profile/assets/css/bootstrap.min.css">

    <link href="<?=asset('assets/css/bootstrap.min.css')?>" rel="stylesheet">

    <link href="<?=asset('assets/css/bootstrap-icons.css')?>" rel="stylesheet">

    <link href="<?=asset('assets/css/owl.carousel.min.css')?>" rel="stylesheet">

    <link href="<?=asset('assets/css/owl.theme.default.min.css')?>" rel="stylesheet">

    <link href="<?=asset('assets/css/tooplate-gotto-job.css')?>" rel="stylesheet">

</head>

<body class="<?php
            if (Request::is('about')){
                echo 'about-page';
            }elseif (Request::is('list')){
                echo 'job-listings-page';
            }
            ?>" id="top">
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{route('home')}}">
            <img src="../assets/image/logo.png" class="img-fluid logo-image">

            <div class="d-flex flex-column">
                <strong class="logo-text">Gotto</strong>
                <small class="logo-slogan">Online Job Portal</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center ms-lg-5">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : ''}}" href="{{route('home')}}">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : ''}}" href="{{route('about')}}">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('list') ? 'active' : ''}}" href="{{route('list')}}">Job List</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact') ? 'active' : ''}}" href="{{route('contact')}}">Contact</a>
                </li>
                @auth
                    @php
                        $user_id = auth()->user()->id;
                     //   var_dump($user_id);
                        $isCreateUser = DB::table('user_profile')->where('user_id',$user_id)->first();
                     //   var_dump($isCreateUser->user_id)
                    @endphp
                    <div class="btn-group m-auto">
                        @if($isCreateUser && $isCreateUser->image)
                            <img src="/storage/{{$isCreateUser->image}}" style="margin-top:4px;border-radius: 50%;height: 30px;width: 30px;"  alt="">
                        @else
                            <img src="/storage/{{auth()->user()->avatar}}" style="margin-top:4px;border-radius: 50%;height: 30px;width: 30px;"  alt="">
                        @endif
                           <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" style="margin-left: 10px;" data-bs-toggle="dropdown" aria-expanded="false">Profile</button>
                        <ul class="dropdown-menu mt-3 p-3" aria-labelledby="dropdownMenuButton">
                            <li class="d-flex dropdown-item">
                                @if($isCreateUser && $isCreateUser->image)
                                    <img src="/storage/{{$isCreateUser->image}}" style="border-radius: 50%;float: left;height: 60px;margin-right: 10px;width: 60px;" alt="">
                                @else
                                    <img src="/storage/{{auth()->user()->avatar}}" style="border-radius: 50%;float: left;height: 60px;margin-right: 10px;width: 60px;" alt="">
                                @endif
                                <div>
                                    <h6>
                                        {{auth()->user()->name}}
                                    </h6>

                                    <span>
                                        {{auth()->user()->email}}
                                    </span>
                                </div>
                            </li>

                            <li class="dropdown-item">
                                <a  href="{{route('user_profile')}}" style="color: black">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" style="color: #2d2def;" href="{{route('logout')}}">
                                    Logout({{auth()->user()->name}})
                                </a>
                            </li>
                        </ul>
                    </div>


{{--                    <li class="nav-item ms-lg-auto">--}}
{{--                        <a class="nav-link custom-btn btn" href="{{route('logout')}}">Logout({{auth()->user()->name}})</a>--}}
{{--                    </li>--}}

                @else
                    <li class="nav-item ms-lg-auto">
                        <a class="nav-link" href="{{route('register')}}">Register</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link custom-btn btn" href="{{route('login')}}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{--index page html--}}

        @yield('content')

{{--end index page html--}}

<footer class="site-footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="d-flex align-items-center mb-4">
                    <img src="../assets/image/logo.png" class="img-fluid logo-image">

                    <div class="d-flex flex-column">
                        <strong class="logo-text">Gotto</strong>
                        <small class="logo-slogan">Online Job Portal</small>
                    </div>
                </div>

                <p class="mb-2">
                    <i class="custom-icon bi-globe me-1"></i>

                    <a href="#" class="site-footer-link">
                        www.jobbportal.com
                    </a>
                </p>

                <p class="mb-2">
                    <i class="custom-icon bi-telephone me-1"></i>

                    <a href="tel: 305-240-9671" class="site-footer-link">
                        305-240-9671
                    </a>
                </p>

                <p>
                    <i class="custom-icon bi-envelope me-1"></i>

                    <a href="mailto:info@yourgmail.com" class="site-footer-link">
                        info@jobportal.co
                    </a>
                </p>

            </div>

            <div class="col-lg-2 col-md-3 col-6 ms-lg-auto">
                <h6 class="site-footer-title">Company</h6>

                <ul class="footer-menu">
                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">About</a></li>

                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Blog</a></li>

                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Jobs</a></li>

                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="site-footer-title">Resources</h6>

                <ul class="footer-menu">
                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Guide</a></li>

                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">How it works</a></li>

                    <li class="footer-menu-item"><a href="#" class="footer-menu-link">Salary Tool</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-8 col-12 mt-3 mt-lg-0">
                <h6 class="site-footer-title">Newsletter</h6>

                <form class="custom-form newsletter-form" action="#" method="post" role="form">
                    <h6 class="site-footer-title">Get notified jobs news</h6>

                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="bi-person"></i></span>

                        <input type="text" name="newsletter-name" id="newsletter-name" class="form-control" placeholder="yourname@gmail.com" required>

                        <button type="submit" class="form-control">
                            <i class="bi-send"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="site-footer-bottom">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-12 d-flex align-items-center">
                    <p class="copyright-text">Copyright © Gotto Job 2048</p>

                    <ul class="footer-menu d-flex">
                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy Policy</a></li>

                        <li class="footer-menu-item"><a href="#" class="footer-menu-link">Terms</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-12 mt-2 mt-lg-0">
                    <ul class="social-icon">
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-twitter"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-facebook"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-linkedin"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-instagram"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-youtube"></a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-12 mt-2 d-flex align-items-center mt-lg-0">
                    <p>Design: <a class="sponsored-link" rel="sponsored" href="https://www.tooplate.com" target="_blank">Tooplate</a></p>
                </div>

                <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>

            </div>
        </div>
    </div>
</footer>

<!-- JAVASCRIPT FILES -->
<script src="<?=asset('assets/js/jquery.min.js')?>"></script>
<script src="../assets/profile/assets/js/bootstrap.min.js"></script>
<script src="<?=asset('assets/js/bootstrap.min.js')?>"></script>
<script src="<?=asset('assets/js/owl.carousel.min.js')?>"></script>
<script src="<?=asset('assets/js/counter.js')?>"></script>
<script src="<?=asset('assets/js/custom.js')?>"></script>

</body>
</html>
