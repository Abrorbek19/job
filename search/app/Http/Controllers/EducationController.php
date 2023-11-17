<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'user_id'=>'required',
            'university_name'=>'required',
            'education_type'=>'required',
            'enter_education'=>'required',
            'end_education'=>'required',
            'university_description'=>'required',
        ]);

        $data = new Education();
        $data->user_id = $request->user_id;
        $data->university_name = $request->university_name;
        $data->education_type =$request->education_type;
        $data->enter_education = $request->enter_education;
        $data->end_education = $request->end_education;
        $data->university_description = $request->university_description;

        if (!$data->save()){
            return redirect(route('user_profile'))->with('error','Your Education created error!');
        }
        return redirect(route('user_profile'))->with('success','Your Education successfull created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $user_data = Education::find($id);
        $input = $request->all();
        $user_data->update($input);

        $request->validate([
            'user_id'=>'required',
            'university_name'=>'required',
            'education_type'=>'required',
            'enter_education'=>'required',
            'end_education'=>'required',
            'university_description'=>'required',
        ]);
        $user_data->user_id = $request->user_id;
        $user_data->university_name = $request->university_name;
        $user_data->education_type = $request->education_type;
        $user_data->enter_education = $request->enter_education;
        $user_data->end_education = $request->end_education;
        $user_data->university_description =$request->university_description;

        if (!$user_data->save()){
            return redirect(route('user_profile'))->with('error','Your Education updated error!');
        }
        return redirect(route('user_profile'))->with('success','Your Education successfull updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Education::destroy($id);
        return redirect(route('user_profile'))->with('success', 'Your Education successfull deleted!');
    }
}
