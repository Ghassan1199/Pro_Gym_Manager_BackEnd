<?php

namespace App\Http\Controllers;

use App\Models\coach;
use App\Models\contract;
use App\Models\subscription;
use Illuminate\Http\Request;

class CoachController extends Controller
{


//    public function store(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'first_name' => 'required',
//            'last_name' => 'required',
//            'password' => 'required',
//            'email' => 'required|unique:coach|email',
//            'birthday' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//            $msg = [$validator->errors()->all()];
//            return response()->json(['msg' => $msg], 400);
//        }
//
//        $coach = new coach;
//        $coach['first_name']= $request['first_name'];
//        $coach['last_name'] = $request['last_name'];
//        $coach['password'] = Hash::make($request['password']);
//        $coach['email'] = $request['email'];
//        $coach['birthday'] = $request['birthday'];
//        $coach['gym_id'] = gym::where('admin_id', '=', auth('admin-api')->id())->value('admin_id');
//        $coach->save();
//
//        return response()->json($coach, 200);
//    }

    public function create_qual(Request $request)
    {
        $qual = $request;

        $coach = coach::find($request['id']);
        $coach->qualifications()->create([
            'title' => $qual['title'],
        ]);

        return response()->json($qual, 200);
    }


    //we need the $id for the coach
    public function showAllUsers()
    {
        $coach = coach::find(auth('coach-api')->id());
        $users = $coach->Users()->get();
        $res['users'] = $users;

        return response()->json($res, 200);
    }

    //we need the $id for the coach
    public function showPrivateUsers()
    {
        $coach = coach::find(auth('coach-api')->id());
        $users = $coach->subscription()->where('private', '=', '1')->get();
        $res['users'] = $users;

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
