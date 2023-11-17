<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;

class SkillsController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
//        return view('template.skills.create');
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
            'skills'=>'required',
            'range'=>'required',
        ]);


        $data = new Skills();
        $data->user_id = $request->user_id;
        $data->title = $request->skills;
        $data->range =$request->range;

        if (!$data->save()){
            return redirect(route('user_profile'))->with('error','Your skill created error!');
        }
        return redirect(route('user_profile'))->with('success','Your skill successfull created!');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('template.skills.create');
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
        $user_data = Skills::find($id);
        $input = $request->all();
        $user_data->update($input);
        $request->validate([
            'user_id'=>'required',
            'skills'=>'required',
            'range'=>'required',
        ]);
        $user_data->user_id = $request->user_id;
        $user_data->title = $request->skills;
        $user_data->range =$request->range;

        if (!$user_data->save()){
            return redirect(route('user_profile'))->with('error','Your Skill updated error');
        }
        return redirect(route('user_profile'))->with('success','Your skill successfull updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Skills::destroy($id);
        return redirect(route('user_profile'))->with('success', 'Your skill successfull deleted!');
    }
}
