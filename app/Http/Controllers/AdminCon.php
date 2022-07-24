<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\gym;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

class AdminCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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
     * @param admin $admin
     * @return Response
     */
    public function show($id)
    {
        $res = admin::find($id);
        return response()->json($res, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param admin $admin
     * @return Response
     */
    public function update(Request $request, admin $admin)
    {
        //
    }
}
