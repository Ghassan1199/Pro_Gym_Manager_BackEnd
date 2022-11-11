<?php

namespace App\Http\Controllers;

use App\Models\coach;
use App\Models\day;
use App\Models\exercies;
use App\Models\payment;
use App\Models\subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function editTrainingDays(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $msg = [$validator->errors()->all()];
            return response()->json($msg, 400);
        }

        $sub = subscription::where('user_id', '=', $request['user_id'])->get()->last();
        $day = day::where('sub_id', '=', $sub->id)->get()->first();

        $day['sat'] = $request['sat'];
        $day['fri'] = $request['fri'];
        $day['sun'] = $request['sun'];
        $day['thu'] = $request['thu'];
        $day['mon'] = $request['mon'];
        $day['tue'] = $request['tue'];
        $day['wed'] = $request['wed'];

        $day->save();
        $res['msg'] = "you`r days have been edited";
        return response()->json([$res, $day], 200);

    }

    public function showDays()
    {
        $sub = subscription::where('user_id', '=', auth('user-api')->id())->get()->last();
        $days = $sub->days()->get()->last();
        return response()->json($days, 200);
    }

    //need the user id to show all his exercieses
    public function showAllExes()
    {
        $sub = subscription::where('user_id', '=', auth('user-api')->id())->get()->last();
        $exe = $sub->exercies()->get();

        return response()->json($exe, 200);
    }

//need the exe id to show it`s full details
    public
    function showExe($id)
    {
        $exe = exercies::find($id);
        return response()->json($exe, 200);
    }

//

    public
    function show()
    {
        $user = User::find(auth('user-api')->id());
        $res['user'] = $user;
        return response($res, 200);
    }

    public
    function update(Request $request)
    {
        $user = User::find(auth('admin-api')->id());
        if ($request['phone_number']) {
            $user['phone_number'] = $request['phone_number'];
        }
        if (isset($request['weight'])) {
            $user['weight'] = $request['weight'];
        }

        $user->save();
        return response($user, 200);
    }

    public
    function showSub()
    {
        $sub = subscription::where('user_id', '=', auth('user-api')->id())->get()->last();
        $payments = payment::where('sub_id', '=', $sub['id'])->get();
        $paid = 0;
        foreach ($payments as $payment) {
            $paid += $payment['amount'];

        }

        if ($paid >= $sub['price']) {
            $sub['fully_paid'] = TRUE;
        } else {
            $sub['fully_paid'] = FALSE;
        }
        $sub['paid_amount'] = $paid;
        $sub->save();
        $coach = coach::find($sub["coach_id"]);
        $sub['coach_name'] = "$coach->first_name $coach->last_name";
        return response()->json($sub, 200);

    }


}
