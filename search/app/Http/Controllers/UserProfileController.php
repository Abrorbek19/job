<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{

    public function index(){
        return view('template.user.profile');
    }

    public function create(){
        return view('template.user.create_user');
    }

    public function store(Request $request){

        $request->validate([
            'user_id'=>'required',
            'job'=>'required',
//            'about_yourself'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,|max:2048',
//            'birth_date'=>'required',
//            'gender'=>'required',
//            'country'=>'required',
//            'phone'=>'required',
        ]);

        $data = new UserProfile();
        $data->user_id = $request->user_id;
        $data->job = $request->job;
        $data->experiance =$request->experiance;
        $data->website = $request->website;

//        $data->languages = $request->language;
        if ($request->language !=null){
            $lang = $request->language;
            $save_lang  = implode(",", $lang);
            $data->languages = $save_lang;
        }
        $data->about_yourself = $request->about_yourself;
        $data->birth_date = $request->birth_date;
        $data->gender = $request->gender;
        $data->country = $request->country;
        $data->phone = $request->phone;

//        dd($data);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) .'.'.$image->getClientOriginalExtension();

            // Oy, yil va fayl nomini saqlash
            $currentDateTime = date('FY'); // October2023 formatda olingan hozirgi vaqtni
            $directory = 'user-profile/' . $currentDateTime;
            $image->storeAs("public/{$directory}", $imageName);
            $data->image = $directory.'/'.$imageName;
        }

        if (!$data->save()){
            return redirect(route('create_user_profile'))->with('error','User profile error created!!');
        }
        return redirect(route('user_profile'))->with('success','User profile successfull created!');
    }

//    public function show($id)
//    {
//        $user = UserProfile::find($id);
//        return view('template.user.profile',compact('user'));
//    }

    public function edit($id)
    {
        $user = UserProfile::find($id);
        return view('template.user.update_user',compact('user'));
    }

    public function update(Request $request ,$id){
        $user_data = UserProfile::find($id);
        $input = $request->all();
        $user_data->update($input);
        $request->validate([
            'user_id'=>'required',
//            'job'=>'required',
//            'about_yourself'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,|max:2048',
//            'birth_date'=>'required',
//            'gender'=>'required',
//            'country'=>'required',
//            'phone'=>'required',
        ]);

        $user_data->user_id = $request->user_id;
        $user_data->job = $request->job;
        $user_data->experiance =$request->experiance;
        $user_data->website = $request->website;

//        $data->languages = $request->language;
        if ($request->language !=null){
            $lang = $request->language;
            $save_lang  = implode(",", $lang);
            $user_data->languages = $save_lang;
        }
        $user_data->about_yourself = $request->about_yourself;
        $user_data->birth_date = $request->birth_date;
        $user_data->gender = $request->gender;
        $user_data->country = $request->country;
        $user_data->phone = $request->phone;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) .'.'.$image->getClientOriginalExtension();

            // Oy, yil va fayl nomini saqlash
            $currentDateTime = date('FY'); // October2023 formatda olingan hozirgi vaqtni
            $directory = 'user-profile/' . $currentDateTime;
            $image->storeAs("public/{$directory}", $imageName);
            $user_data->image = $directory.'/'.$imageName;;
        }

//        dd($user_data);

        if (!$user_data->save()){
//            var_dump($user_data);
            return redirect(route('create_user_profile'))->with('error','User profile error updated!');
        }
        return redirect(route('user_profile'))->with('success','User profile successfull updated!');
    }

}
