<?php

namespace App\Http\Controllers;

use App\Models\gym;
use Illuminate\Http\Request;

class gymController extends Controller
{

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

    public function showAllCoaches()
    {
        $gym = gym::find(auth("admin-api"));
        $coaches = $gym->coaches()->get();
        $res['coaches'] = $coaches;
        return response()->json($res, 200);
    }


    public function update(Request $request, gym $gym)
    {
        //
    }


    public function destroy(gym $gym)
    {
        //
    }
}
