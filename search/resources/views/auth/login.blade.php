@extends('layout.auth')
@section('login')

    <main>

        <header class="site-header">
            <div class="container">
                <div class="row justify-content-between">

                    <div class="col-lg-12 col-12 d-flex">
                        <a class="site-header-text d-flex justify-content-center align-items-center me-auto" href="{{url('/')}}">
                            <i class="bi-box"></i>

                            <span>
                                    Kool Form Pack
                            </span>
                        </a>

                        <ul class="social-icon d-flex justify-content-center align-items-center mx-auto">
                            <span class="text-white me-4 d-none d-lg-block">Stay connected</span>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-whatsapp"></a>
                            </li>
                        </ul>

                        <div>
                            <a href="#" class="custom-btn custom-border-btn btn" data-bs-toggle="modal" data-bs-target="#subscribeModal">Notify me
                                <i class="bi-arrow-right ms-2"></i>
                            </a>
                        </div>

                        <a class="bi-list offcanvas-icon" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu"></a>

                    </div>

                </div>
            </div>
        </header>


        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column justify-content-center align-items-center">
                <nav>
                    <ul>
                        <li>
                            <a class="active" href="login.html">Login Form</a>
                        </li>

                        <li>
                            <a href="register.html">Create an account</a>
                        </li>

                        <li>
                            <a href="password-reset.html">Password Reset</a>
                        </li>

                        <li>
                            <a href="404.html">404 Page</a>
                        </li>

                        <li>
                            <a href="contact.html">Contact Form</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="#" method="get" class="custom-form mt-lg-4 mt-2" role="form">
                            <h2 class="modal-title" id="subscribeModalLabel">Stay up to date</h2>

                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="your@email.com" required="">

                            <button type="submit" class="form-control">Notify</button>
                        </form>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <p>By signing up, you agree to our Privacy Notice</p>
                    </div>
                </div>
            </div>
        </div>


        <section class="hero-section d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="mt-5">
                    @if($errors->any())
                        <div class="col-12">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{$error}}
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                </div>
                <div class="row">

                    <div class="col-lg-5 col-12 mx-auto">
                        <form action="{{route('login.post')}}" class="custom-form login-form" role="form" method="post">
                            @csrf
                            <h2 class="hero-title text-center mb-4 pb-2">Login Form</h2>

                            <div class="form-floating mb-4 p-0">
                                <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address">

                                <label for="email">Email address</label>
                            </div>

                            <div class="form-floating p-0">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">

                                <label for="password">Password</label>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="remember_token" value="1" id="flexCheckDefault">

                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>

                            <div class="row justify-content-center align-items-center">
                                <div class="col-lg-5 col-12">
                                    <button type="submit" class="form-control">Login</button>
                                </div>

                                <div class="col-lg-5 col-12">
                                    <a href="{{url('register')}}" class="btn custom-btn custom-border-btn">Register</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <div class="video-wrap">
                <video autoplay="" loop="" muted="" class="custom-video" poster="">
                    <source src="../login/videos/video.mp4" type="video/mp4">

                    Your browser does not support the video tag.
                </video>
            </div>
        </section>
    </main>
@endsection
