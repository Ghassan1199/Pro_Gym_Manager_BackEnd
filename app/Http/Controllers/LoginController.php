<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\coach;
use App\Models\gym;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function adminLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $rules = [
            'email' => 'required|email|max:255',
            'password' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(null, 400, ["message" => $validator->errors()->first()]);
        }

        if (admin::where('email', $email)->count() <= 0) {
            return response()->json(null, 400, ["message" => "Email does not exist"]);
        }

        $admin = admin::where('email', $email)->first();

        if (password_verify($password, $admin->password)) {

            $admin->last_login = Carbon::now();
            $admin['gym'] = gym::where('id', '=', $admin['id'])->get()->last();
            return response(
                array("message" => "Sign In Successful", "data" => [
                    "admin" => $admin,
                    "token" => $admin->createToken(
                        'Personal Access Token',
                        ['admin']
                    )->accessToken
                ]),
                200
            );
        } else {
            return response()->json(null, 401, ["message" => "Wrong Credentials."]);
        }
    }

    public function coachLogin(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');

        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()], 400);
        }

        if (coach::where('email', $email)->count() <= 0) {
            return response(array("message" => "Email does not exist"), 400);
        }
        $coach = coach::where('email', $email)->first();

        if (password_verify($password, $coach->password)) {

            $coach->last_login = Carbon::now();
            $coach['gym'] = gym::find($coach['gym_id']);

            return response(
                array("message" => "Sign In Successful", "data" => [
                    "coach" => $coach,
                    "token" => $coach->createToken(
                        'Personal Access Token',
                        ['coach']
                    )->accessToken
                ]),
                200
            );
        } else {
            return response()->json(null, 401, ["message" => "Wrong Credentials."]);
        }
    }

    public function userLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()], 400);
        }

        if (User::where('email', $email)->count() <= 0) {
            return response(array("message" => "Email does not exist"), 400);
        }
        $user = User::where('email', $email)->first();

        if (password_verify($password, $user->password)) {

            $user->last_login = Carbon::now();
            $user['gym'] = gym::find($user['gym_id']);
            $sub = $user->subscription()->get()->last();
            if($sub['ends_at'] < Carbon::now()){
                $user['valid']="false";
            }else{
                $user['valid']="true";
            }
            return response(
                array("message" => "Sign In Successful", "data" => [
                    "user" => $user,
                    "token" => $user->createToken(
                        'Personal Access Token',
                        ['user']
                    )->accessToken
                ]),
                200
            );
        } else {
            return response()->json(null, 401, ["message" => "Wrong Credentials."]);
        }
    }
}
