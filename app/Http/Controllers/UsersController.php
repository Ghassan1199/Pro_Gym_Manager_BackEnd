<?php

namespace App\Http\Controllers;

use App\Models\gym;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response($users);
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
    public function store(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users',
            'height' => 'required',
            'weight' => 'required',
            'birthday' => 'required',
        ]);
        if ($validator->fails()) {
            $msg = [$validator->errors()->all()];
            return response(['msg' => $msg], 400);
        }
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->birthday = $request->birthday;
        $user->gym_id = gym::where('admin_id', '=', auth('admin-api')->id())->value('admin_id');


        $user->save();

        return response($user);
    }

    public function create_sup(Request $request)
    {
        $user = User::find($request->user_id);
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'coach_id' => 'required',
            'starts_at' => 'required',
            'ends_at' => 'required',
            'private' => 'required',
            'paid_amount' => 'required',
            'fully_paid' => 'required',
            'price' => 'required'

        ]);
        if ($validator->fails()) {
            $msg = [$validator->errors()->all()];
            return response(['msg' => $msg], 400);
        }

        $sub = [
            'user_id' => $user->id,
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
            'private' => $request->private,
            'price' => $request->price,
            'paid_amount' => $request->paid_amount,
            'fully_paid' => $request->fully_paid,
            'coach_id' => $request->coach_id
        ];

        $user->subscription()->create($sub);
        return response($sub);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response($user, 200);
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
        $user = User::find($id);
        if ($request['phone_number']) {
            $user['phone_number'] = $request['phone_number'];
        }
        if (isset($request['weight'])) {
            $user['weight'] = $request['weight'];
        }
        $user->save();
        return response($user, 200);
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
