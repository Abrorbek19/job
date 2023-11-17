<?php

?>

@extends('layout.create_user_profile')
@section('title','Create User Profile')
@section('content')

    @auth

        <div class="col-12">
            <a href="{{url('user_profile')}}"
               style=
                   "
                   text-decoration: none;
                   color: white;
                    background-color: red;
                    display: inline-block;
                    font-weight: 400;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: middle;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                    border: 1px solid transparent;
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    border-radius: 0.25rem;
                    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                    "
            >
                <i class="fa-solid fa-backward"></i>
                Back
            </a>
        </div>
        <br>
        @if($errors->any())
            <div class="col-12">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

    <form action='{{url('create_user_profile')}}' method="POST" class='form' enctype="multipart/form-data">
        @csrf
            <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">

        <p class='field required  @error('job') error @enderror'>
            <label class='label required' for='name'>Your job position</label>
            <input class='text-input' id='name' name='job' type='text'>
        </p>

        <p class='field half required  @error('experiance') error @enderror'>
            <label class='label' for='experiance'>Your experiance</label>
            <input class='text-input' id='experiance' name='experiance' type='number'>
        </p>

        <p class='field half required  @error('website') error @enderror'>
            <label class='label' for='website'>Your website</label>
            <input class='text-input' id='website' name='website' type='text'>
        </p>

        <p class='field half required  @error('birth_date') error @enderror'>
            <label class='label' for='birth_date'>Your birthdate</label>
            <input class='text-input' id='birth_date' name='birth_date' type='date'>
        </p>


        <p class='field half required  @error('languages') error @enderror'>
            <label class='label' for='languages'>Select Languages</label>
            <select data-placeholder="-- Select languages --" multiple class="chosen-select text-input" name="language[]">
                <option value="Uzbek">Uzbek</option>
                <option value="Russian">Russian</option>
                <option value="English">English</option>
            </select>
        </p>

        <p class='field half required  @error('phone') error @enderror'>
            <label class='label' for='phone'>Phone</label>
            <input class='text-input' id='phone' name='phone' type='phone'>
        </p>


        <p class='field half required  @error('gender') error @enderror'>
            <label class='label' for='gender'>Select Gender</label>
            <select class='text-input' id='gender' name='gender'>
                <option selected value="">---Select---</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </p>

        <p class='field half required  @error('country') error @enderror'>
            <label class='label' for='country'>Select Country</label>
            <input class='text-input' id='country' name='country' list='countries' type='text'>
        </p>
        <datalist id="countries">
            <!-- API javobidan generatsiyalan davlatlar shu yerga qo'shiladi -->
        </datalist>

        <div class="avatar-upload required  @error('image') error @enderror">
            <div class="avatar-edit">
                <input type="file" name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload"></label>
            </div>
            <div class="avatar-preview">
                <div id="imagePreview" style="background-image: url('../storage/{{auth()->user()->avatar}}');">
                </div>
            </div>
        </div>


        <p class='field required  @error('about_yourself') error @enderror' >
            <label class='label' for='about'>About Yourself</label>
            <textarea class='textarea' cols='50' id='about' name='about_yourself' rows='5'></textarea>
        </p>


        <p class='field half'>
            <input class='button' type='submit' value='Send'>
        </p>
    </form>
    @endauth

@endsection
