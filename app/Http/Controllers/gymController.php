<?php

namespace App\Http\Controllers;

use App\Models\gym;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class gymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $gyms = gym::all();
        return response()->json($gyms, 200);
    }

    public function show(gym $gym, $id)
    {
        $gym = gym::find($id);
        return response()->json($gym, 200);
    }

    public function showAllUsers($id)
    {
        $gym = gym::find($id);
        $users = $gym->users()->get();
        $res['users'] = $users;
        return response()->json($res, 200);
    }

    public function showAllCoaches($id)
    {
        $gym = gym::find($id);
        $coaches = $gym->coaches()->get();
        $res['coaches'] = $coaches;
        return response()->json($res, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param gym $gym
     * @return Response
     */
    public function update(Request $request, gym $gym)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param gym $gym
     * @return Response
     */
    public function destroy(gym $gym)
    {
        //
    }
}
