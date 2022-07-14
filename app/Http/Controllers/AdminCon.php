<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\coach;
use App\Models\gym;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminCon extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, admin $admin, gym $gym)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|',
            'email' => 'required|unique:admins,email|email',
            'birthday' => 'required',
            'gym_name' => 'required',
            'gym_address' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json($validator->errors()->all(), 400);
        } else {

            $admin->name = $request['name'];
            $admin->password = Hash::make($request->password);
            $admin->email = $request['email'];
            $admin->birthday = $request['birthday'];

            $admin->save();

            $admin->gym()->create([
                'title' => $request->gym_name,
                'address' => $request->gym_address
            ]);
        }
        $res = ['admin' => $admin, 'gym' => $admin->gym()->get()->first()];
        return response()->json($res, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = admin::find($id);
        return response()->json($res, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admin $admin)
    {
        //
    }
}
