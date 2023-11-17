<?php

namespace App\Http\Controllers;

use App\Models\JobWork;
use Illuminate\Http\Request;

class JobWorkController extends Controller
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
            'job_status'=>'required',
            'company_name'=>'required',
            'enter_work_date'=>'required',
            'end_work_date'=>'required',
            'work_description'=>'required',
        ]);


        $data = new JobWork();
        $data->user_id = $request->user_id;
        $data->job_status = $request->job_status;
        $data->company_name =$request->company_name;
        $data->enter_work_date = $request->enter_work_date;
        $data->end_work_date = $request->end_work_date;
        $data->work_description = $request->work_description;

        if (!$data->save()){
            return redirect(route('user_profile'))->with('error','Your Job Work created error!');
        }
        return redirect(route('user_profile'))->with('success','Your Job Work successfull created!');
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
        $user_data = JobWork::find($id);
        $input = $request->all();
        $user_data->update($input);

        $request->validate([
            'user_id'=>'required',
            'job_status'=>'required',
            'company_name'=>'required',
            'enter_work_date'=>'required',
            'end_work_date'=>'required',
            'work_description'=>'required',
        ]);
        $user_data->user_id = $request->user_id;
        $user_data->job_status = $request->job_status;
        $user_data->company_name = $request->company_name;
        $user_data->enter_work_date = $request->enter_work_date;
        $user_data->end_work_date = $request->end_work_date;
        $user_data->work_description =$request->work_description;

        if (!$user_data->save()){
            return redirect(route('user_profile'))->with('error','Your Job Work updated error!');
        }
        return redirect(route('user_profile'))->with('success','Your Job Work successfull updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        JobWork::destroy($id);
        return redirect(route('user_profile'))->with('success', 'Your Job Work successfull deleted!');
    }
}
