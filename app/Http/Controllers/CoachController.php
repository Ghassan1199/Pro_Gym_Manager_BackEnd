<?php

namespace App\Http\Controllers;

use App\Models\coach;
use App\Models\contract;
use App\Models\exercies;
use App\Models\subscription;
use App\Models\User;
use Illuminate\Http\Request;

class CoachController extends Controller
{


    //we need the $id for the coach
    public function showAllUsers()
    {
        $coach = coach::find(auth('coach-api')->id());
        $subs = $coach->subscription()->where('private', '=', '0')->get();
        $user = [];
        foreach ($subs as $sub) {
            $user[] = User::find($sub['user_id']);
        }
        $res['users'] = $user;

        return response()->json($res, 200);

    }

    public function showAllExes($id)
    {
        $sub = subscription::where('user_id', '=', $id)->get()->last();
        $exe = $sub->exercies()->get();
        $res['exes']=$exe;
        return response()->json($res, 200);
    }

    public function removeExe($id)
    {
        $exe = exercies::find($id);
        $exe->delete();
        return response()->json(["msg"=>"deleted"],200);
    }

    //we need the $id for the coach
    public function showPrivateUsers()
    {
        $coach = coach::find(auth('coach-api')->id());
        $subs = $coach->subscription()->where('private', '=', '1')->get();
        $user = [];
        foreach ($subs as $sub) {
            $user[] = User::find($sub['user_id']);
        }
        $res['users'] = $user;

        return response()->json($res, 200);
    }


    public function show()
    {
        $id = auth('coach-api')->id();
        $coach = coach::find($id);
        return response()->json($coach, 200);
    }

    public function addexe(Request $request, $id)
    {

        $sub = subscription::where('user_id', '=', $id)->get()->last();
        $exe = [
            'title' => $request['title'],
            'desc' => $request['desc']
        ];
        $sub->exercies()->create($exe);
        $res['msg'] = "the exercies have been added succesfully";
        $res['exe'] = $exe;
        return response()->json($res, 200);
    }

    public function showCont()
    {
        $cont = contract::Where('coach_id', '=', auth('coach-api')->id())->get()->last();
        return response()->json($cont, 200);
    }


    public function update(Request $request, coach $coach)
    {
        //
    }


}
