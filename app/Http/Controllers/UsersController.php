<?php

namespace App\Http\Controllers;

use App\Models\day;
use App\Models\exercies;
use App\Models\gym;
use App\Models\subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
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
            return response()->json(['msg' => $msg], 400);
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->birthday = $request->birthday;
        $user->gym_id = gym::where('admin_id', '=', auth('admin-api')->id())->value('admin_id');


        $user->save();

        return response()->json($user, 200);
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
            return response()->json(['msg' => $msg], 400);
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
        return response()->json($sub, 200);
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
        $sub = subscription::where('user_id', '=', $request->user_id)->get()->last();
        $day = day::where('sub_id', '=', $sub->id)->get()->first();
        if (is_null($day)) {

            $days = [
                'sat' => $request->sat,
                'sun' => $request->sun,
                'mon' => $request->mon,
                'tue' => $request->tue,
                'wed' => $request->wed,
                'thu' => $request->thu,
                'fri' => $request->fri
            ];

            $sub->days()->create($days);
            return response()->json($days, 200);
        } else {

            $day['sat'] = $request->sat;
            $day['fri'] = $request->fri;
            $day['sun'] = $request->sun;
            $day['thu'] = $request->thu;
            $day['mon'] = $request->mon;
            $day['tue'] = $request->tue;
            $day['wed'] = $request->wed;

            $day->save();
            $res['msg'] = "you`r days have been edited";
            return response()->json([$res, $day], 200);
        }
    }

    public function addexe(Request $request, $id)
    {

        $sub = subscription::where('user_id', '=', $id)->get()->last();
        $exe = [
            'title' => $request->title,
            'desc' => $request->desc
        ];
        $sub->exercies()->create($exe);
        $res['msg'] = "the exercies have been added succesfully";
        $res['exe'] = $exe;
        return response()->json($res, 200);
    }

    public function showDays($id)
    {
        $sub = subscription::where('user_id', '=', $id)->get()->last();
        $days = $sub->days()->get();
        return response()->json($days, 200);
    }

    //need the user id to show all his exercieses
    public function showAllExes($id)
    {

        $sub = subscription::where('user_id', '=', $id)->get()->last();
        $exe = $sub->exercies()->get();

        return response()->json($exe, 200);
    }

    //need the exercies id to show it`s full details
    public function showExe($id)
    {
        $exe = exercies::find($id);
        return response()->json($exe, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response($user, 200);
    }

    public function showOnlyActive($id)
    {
        $users = User::where('gym_id', '=', $id)->get();
        $active = [];
        foreach ($users as $user) {
            if ($user->subscription()->value('ends_at') >= Carbon::now()) {
                $active[] = $user;
            }
        }
        $res['Active_users'] = $active;
        return response()->json($res, 200);
    }

    public function showOnlyUnActive($id)
    {
        $users = User::where('gym_id', '=', $id)->get();
        $unactive = [];
        foreach ($users as $user) {
            if ($user->subscription()->value('ends_at') < Carbon::now()) {
                $unactive[] = $user;
            }
        }
        $res['UnActive_users'] = $unactive;
        return response()->json($res, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
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

}
