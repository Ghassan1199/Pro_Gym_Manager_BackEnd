<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\gym;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param \Illuminate\Http\Request $request
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

            return response($validator->errors()->all(), 400);
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
        return response($res, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = admin::find($id);
        return response([$res], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
