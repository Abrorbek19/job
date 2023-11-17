<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
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
        $request->validate([
            'user_id'=>'required',
            'portfolio_name'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,|max:4096',
            'site_url'=>'required',
        ]);

        $data = new Portfolio();
        $data->user_id = $request->user_id;
        $data->portfolio_name = $request->portfolio_name;
        $data->site_url =$request->site_url;

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
            return redirect(route('create_user_profile'))->with('error','User portfolio error created!!');
        }
        return redirect(route('user_profile'))->with('success','User portfolio successfull created!');
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
        $user_data = Portfolio::find($id);
        $input = $request->all();
        $user_data->update($input);
        $request->validate([
            'user_id'=>'required',
            'portfolio_name'=>'required',
            'site_url'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,|max:4096',
        ]);
        $user_data->user_id = $request->user_id;
        $user_data->portfolio_name = $request->portfolio_name;
        $user_data->site_url =$request->site_url;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) .'.'.$image->getClientOriginalExtension();

            // Oy, yil va fayl nomini saqlash
            $currentDateTime = date('FY'); // October2023 formatda olingan hozirgi vaqtni
            $directory = 'user-profile/' . $currentDateTime;
            $image->storeAs("public/{$directory}", $imageName);
            $user_data->image = $directory.'/'.$imageName;;
        }

        if (!$user_data->save()){
//            var_dump($user_data);
            return redirect(route('create_user_profile'))->with('error','User portfolio error updated!');
        }
        return redirect(route('user_profile'))->with('success','User portfolio successfull updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Portfolio::destroy($id);
        return redirect(route('user_profile'))->with('success', 'Your portfolio successfull deleted!');
    }
}
