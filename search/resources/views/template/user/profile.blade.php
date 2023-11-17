<?php
use \Illuminate\Support\Facades\DB;
?>
@extends('layout.profile')
@section('title','Profile')
@section('content')


<div class="container-fluid overcover">
        <a href="{{route('home')}}" type="button" class="btn btn-danger" style="margin-left: 40px;">
            <i class="fa-solid fa-backward"></i>
            Back
        </a>

   <div class="container">
       @if(session()->has('success'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>{{session('success')}}</strong>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
       @endif
           @if($errors->any())
               <div class="col-12">
                   @foreach($errors->all() as $error)
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <strong>{{$error}}</strong>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                   @endforeach
               </div>
           @endif
   </div>
    <div class="container profile-box">
        <div class="top-cover">
            <div class="covwe-inn">
                <div class="row no-margin">
                    @auth
                        @php
                            $user_id = auth()->user()->id;
                            $isCreateUser = DB::table('user_profile')->where('user_id',$user_id)->first();

                        @endphp
                        <div class="col-md-3 img-c">
                            @if($isCreateUser && $isCreateUser->image)
                                <img src="../storage/{{$isCreateUser->image}}" style="height: 250px;" alt="">
                            @else
                                <img src="storage/{{auth()->user()->avatar}}" alt="">
                            @endif
                        </div>
                        <div class="col-md-9 tit-det">
                            <h2>{{auth()->user()->name}} / @if($isCreateUser && $isCreateUser->job){{$isCreateUser->job}}@else Your Job! @endif</h2>
                            <p>
                                @if($isCreateUser && $isCreateUser->about_yourself){{$isCreateUser->about_yourself}}@else About Yourself! @endif
                            </p>
                        </div>
                    @if(!$isCreateUser)
                            <div class="col-10">
                                <p style="margin-left: 50px; color: white">@if($isCreateUser && $isCreateUser->country){{$isCreateUser->country}}@else Your Country! @endif</p>
                                <p style="margin-left: 50px;color: white">@if($isCreateUser && $isCreateUser->birth_date){{$isCreateUser->birth_date}}@else Your Birthday! @endif</p>
                            </div>
                        <div class="col-2">
                            <a href="{{url('create_user_profile/create')}}" class="btn btn-success" style="margin-left: auto">
                                <i class="fa-solid fa-circle-plus"></i>
                                Create
                            </a>
                        </div>
                    @else
                       <div class="col-11">
                           <p style="margin-left: 50px; color: white">@if($isCreateUser && $isCreateUser->country){{$isCreateUser->country}}@else Your Country! @endif</p>
                           <p style="margin-left: 50px;color: white">@if($isCreateUser && $isCreateUser->birth_date){{$isCreateUser->birth_date}}@else Your Birthday! @endif</p>
                       </div>
                       <div class="col-1">
                           <a href="{{url('create_user_profile/'.$isCreateUser->id .'/edit')}}" class="btn btn-primary" style="margin-left: auto">
                               <i class="fa-solid fa-pen-to-square"></i>
                               Edit
                           </a>
                       </div>
                    @endif
                    @elseauth
                    <div class="col-md-3 img-c">
                        <img src="assets/profile/assets/images/profile.jpg" alt="">
                    </div>
                    <div class="col-md-9 tit-det">
                        <h2>Your name / Your position</h2>
                        <p>
                            About yourself
                        </p>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="resume-tab" data-toggle="tab" href="#resume" role="tab" aria-controls="resume" aria-selected="false">Resume</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">Portfolio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="saved-tab" data-toggle="tab" href="#saved" role="tab" aria-controls="saved" aria-selected="false">Saved</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row no-margin home-det">
                    <div class="col-md-4 big-img">

                        <h4 class="ltitle">Hobbies</h4>
                        <ul class="hoby row no-margin">
                            <li><i class="fas fa-pencil-alt"></i> <br> Writing</li>
                            <li><i class="fas fa-bicycle"></i> <br> Cycling</li>
                            <li><i class="fas fa-futbol"></i> <br> Football</li>
                            <li><i class="fas fa-film"></i><br> Movies</li>
                            <li><i class="fas fa-plane-departure"></i> <br>Travel</li>
                            <li><i class="fas fa-gamepad"></i> <br> Games</li>
                        </ul>
                        <h4 class="ltitle">Referencess</h4>

                        @if($isCreateUser &&($isCreateUser->job || $isCreateUser->phone))
                                <div class="refer-cov">
                                    <p><b>{{auth()->user()->name}}:</b> {{$isCreateUser->job}}</p>
                                    <span><b>Phone </b>: {{$isCreateUser->phone}}</span>
                                </div>
                        @else
                                <div class="refer-cov">
                                    <p><b>{{auth()->user()->name}} :</b> Job Postion</p>
                                    <span>Phone : Your phone</span>
                                </div>
                        @endif
                    </div>
                    <div class="col-md-8 home-dat">

                        <div class="row">
                            <div class="col-10">
                                <h2 class="rit-titl"> Skills</h2>
                            </div>
                            <div class="col-2">
{{--                                <a href="{{url('create_user_profile/'.$isCreateUser->id .'/edit')}}" class="btn btn-success" style="margin-left: auto">Create</a>--}}
                                <a type="button" class="btn btn-success" style="color: white" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa-solid fa-circle-plus"></i>
                                    Create
                                </a>
                            </div>



                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Created your skills</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('create_user_skills.store')}}" method="POST">
                                                @csrf
{{--                                                @method('PUT')--}}
                                                <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                                <div class="mb-3">
                                                    <label for="skills_name1" class="form-label">Skills name</label>
                                                    <input type="text" name="skills" class="form-control" id="skills_name1" aria-describedby="skills_name">
                                                    @error('skills')
                                                    <div id="skills_name" style="color: red" class="form-text">You are must be write skill!</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="range_of_skills1" class="form-label">Range of skills</label>
                                                    <input type="range" value="0" class="form-control" name="range" id="range_of_skills1" min="0" max="100" oninput="this.nextElementSibling.value = this.value">
                                                    <output>0</output>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa-solid fa-circle-plus"></i>
                                                        Create Skills
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @php

                        $user_skills_id = DB::table('skills')->where('user_id',$user_id)->get();
                        $user_skills_have = DB::table('skills')->where('user_id',$user_id)->first();
                    //    var_dump($user_skills_id)
                        @endphp
                        <div class="profess-cover row no-margin">
                            @if($user_skills_have)
                                @foreach($user_skills_id as $skills)
                                    @if($skills->user_id)
                                        <div class="col-md-12">
                                            <div class="prog-row row align-items-center">
                                                <div class="col-sm-5">
                                                    {{$skills->title}}
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: {{$skills->range}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4" style="display: flex;justify-content: space-evenly;">
                                                    <a type="button" class="btn btn-primary" style="color: white" data-toggle="modal" data-target="#exampleModal{{$skills->id}}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        Edit
                                                    </a>
                                                    <a type="button" class="btn btn-danger" style="color: white" data-toggle="modal" data-target="#exampleModal{{$skills->id}}delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="modal fade" id="exampleModal{{$skills->id}}delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete your {{$skills->title}} skills</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{url('create_user_skills/'.$skills->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                            <h1>Are you sure?</h1>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fa-solid fa-trash"></i>
                                                                Delete Skills
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="exampleModal{{$skills->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update your {{$skills->title}} skills</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{url('create_user_skills/'.$skills->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                                        <div class="mb-3">
                                                            <label for="skills_name1" class="form-label">Skills name</label>
                                                            <input type="text" value="{{$skills->title}}" name="skills" class="form-control" id="skills_name1" aria-describedby="skills_name">
                                                            @error('skills')
                                                            <div id="skills_name" style="color: red" class="form-text">You are must be write skill!</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="range_of_skills1" class="form-label">Range of skills</label>
                                                            <input type="range" class="form-control" value="{{$skills->range}}" name="range" id="range_of_skills1" min="0" max="100" oninput="this.nextElementSibling.value = this.value">
                                                            <output>{{$skills->range}}</output>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                Update Skills
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <h5 style="text-align: center">
                                            Sizga tegishli ma'lumot yo'q
                                        </h5>
                                    @endif
                                @endforeach
                            @else
                                <h5 style="text-align: center">Hozircha sizni qanday qobiliyat egasi ekanligingizni bilmaymiz, bemalol kiritsangiz bo'ladi</h5>
                            @endif
                        </div>

                        <div class="links">
                            <div class="row ">
                                <div class="col-xl-6 col-md-12">
                                    <ul class="btn-link">
                                        <li>
                                            <a href=""><i class="fas fa-paper-plane"></i> Hire Me</a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fas fa-cloud-download-alt"></i> Download Resume</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <ul class="social-link">
                                        <li><i class="fab fa-facebook-f"></i></li>
                                        <li><i class="fab fa-twitter"></i></li>
                                        <li><i class="fab fa-pinterest-p"></i></li>
                                        <li><i class="fab fa-linkedin-in"></i></li>
                                        <li><i class="fab fa-linkedin-in"></i></li>
                                        <li><i class="fab fa-youtube"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="jumbo-address">
                            <div class="row no-margin">
                                <div class="col-lg-6 no-padding">

                                    <table class="addrss-list">
                                        <tbody>
                                        <tr>
                                            <th>Position</th>
                                            <td>@if($isCreateUser && $isCreateUser->job){{$isCreateUser->job}} @else Your job status @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <td>@if($isCreateUser && $isCreateUser->country){{$isCreateUser->country}} @else Your Country @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Date of birth</th>
                                            <td>@if($isCreateUser && $isCreateUser->birth_date){{$isCreateUser->birth_date}} @else Your Birthday @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-lg-6 no-padding">
                                    <table class="addrss-list">
                                        <tbody>
                                        <tr>
                                            <th>Experiance</th>
                                            <td>@if($isCreateUser && $isCreateUser->experiance){{$isCreateUser->experiance}}+ Years @else Your Experiance status @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Website</th>
                                            <td>@if($isCreateUser && $isCreateUser->website)<a href="https://{{$isCreateUser->website}}">{{$isCreateUser->website}}</a> @else Your website link @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Languages</th>
                                            <td>@if($isCreateUser && $isCreateUser->languages) {{$isCreateUser->languages}} @else You know Languages!@endif</td>
                                        </tr>
                                        </tbody></table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade exp-cover" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="data-box">
                    <div class="sec-title row">
                        <h2 class="col-sm-10">My Profile</h2>
                        <div class="col-sm-2">
                            <a type="button" class="btn btn-success" style="color: white" data-toggle="modal" data-target="#profileModal">
                                <i class="fa-solid fa-circle-plus"></i>
                                Create
                            </a>
                        </div>
                    </div>
                    @php

                        $work_job_id = DB::table('work_job')->where('user_id',$user_id)->get();
                        $work_job_have = DB::table('work_job')->where('user_id',$user_id)->first();
                    //    var_dump($user_skills_id)
                    @endphp
                    @if($work_job_have)
                        @foreach($work_job_id as $work)
                            @if($work->user_id)
                            <div class="row exp-row" style="align-items: center">
                                <div class="col-sm-9">
                                    <h6>{{$work->job_status}}</h6>
                                    <span>{{$work->company_name}}</span>
                                    <i>{{date('M Y', strtotime($work->enter_work_date))}} - {{date('M Y', strtotime($work->end_work_date))}}</i>

                                    <p>{{$work->work_description}}</p>
                                </div>
                                <div class="col-sm-3">
                                    <a type="button" class="btn btn-primary" style="color: white" data-toggle="modal" data-target="#profileUpdate{{$work->id}}Modal">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Update
                                    </a>
                                    <a type="button" class="btn btn-danger" style="color: white" data-toggle="modal" data-target="#profileDelete{{$work->id}}Modal">
                                        <i class="fa-solid fa-trash"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>

                                <div class="modal fade" id="profileUpdate{{$work->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('user_create_work/'. $work->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                                    <div class="mb-3">
                                                        <label for="job_status" class="form-label">Job name</label>
                                                        <input type="text" name="job_status" value="{{$work->job_status}}" class="form-control" id="job_status" aria-describedby="job_status">
                                                        @error('job_status')
                                                        <div id="job_status" style="color: red" class="form-text">You are must be written job name!</div>
                                                        @enderror

                                                        <label for="company_name" class="form-label">Company Name</label>
                                                        <input type="text" name="company_name" value="{{$work->company_name}}" class="form-control" id="company_name" aria-describedby="company_name">
                                                        @error('company_name')
                                                        <div id="company_name" style="color: red" class="form-text">You  must be written company name!</div>
                                                        @enderror

                                                        <label for="enter_work_date" class="form-label">Enter Work Date</label>
                                                        <input type="date" name="enter_work_date" value="{{$work->enter_work_date}}" class="form-control" id="enter_work_date" aria-describedby="enter_work_date">
                                                        @error('enter_work_date')
                                                        <div id="enter_work_date" style="color: red" class="form-text">You are must be written enter work date!</div>
                                                        @enderror

                                                        <label for="end_work_date" class="form-label">End Work Date</label>
                                                        <input type="date" name="end_work_date" value="{{$work->end_work_date}}" class="form-control" id="end_work_date" aria-describedby="end_work_date">
                                                        @error('end_work_date')
                                                        <div id="end_work_date" style="color: red" class="form-text">You are must be written end work date!</div>
                                                        @enderror

                                                        <label for="work_description" class="form-label">Work Description</label>
                                                        <textarea name="work_description"  class="form-control" aria-describedby="work_description" id="work_description" cols="30" rows="10">{{$work->work_description}}</textarea>
                                                        @error('work_description')
                                                        <div id="work_description" style="color: red" class="form-text">You are must be written work description!</div>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="profileDelete{{$work->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete your {{$work->job_status}} job!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('user_create_work/'. $work->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <h1>Are you sure?</h1>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                            Delete Skills
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @else
                                <h5 style="text-align: center">Sizga tegishli ma'lumot yo'q!</h5>
                            @endif
                        @endforeach
                    @else
                        <h5 style="text-align: center">Hozircha sizda qayerlarda ishlaganiz haqida ma'lumot yo'q, bemalol kiritsangiz bo'ladi!</h5>
                    @endif
            </div>

            <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('user_create_work.store')}}" method="POST">
                                @csrf
{{--                                @method('PUT')--}}
                                <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                <div class="mb-3">
                                    <label for="job_status" class="form-label">Job name</label>
                                    <input type="text" name="job_status" class="form-control" id="job_status" aria-describedby="job_status">
                                    @error('job_status')
                                    <div id="job_status" style="color: red" class="form-text">You are must be write job name!</div>
                                    @enderror

                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" id="company_name" aria-describedby="company_name">
                                    @error('company_name')
                                    <div id="company_name" style="color: red" class="form-text">You are must be write comapny name!</div>
                                    @enderror

                                    <label for="enter_work_date" class="form-label">Enter Work Date</label>
                                    <input type="date" name="enter_work_date" class="form-control" id="enter_work_date" aria-describedby="enter_work_date">
                                    @error('enter_work_date')
                                    <div id="enter_work_date" style="color: red" class="form-text">You are must be write enter work date!</div>
                                    @enderror

                                    <label for="end_work_date" class="form-label">End Work Date</label>
                                    <input type="date" name="end_work_date" class="form-control" id="end_work_date" aria-describedby="end_work_date">
                                    @error('end_work_date')
                                    <div id="end_work_date" style="color: red" class="form-text">You are must be write end work date!</div>
                                    @enderror

                                    <label for="work_description" class="form-label">Work Description</label>
                                    <textarea name="work_description" class="form-control" aria-describedby="work_description" id="work_description" cols="30" rows="10"></textarea>
                                    @error('work_description')
                                    <div id="work_description" style="color: red" class="form-text">You are must be write work description!</div>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-circle-plus"></i>
                                        Create
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

            <div class="tab-pane fade exp-cover" id="resume" role="tabpanel" aria-labelledby="resume-tab">
                <div class="sec-title row">
                    <h2 class="col-sm-10">Education Details</h2>
                    <div class="col-sm-2">
                        <a type="button" class="btn btn-success" style="color: white" data-toggle="modal" data-target="#resumeModal">
                            <i class="fa-solid fa-circle-plus"></i>
                            Create
                        </a>
                    </div>
                </div>

                <div class="modal fade" id="resumeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create University</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('user_create_education.store')}}" method="POST">
                                    @csrf
                                    {{--                                @method('PUT')--}}
                                    <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                    <div class="mb-3">
                                        <label for="university_name" class="form-label">University name</label>
                                        <input type="text" name="university_name" class="form-control" id="university_name" aria-describedby="university_name">
                                        @error('university_name')
                                        <div id="job_status" style="color: red" class="form-text">You are must be write university name!</div>
                                        @enderror

                                        <label for="education_type" class="form-label">Education Type</label>
                                        <input type="text" name="education_type" class="form-control" id="education_type" aria-describedby="education_type">
                                        @error('education_type')
                                        <div id="company_name" style="color: red" class="form-text">You are must be write education type!</div>
                                        @enderror

                                        <label for="enter_education" class="form-label">Enter Education Date</label>
                                        <input type="date" name="enter_education" class="form-control" id="enter_education" aria-describedby="enter_education">
                                        @error('enter_education')
                                        <div id="enter_work_date" style="color: red" class="form-text">You are must be write enter education date!</div>
                                        @enderror

                                        <label for="end_education" class="form-label">End Education Date</label>
                                        <input type="date" name="end_education" class="form-control" id="end_education" aria-describedby="end_education">
                                        @error('end_education')
                                        <div id="end_work_date" style="color: red" class="form-text">You are must be write end education date!</div>
                                        @enderror

                                        <label for="university_description" class="form-label">University Description</label>
                                        <textarea name="university_description" class="form-control" aria-describedby="university_description" id="university_description" cols="30" rows="10"></textarea>
                                        @error('university_description')
                                        <div id="work_description" style="color: red" class="form-text">You are must be write university description!</div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa-solid fa-circle-plus"></i>
                                            Create
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @php

                    $education_id = DB::table('education')->where('user_id',$user_id)->get();
                    $education_have = DB::table('education')->where('user_id',$user_id)->first();
                //    var_dump($user_skills_id)
                @endphp

                @if($education_have)
                    @foreach($education_id as $education)
                        @if($education->user_id)
                            <div class="row align-items-center">
                                <div class="col-sm-9">
                                    <div class="service no-margin row">
                                        <div class="col-sm-3 resume-dat serv-logo">
                                            <h6>{{date('Y', strtotime($education->enter_education))}}-{{date('Y', strtotime($education->end_education))}}</h6>
                                            <p>{{$education->education_type}}</p>
                                        </div>
                                        <div class="col-sm-9 rgbf">
                                            <h5>{{$education->university_name}}</h5>
                                            <p>{{$education->university_description}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <a type="button" class="btn btn-primary" style="color: white" data-toggle="modal" data-target="#resumeUpdate{{$education->id}}Modal">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Update
                                    </a>
                                    <a type="button" class="btn btn-danger" style="color: white" data-toggle="modal" data-target="#resumeDelete{{$education->id}}Modal">
                                        <i class="fa-solid fa-trash"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>

                            <div class="modal fade" id="resumeUpdate{{$education->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update University</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('user_create_education/'. $education->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                                <div class="mb-3">
                                                    <label for="university_name" class="form-label">University name</label>
                                                    <input type="text" name="university_name" value="{{$education->university_name}}" class="form-control" id="university_name" aria-describedby="university_name">
                                                    @error('university_name')
                                                    <div id="job_status" style="color: red" class="form-text">You are must be write university name!</div>
                                                    @enderror

                                                    <label for="education_type" class="form-label">Education Type</label>
                                                    <input type="text" name="education_type" value="{{$education->education_type}}" class="form-control" id="education_type" aria-describedby="education_type">
                                                    @error('education_type')
                                                    <div id="company_name" style="color: red" class="form-text">You are must be write education type!</div>
                                                    @enderror

                                                    <label for="enter_education" class="form-label">Enter Education Date</label>
                                                    <input type="date" name="enter_education" value="{{$education->enter_education}}" class="form-control" id="enter_education" aria-describedby="enter_education">
                                                    @error('enter_education')
                                                    <div id="enter_work_date" style="color: red" class="form-text">You are must be write enter education date!</div>
                                                    @enderror

                                                    <label for="end_education" class="form-label">End Education Date</label>
                                                    <input type="date" name="end_education" value="{{$education->end_education}}" class="form-control" id="end_education" aria-describedby="end_education">
                                                    @error('end_education')
                                                    <div id="end_work_date" style="color: red" class="form-text">You are must be write end education date!</div>
                                                    @enderror

                                                    <label for="university_description" class="form-label">University Description</label>
                                                    <textarea name="university_description"  class="form-control" aria-describedby="university_description" id="university_description" cols="30" rows="10">{{$education->university_description}}</textarea>
                                                    @error('university_description')
                                                    <div id="work_description" style="color: red" class="form-text">You are must be write university description!</div>
                                                    @enderror
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="resumeDelete{{$education->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete your {{$education->university_name}}!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('user_create_education/'. $education->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <h1>Are you sure?</h1>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                        Delete Education
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @else
                            <h5 style="text-align: center">Bu yerda sizga tegishli ma'lumot yo'q</h5>
                        @endif
                    @endforeach
                @else
                    <h5 style="text-align: center">Hozircha sizni qayerlarda o'qiganligingiz haqida ma'lumot yo'q, bemalol kiritsangiz bo'ladi!</h5>
                @endif
            </div>

            <div class="tab-pane fade gallcoo" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                <div class="sec-title row">
                    <h2 class="col-sm-10">Portfolio</h2>
                    <div class="col-sm-2">
                        <a type="button" class="btn btn-success" style="color: white" data-toggle="modal" data-target="#portfolioModal">
                            <i class="fa-solid fa-circle-plus"></i>
                            Create
                        </a>
                    </div>
                </div>


                <div class="modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Portfolio</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('user_create_portfolio.store')}}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    {{--                                @method('PUT')--}}
                                    <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                    <div class="mb-3">
                                        <label for="portfolio_name" class="form-label">Portfolio name</label>
                                        <input type="text" name="portfolio_name" class="form-control" id="portfolio_name" aria-describedby="portfolio_name">
                                        @error('portfolio_name')
                                        <div style="color: red" class="form-text">You are must be write portfolio name!</div>
                                        @enderror

                                        <label for="site_url" class="form-label">Site Url</label>
                                        <input type="url" name="site_url" class="form-control" id="site_url" aria-describedby="site_url">
                                        @error('site_url')
                                        <div style="color: red" class="form-text">You are must be write site url!</div>
                                        @enderror

                                        <label for="image" class="form-label">Portfolio Image</label>
                                        <input type="file" name="image" class="form-control" id="image" aria-describedby="image">
                                        @error('image')
                                        <div style="color: red" class="form-text">Error Image</div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa-solid fa-circle-plus"></i>
                                            Create
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                @php

                    $portfolio_id = DB::table('portfolio')->where('user_id',$user_id)->get();
                    $portfolio_have = DB::table('portfolio')->where('user_id',$user_id)->first();
                //    var_dump($user_skills_id)
                @endphp

                <div class="row no-margin gallery">
                    @if($portfolio_have)
                        @foreach($portfolio_id as $portfolio)
                            @if($portfolio->user_id)
                                <div class="col-sm-4">
                                    <h5 class="text-center">{{$portfolio->portfolio_name}}</h5>
                                    <a href="{{$portfolio->site_url}}">
                                        <img src="storage/{{$portfolio->image}}" width="100%" height="200" alt="">
                                    </a>
                                    <br><br>
                                    <div class="d-flex align-items-center" style="justify-content: space-evenly">
                                        <a type="button" class="btn btn-primary" style="color: white" data-toggle="modal" data-target="#PortfolioUpdate{{$portfolio->id}}Modal">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Update
                                        </a>
                                        <a type="button" class="btn btn-danger" style="color: white" data-toggle="modal" data-target="#PortfolioDelete{{$portfolio->id}}Modal">
                                            <i class="fa-solid fa-trash"></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>


                                <div class="modal fade" id="PortfolioUpdate{{$portfolio->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Portfolio</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('user_create_portfolio/'. $education->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                                    <div class="mb-3">
                                                        <label for="portfolio_name" class="form-label">Portfolio name</label>
                                                        <input type="text" name="portfolio_name" value="{{$portfolio->portfolio_name}}" class="form-control" id="portfolio_name" aria-describedby="portfolio_name">
                                                        @error('portfolio_name')
                                                        <div style="color: red" class="form-text">You are must be write portfolio name!</div>
                                                        @enderror

                                                        <label for="site_url" class="form-label">Site Url</label>
                                                        <input type="url" name="site_url" value="{{$portfolio->site_url}}" class="form-control" id="site_url" aria-describedby="site_url">
                                                        @error('site_url')
                                                        <div style="color: red" class="form-text">You are must be write site url!</div>
                                                        @enderror

                                                        <label for="image" class="form-label">Portfolio Image</label>
                                                        <input type="file" name="image"  class="form-control" id="image" aria-describedby="image">
                                                        @error('image')
                                                        <div id="enter_work_date" style="color: red" class="form-text">Error image</div>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="PortfolioDelete{{$portfolio->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete your {{$portfolio->portfolio_name}}!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('user_create_portfolio/'. $portfolio->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <h1>Are you sure?</h1>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                            Delete Education
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @else
                                <h5 style="margin: auto">Bu yerda sizga tegishli ma'lumot yo'q</h5>
                            @endif
                        @endforeach
                    @else
                        <h5 style="margin: auto">Hozircha sizda portfolio yo'q, bemalol qo'shsangiz bo'ladi!</h5>
                    @endif
                </div>

            </div>

            <div class="tab-pane fade contact-tab" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row no-margin">
                    <div class="col-md-6 no-padding">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3176144.0450019627!2d-107.79423426090409!3d38.97644533805396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x874014749b1856b7%3A0xc75483314990a7ff!2sColorado%2C+USA!5e0!3m2!1sen!2sin!4v1547222354537"  frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-6">
                        <div class="row cont-row no-margin">
                            <div class="col-sm-6">
                                <input placeholder="Enter Full Name" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-6">
                                <input placeholder="Enter Email Address" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row cont-row no-margin">
                            <div class="col-sm-6">
                                <input placeholder="Enter Mobile Number" type="text" class="form-control form-control-sm">
                            </div>

                        </div>
                        <div class="row cont-row no-margin">
                            <div class="col-sm-12">
                                <textarea placeholder="Enter your Message" class="form-control form-control-sm" rows="10"></textarea>
                            </div>

                        </div>
                        <div class="row cont-row no-margin">
                            <div class="col-sm-6">
                                <button class="btn btn-sm btn-primary">Send Message</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            @php
                $save_job = DB::table('save_job')->get();

                $save_job_have = DB::table('save_job')->where('user_id',$user_id)->first();
            @endphp
            <div class="tab-pane fade exp-cover" id="saved" role="tabpanel" aria-labelledby="saved-tab">
                <div class="sec-title row">
                    <h2 class="col-sm-12">Saved Vacancy</h2>
                </div>

                <div class="row">
                    @if($save_job_have)
                        @foreach($save_job as $save)
                            @if($save->user_id)
                                @php
                                    $vacancy = DB::table('company_vacancy')->where('id',$save->vacancy_id)->first()
                                @endphp
                                <div class="col-sm-6">
                                    <div class="row ">
                                        <div class="col-sm-7 d-flex align-items-end" >
                                            <h5>{{$vacancy->title}}</h5>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="{{url('vacancy',$vacancy->id)}}" class="btn btn-warning" style="color: white">
                                                <i class="fa-solid fa-eye"></i>
                                                View
                                            </a>
                                        </div>
                                        <div class="col-sm-2">
                                            <form action="{{url('save_job/'. $save->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">
                                                <input type="hidden" name="vacancy_id" value="{{$vacancy->id}}">
                                                <button type="submit" class="btn btn-danger" style="color: white">
                                                    <i class="fa-solid fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <br><br><br>
                            @else
                                <h5>Bu ma'lumot sizga tegishli emas!</h5>
                            @endif
                        @endforeach
                    @else
                        <h5>Hozircha hech qaysi vakansiyani saqlamagansiz!</h5>
                    @endif
                </div>
            </div>
    </div>
</div>

@endsection


