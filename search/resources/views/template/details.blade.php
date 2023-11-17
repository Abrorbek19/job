<?php
use \Illuminate\Support\Facades\DB;
?>
@extends('layout.main')
@section('title','Gotto Job Details')
@section('content')
    <main>

        <header class="site-header">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12 text-center">
                        <h1 class="text-white">Job Details</h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Job Details</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </header>



        @if(session()->has('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="col-12">
                @foreach($errors->all() as $error)
                    <div class="container mt-3">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{$error}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <section class="job-section section-padding pb-0">
            <div class="container">
                <div class="row">
                    @php
                        $company = DB::table('company')->where('id',$vacancy->company_id)->first();

                        $job_status = DB::table('job_status')->where('id',$vacancy->job_type)->first();

                        $job_time = DB::table('job_time')->where('id',$vacancy->job_time_id)->first();

                        $vacancy_offer = DB::table('company_vacancy_offers')->where('company_vacancy_id',$vacancy->id)->pluck('offer_id');
                    //    var_dump($vacancy_offer);

                        $offer = DB::table('offer')->whereIn('id',$vacancy_offer)->get();

                        $offer_have = DB::table('offer')->whereIn('id',$vacancy_offer)->first();
                    //    var_dump($offer);
                        $vacancy_requirements = DB::table('company_vacancy_requirements')->where('company_vacancy_id',$vacancy->id)->pluck('requirement_id');

                        $requirements_have = DB::table('requirements')->whereIn('id',$vacancy_requirements)->first();

                        $requirements = DB::table('requirements')->whereIn('id',$vacancy_requirements)->get();

                     //   var_dump($offer);
                                $datetime1 = strtotime($vacancy->created_at);
                                $datetime2 = strtotime(date('Y-m-d H:i:s',time()));

                                // Vaqt farqini topish
                                $diff = $datetime2 - $datetime1;

                                // Soat, oy va yilni topish
                                $seconds = $diff;
                                $minutes = round($diff / 60);
                                $hours = round($diff / 3600);
                                $days = round($diff / 86400);
                                $weeks = round($diff / 604800);
                                $months = round($diff / 2419200);
                                $years = round($diff / 29030400);

                    @endphp
                    <div class="col-lg-8 col-12">
                        <h2 class="job-title mb-0">{{$vacancy->title}}</h2>

                        <div class="job-thumb job-thumb-detail">
                            <div class="d-flex flex-wrap align-items-center border-bottom pt-lg-3 pt-2 pb-3 mb-4">
                                <p class="job-location mb-0">
                                    <i class="custom-icon bi-geo-alt me-1"></i>
                                    {{$company->location}}
                                </p>

                                <p class="job-date mb-0">
                                    <i class="custom-icon bi-clock me-1"></i>
                                    @php
                                        if ($seconds < 60) {
                                            echo $seconds . " soniya avval";
                                        } elseif ($minutes < 60) {
                                            echo $minutes . " daqiqa avval";
                                        } elseif ($hours < 24) {
                                            echo $hours . " soat avval";
                                        } elseif ($days < 7) {
                                            echo $days . " kun avval";
                                        } elseif ($weeks < 4) {
                                            echo $weeks . " hafta avval";
                                        } elseif ($months < 12) {
                                            echo $months . " oy avval";
                                        } else {
                                            echo $years . " yil avval";
                                        }
                                    @endphp
                                </p>

                                <p class="job-price mb-0">
                                    <i class="custom-icon bi-cash me-1"></i>
                                    {{$vacancy->salary}}
                                </p>

                                <div class="d-flex">
                                    <p class="mb-0">
                                        <a href=""  class="badge text-decoration-none badge-level">{{$job_status->title}}</a>
                                    </p>

                                    <p class="mb-0">
                                        <a href="" class="badge text-decoration-none" >{{$job_time->title}}</a>
                                    </p>
                                </div>
                            </div>
                            @if($vacancy->description)
                            <h4 class="mt-4 mb-2">Job Description</h4>
                            <p>
                                {{$vacancy->description}}
                            </p>
                            @else
                                <h5>
                                    There is no description for this vacancy
                                </h5>
                            @endif

                            @if($offer_have)
                            <h5 class="mt-4 mb-3">The Role</h5>
                                @foreach($offer as $off)
                                    <p class="mb-1"><strong>{{$off->title}}</strong> {{$off->description}}</p>
                                @endforeach
                            @else
                                <br>
                                <h5>
                                    There is no offer for this role
                                </h5>
                            @endif

                            @if($requirements_have)
                            <h5 class="mt-4 mb-3">Requirements</h5>
                                <ul>
                                    @foreach($requirements as $require)
                                        <li>{{$require->title}}</li>
                                    @endforeach
                                </ul>
                            @else
                                <br>
                                <h5>
                                    There is no requirement for this role
                                </h5>
                            @endif


                            @php
                                $save_job = DB::table('save_job')->where(['user_id'=>auth()->user()->id,'vacancy_id'=>$vacancy->id])->first();
                            @endphp
                            <div class="d-flex justify-content-center flex-wrap mt-5 border-top pt-4">
                                <a href="#" class="custom-btn btn mt-2">Apply now</a>


                                @if(!$save_job)
                                    <form action="{{route('save_job.store')}}" method="POST">
                                        @csrf
                                        <button type="submit" class="custom-btn custom-border-btn btn mt-2 ms-lg-4 ms-3">Save this job</button>
                                        <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                        <input type="hidden" name="vacancy_id" value="{{$vacancy->id}}">
                                    </form>
                                @else
                                    <h5 class="ml-5 mt-3">Bu vakansiyani saqlagansiz!</h5>
                                @endif

                                <div class="job-detail-share d-flex align-items-center">
                                    <p class="mb-0 me-lg-4 me-3">Share:</p>

                                    <a href="#" class="bi-facebook"></a>

                                    <a href="#" class="bi-twitter mx-3"></a>

                                    <a href="#" class="bi-share"></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-12 mt-5 mt-lg-0">
                        <div class="job-thumb job-thumb-detail-box bg-white shadow-lg">
                            <div class="d-flex align-items-center">
                                <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mb-3">
                                    <img src="../storage/{{$company->logo}}" class="job-image me-3 img-fluid" alt="">

                                    <p class="mb-0">{{$company->name}}</p>
                                </div>

                                <a href="#" class="bi-bookmark ms-auto me-2"></a>

                                <a href="#" class="bi-heart"></a>
                            </div>
                            @if($company->description)
                            <h6 class="mt-3 mb-2">About the Company</h6>

                            <p>{{$company->description}}</p>
                            @else
                                <h6 class="mt-3 mb-2">There is no description for this company</h6>
                            @endif

                            <h6 class="mt-4 mb-3">Contact Information</h6>

                            <p class="mb-2">
                                <i class="custom-icon bi-globe me-1"></i>

                                <a href="#" class="site-footer-link">
                                    {{$company->web_site_link}}
                                </a>
                            </p>

                            <p class="mb-2">
                                <i class="custom-icon bi-telephone me-1"></i>

                                <a href="tel: {{$company->phone}}" class="site-footer-link">
                                    {{$company->phone}}
                                </a>
                            </p>

                            <p>
                                <i class="custom-icon bi-envelope me-1"></i>

                                <a href="mailto:{{$company->email}}" class="site-footer-link">
                                    {{$company->email}}
                                </a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="job-section section-padding">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-12 mb-lg-4">
                        <h3>Similar Jobs</h3>

                        <p><strong>Over 10k opening jobs</strong> Lorem Ipsum dolor sit amet, consectetur adipsicing kengan omeg kohm tokito adipcingi elit eismuod larehai</p>
                    </div>

                    <div class="col-lg-4 col-12 d-flex ms-auto mb-5 mb-lg-4">
                        <a href="job-listings.html" class="custom-btn custom-border-btn btn ms-lg-auto">Browse Job Listings</a>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="job-thumb job-thumb-box">
                            <div class="job-image-box-wrap">
                                <a href="job-details.html">
                                    <img src="../assets/image/jobs/it-professional-works-startup-project.jpg" class="job-image img-fluid" alt="">
                                </a>

                                <div class="job-image-box-wrap-info d-flex align-items-center">
                                    <p class="mb-0">
                                        <a href="job-listings.html" class="badge badge-level">Internship</a>
                                    </p>

                                    <p class="mb-0">
                                        <a href="job-listings.html" class="badge">Freelance</a>
                                    </p>
                                </div>
                            </div>

                            <div class="job-body">
                                <h4 class="job-title">
                                    <a href="job-details.html" class="job-title-link">Technical Lead</a>
                                </h4>

                                <div class="d-flex align-items-center">
                                    <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                        <img src="../assets/image/logos/salesforce.png" class="job-image me-3 img-fluid" alt="">

                                        <p class="mb-0">Salesforce</p>
                                    </div>

                                    <a href="#" class="bi-bookmark ms-auto me-2">
                                    </a>

                                    <a href="#" class="bi-heart">
                                    </a>
                                </div>

                                <div class="d-flex align-items-center">
                                    <p class="job-location">
                                        <i class="custom-icon bi-geo-alt me-1"></i>
                                        Kuala, Malaysia
                                    </p>

                                    <p class="job-date">
                                        <i class="custom-icon bi-clock me-1"></i>
                                        10 hours ago
                                    </p>
                                </div>

                                <div class="d-flex align-items-center border-top pt-3">
                                    <p class="job-price mb-0">
                                        <i class="custom-icon bi-cash me-1"></i>
                                        $50k
                                    </p>

                                    <a href="job-details.html" class="custom-btn btn ms-auto">Apply now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="job-thumb job-thumb-box">
                            <div class="job-image-box-wrap">
                                <a href="job-details.html">
                                    <img src="../assets/image/jobs/marketing-assistant.jpg" class="job-image img-fluid" alt="marketing assistant">
                                </a>

                                <div class="job-image-box-wrap-info d-flex align-items-center">
                                    <p class="mb-0">
                                        <a href="job-listings.html" class="badge badge-level">Senior</a>
                                    </p>

                                    <p class="mb-0">
                                        <a href="job-listings.html" class="badge">Part Time</a>
                                    </p>
                                </div>
                            </div>

                            <div class="job-body">
                                <h4 class="job-title">
                                    <a href="job-details.html" class="job-title-link">Marketing Assistant</a>
                                </h4>

                                <div class="d-flex align-items-center">
                                    <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                        <img src="../assets/image/logos/spotify.png" class="job-image me-3 img-fluid" alt="">

                                        <p class="mb-0">Spotify</p>
                                    </div>

                                    <a href="#" class="bi-bookmark ms-auto me-2">
                                    </a>

                                    <a href="#" class="bi-heart">
                                    </a>
                                </div>

                                <div class="d-flex align-items-center">
                                    <p class="job-location">
                                        <i class="custom-icon bi-geo-alt me-1"></i>
                                        California, USA
                                    </p>

                                    <p class="job-date">
                                        <i class="custom-icon bi-clock me-1"></i>
                                        8 days ago
                                    </p>
                                </div>

                                <div class="d-flex align-items-center border-top pt-3">
                                    <p class="job-price mb-0">
                                        <i class="custom-icon bi-cash me-1"></i>
                                        $20k
                                    </p>

                                    <a href="job-details.html" class="custom-btn btn ms-auto">Apply now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="job-thumb job-thumb-box">
                            <div class="job-image-box-wrap">
                                <a href="job-details.html">
                                    <img src="../assets/image/jobs/coding-man.jpg" class="job-image img-fluid" alt="">
                                </a>

                                <div class="job-image-box-wrap-info d-flex align-items-center">
                                    <p class="mb-0">
                                        <a href="job-listings.html" class="badge badge-level">Junior</a>
                                    </p>

                                    <p class="mb-0">
                                        <a href="job-listings.html" class="badge">Contract</a>
                                    </p>
                                </div>
                            </div>

                            <div class="job-body">
                                <h4 class="job-title">
                                    <a href="job-details.html" class="job-title-link">Programmer</a>
                                </h4>

                                <div class="d-flex align-items-center">
                                    <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                        <img src="../assets/image/logos/twitter.png" class="job-image me-3 img-fluid" alt="">

                                        <p class="mb-0">Twiter</p>
                                    </div>

                                    <a href="#" class="bi-bookmark ms-auto me-2">
                                    </a>

                                    <a href="#" class="bi-heart">
                                    </a>
                                </div>

                                <div class="d-flex align-items-center">
                                    <p class="job-location">
                                        <i class="custom-icon bi-geo-alt me-1"></i>
                                        California, USA
                                    </p>

                                    <p class="job-date">
                                        <i class="custom-icon bi-clock me-1"></i>
                                        23 hours ago
                                    </p>
                                </div>

                                <div class="d-flex align-items-center border-top pt-3">
                                    <p class="job-price mb-0">
                                        <i class="custom-icon bi-cash me-1"></i>
                                        $68k
                                    </p>

                                    <a href="job-details.html" class="custom-btn btn ms-auto">Apply now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="cta-section">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-10">
                        <h2 class="text-white mb-2">Over 10k opening jobs</h2>

                        <p class="text-white">Gotto Job is a free HTML CSS template for job hunting related websites. This layout is based on the famous Bootstrap 5 CSS framework. Thank you for visiting Tooplate website.</p>
                    </div>

                    <div class="col-lg-4 col-12 ms-auto">
                        <div class="custom-border-btn-wrap d-flex align-items-center mt-lg-4 mt-2">
                            <a href="#" class="custom-btn custom-border-btn btn me-4">Create an account</a>

                            <a href="#" class="custom-link">Post a job</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
