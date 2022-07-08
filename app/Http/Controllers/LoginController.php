<?php

namespace App\Http\Controllers;

use App\Models\admin;
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
            return response()->json(["message" => $validator->errors()->first()], 400);
        }

        if (admin::where('email', $email)->count() <= 0) return response(array("message" => "Email number does not exist"), 400);

        $admin = admin::where('email', $email)->first();

        if (password_verify($password, $admin->password)) {

            $admin->last_login = Carbon::now();

            return response(array("message" => "Sign In Successful", "data" => [
                "admin" => $admin,
                "token" => $admin->createToken(
                    'Personal Access Token',
                    ['admin'])->accessToken])
                , 200);

        } else {
            return response(array("message" => "Wrong Credentials."), 400);
        }
    }
}
