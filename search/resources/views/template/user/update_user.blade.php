<?php
use \Illuminate\Support\Facades\DB;
?>

@extends('layout.create_user_profile')
@section('title','Create User Profile')
@section('content')

    @auth
        @php
        $user_data = DB::table('user_profile')->where('user_id',auth()->user()->id)->first();
       // var_dump($user_data)
        @endphp
        <div>
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

        <form action='{{url('create_user_profile/'.$user_data->id)}}' method="POST" class='form' enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{auth()->user()->id}}">

            <p class='field required @error('job') error @enderror'>
                <label class='label required' for='name'>Your job position</label>
                <input class='text-input' id='name' name='job' value="{{$user_data->job}}" type='text'>
            </p>

            <p class='field half required  @error('experiance') error @enderror'>
                <label class='label' for='experiance'>Your experiance</label>
                <input class='text-input' value="{{$user_data->experiance}}" id='experiance' name='experiance' type='number'>
            </p>

            <p class='field half required  @error('website') error @enderror'>
                <label class='label' for='website'>Your website</label>
                <input class='text-input' id='website' name='website' value="{{$user_data->website}}" type='text'>
            </p>

            <p class='field half required @error('birth_date') error @enderror'>
                <label class='label' for='birth_date'>Your birthdate</label>
                <input class='text-input' id='birth_date' value="{{$user_data->birth_date}}" name='birth_date' type='date'>
            </p>

            @php $languages = explode(',', $user_data->languages); @endphp
            <p class='field half required @error('languages') error @enderror'>
                <label class='label' for='languages'>Select Languages</label>
                <select data-placeholder="-- Select languages --" multiple class="chosen-select text-input" name="language[]">
                    <option value="Uzbek" @if(in_array('Uzbek', $languages)) selected @endif>Uzbek</option>
                    <option value="Russian" @if(in_array('Russian', $languages)) selected @endif>Russian</option>
                    <option value="English" @if(in_array('English', $languages)) selected @endif>English</option>
                </select>
            </p>


            <p class='field half required @error('phone') error @enderror'>
                <label class='label' for='phone'>Phone</label>
                <input class='text-input' id='phone' value="{{$user_data->phone}}" name='phone' type='phone'>
            </p>

            <p class='field half required @error('gender') error @enderror'>
                <label class='label' for='gender'>Select Gender</label>
                <select class='text-input' id='gender'  name='gender'>
                    <option selected value="">---Select---</option>
                    <option @if($user_data->gender == "Male") selected @else @endif value="Male">Male</option>
                    <option @if($user_data->gender == "Female") selected @else @endif value="Female">Female</option>
                </select>
            </p>

            <p class='field half required @error('country') error @enderror'>
                <label class='label' for='country'>Select Country</label>
                <input class='text-input' id='country' value="{{$user_data->country}}" name='country' list='countries' type='text'>
            </p>
            <datalist id="countries">
                <!-- API javobidan generatsiyalan davlatlar shu yerga qo'shiladi -->
            </datalist>

            <div class="avatar-upload required @error('image') error @enderror">
                <div class="avatar-edit">
                    <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload"></label>
                </div>
                @if($user_data->image)
                <div class="avatar-preview">
                    <div id="imagePreview" style="background-image: url('../../storage/{{$user_data->image}}');">
                    </div>
                </div>
                @else
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url('../../storage/{{auth()->user()->avatar}}');">
                        </div>
                    </div>
                @endif
            </div>


            <p class='field required @error('about_yourself') error @enderror' >
                <label class='label' for='about'>About Yourself</label>
                <textarea class='textarea' cols='50'  id='about' name='about_yourself' rows='5'>{{$user_data->about_yourself}}</textarea>
            </p>

            <p class='field half'>
                <input class='button' type='submit' value='Update'>
            </p>
        </form>
    @endauth

@endsection
