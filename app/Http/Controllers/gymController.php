<?php

namespace App\Http\Controllers;

use App\Models\gym;
use Illuminate\Http\Request;

class gymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gyms = gym::all();
        return response($gyms, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gym  $gym
     * @return \Illuminate\Http\Response
     */
    public function show(gym $gym, $id)
    {
        $gym = gym::find($id);
        return response($gym, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gym  $gym
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gym $gym)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gym  $gym
     * @return \Illuminate\Http\Response
     */
    public function destroy(gym $gym)
    {
        //
    }
}
