<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\coach;
use App\Models\contract;
use App\Models\gym;
use App\Models\subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminCon extends Controller
{

    public function index()
    {
        //
    }

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

            $admin['name'] = $request['name'];
            $admin['password'] = Hash::make($request['password']);
            $admin['email'] = $request['email'];
            $admin['birthday'] = $request['birthday'];

            if ($request['img_url']) {
                $getImage = $request->file('img_url');
                $imagename = $request['gym_name'] . '.' . $getImage->extension();
                $imagepath = public_path() . '/images/gyms';
                $getImage->move($imagepath, $imagename);
                $img = url('images/gyms/' . $imagename);
            }


            $admin->save();
            if ($img) {
                $admin->gym()->create([
                    'title' => $request['gym_name'],
                    'address' => $request['gym_address'],
                    'logo_url' => $img
                ]);
            } else {
                $admin->gym()->create([
                    'title' => $request['gym_name'],
                    'address' => $request['gym_address'],
                ]);
            }

        }
        $res = ['admin' => $admin, 'gym' => $admin->gym()->get()->first()];
        return response()->json($res, 200);
    }


    public function show($id)
    {
        $res = admin::find($id);
        return response()->json($res, 200);
    }

    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users|email',
            'height' => 'required',
            'weight' => 'required',
            'birthday' => 'required|date',
        ]);

        if ($validator->fails()) {
            $msg = [$validator->errors()->all()];
            return response()->json(['msg' => $msg], 400);
        }


        $user = new User;
        $user['first_name'] = $request['first_name'];
        $user['last_name'] = $request['last_name'];
        $user['password'] = Hash::make($request['password']);
        $user['email'] = $request['email'];
        $user['height'] = $request['height'];
        $user['gym_id'] = gym::where('admin_id', '=', auth('admin-api')->id())->value('admin_id');
        $user['weight'] = $request['weight'];
        $user['birthday'] = $request['birthday'];
        if ($request['img_url']) {
            $getImage = $request->file('img_url');
            $imagename = $request['first_name'] . '.' . $getImage->extension();
            $imagepath = public_path() . '/images/users';
            $getImage->move($imagepath, $imagename);
            $user['img_url'] = url('images/users/' . $imagename);
        }

        $user->save();

        return response()->json($user, 200);
    }

    public function addCoach(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:coaches|email',
            'speciality' => 'required',
            'birthday' => 'required',
        ]);

        if ($validator->fails()) {
            $msg = [$validator->errors()->all()];
            return response()->json(['msg' => $msg], 400);
        }


        $coach = new coach();
        $coach['first_name'] = $request['first_name'];
        $coach['last_name'] = $request['last_name'];
        $coach['password'] = Hash::make($request['password']);
        $coach['email'] = $request['email'];
        $coach['birthday'] = $request['birthday'];
        $coach['gym_id'] = gym::where('admin_id', '=', auth('admin-api')->id())->value('admin_id');

        if ($request['img_url']) {
            $getImage = $request->file('img_url');
            $imagename = $request['first_name'] . '.' . $getImage->extension();
            $imagepath = public_path() . '/images/coaches';
            $getImage->move($imagepath, $imagename);
            $coach['img_url'] = url('images/coaches/' . $imagename);
        }

        if ($request['phone_number']) $coach['phone_number'] = $request['phone_number'];
        $coach['speciality'] = $request['speciality'];

        $coach->save();

        return response()->json($coach, 200,);
    }

    public function create_cont(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'salary' => 'required',
            'coach_id' => 'required'
        ]);

        if ($validator->fails()) {
            $msg = [$validator->errors()->all()];
            return response()->json(['msg' => $msg], 400);
        }

        $coach = coach::find($request['coach_id']);

        $cont = [
            'coach_id' => $request['coach_id'],
            'salary' => $request['salary'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date']
        ];

        $coach->contract()->create($cont);

        return response()->json($cont, 200);
    }

    public function create_sub(Request $request)
    {
        $user = User::find($request['user_id']);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'coach_id' => 'required',
            'starts_at' => 'required',
            'ends_at' => 'required',
            'private' => 'required',
            'paid_amount' => 'required',
            'fully_paid' => 'required',
            'price' => 'required',
            'sat' => 'required',
            'sun' => 'required',
            'mon' => 'required',
            'tue' => 'required',
            'wed' => 'required',
            'thu' => 'required',
            'fri' => 'required',

        ]);

        if ($validator->fails()) {
            $msg = [$validator->errors()->all()];
            return response()->json(['msg' => $msg], 400);
        }

        $total_days = 0;
        if ($request['sat']) $total_days++;
        if ($request['sun']) $total_days++;
        if ($request['mon']) $total_days++;
        if ($request['tue']) $total_days++;
        if ($request['wed']) $total_days++;
        if ($request['thu']) $total_days++;
        if ($request['fri']) $total_days++;


        $coach = contract::where('coach_id', '=', $request['coach_id'])->get()->last();

        $total_price = $request['price'];
        if ($total_days === 4) {
            $total_price += $request['price'] * 0.05;
        } elseif ($total_days === 5) {
            $total_price += $request['price'] * 0.1;
        } elseif ($total_days === 6) {
            $total_price += $request['price'] * 0.13;
        } elseif ($total_days === 7) {
            $total_price += $request['price'] * 0.15;
        }


        if ($request['private']) {
            $total_price += $coach['salary'] * 0.1;
        }
        $sub = [
            'user_id' => $user['id'],
            'starts_at' => $request['starts_at'],
            'ends_at' => $request['ends_at'],
            'private' => $request['private'],
            'paid_amount' => $request['paid_amount'],
            'fully_paid' => $request['fully_paid'],
            'coach_id' => $request['coach_id'],
            'price' => $total_price,
        ];
        $user->subscription()->create($sub);

        $subs = subscription::where('user_id', '=', $user['id'])->get()->last();

        $subs->days()->create([

            'sat' => $request['sat'],
            'sun' => $request['sun'],
            'mon' => $request['mon'],
            'tue' => $request['tue'],
            'wed' => $request['wed'],
            'thu' => $request['thu'],
            'fri' => $request['fri']

        ]);

        return response()->json($sub, 200);
    }

    public function showOnlyActive()
    {
        $users = User::where('gym_id', '=', auth('admin-api')->id())->get();
        $active = [];
        foreach ($users as $user) {
            if ($user->subscription()->value('ends_at') >= Carbon::now()) {
                $active[] = $user;
            }
        }
        $res['Active_users'] = $active;
        return response()->json($res, 200);
    }

    public function showOnlyInActive()
    {
        $users = User::where('gym_id', '=', auth('admin-api')->id())->get();
        $inactive = [];
        foreach ($users as $user) {
            if ($user->subscription()->value('ends_at') < Carbon::now()) {
                $inactive[] = $user;
            }
        }
        $res['UnActive_users'] = $inactive;
        return response()->json($res, 200);
    }

    public function showAllUsers()
    {
        $users = User::where('gym_id', '=', auth('admin-api')->id())->get();
        $res['users'] = $users;
        return response()->json($res, 200);
    }

    public function showAllUsersCoach($id)
    {
        $coach = coach::find($id);
        $users = $coach->Users()->get();
        foreach ($users as $user){
            $subscription=subscription::where('user_id','=',$user['id'])->get()->last();
            $user['private']=$subscription['private'];
            $res['users'] = $users;
        }
        return response()->json($res, 200);
    }

    public function showSub($id)
    {
        $sub = subscription::where('user_id', '=', $id)->get()->last();
        return response()->json($sub, 200);
    }

    public function showCont($id)
    {
        $cont = contract::Where('coach_id', '=', $id)->get()->last();
        return response()->json($cont, 200);
    }

    public function addPayment(Request $request)
    {
        $amount = $request['amount'];
        $sub = subscription::where('id', '=', $request['sub_id'])->get()->last();
        $sub->payment()->create([
            'amount' => $request['amount']
        ]);
        $res['msg'] = "$amount have been paid";
        return response()->json($res, 200);
    }

    public function showCoach($id)
    {
        $coach = coach::find($id);
        $contract = contract::where("coach_id", '=', $id)->get()->last();
        $coach['starts_at'] = $contract['start_date'];
        $coach['ends_at'] = $contract['end_date'];
        $coach['salary'] = $contract['salary'];
        return response()->json(["coach" => $coach], 200);
    }

    public function showAvailableCoaches()
    {

        $coaches = coach::where('gym_id', '=', auth('admin-api')->id())->get();
        $available = [];
        foreach ($coaches as $coach) {
            if ($coach->contract()->value('end_date') > Carbon::now()) {
                $available[] = $coach;
            }
        }
        $res['Available_coaches'] = $available;
        return response()->json($res, 200);
    }

    public function showUnAvailableCoaches()
    {
        $coaches = coach::where('gym_id', '=', auth('admin-api')->id())->get();
        $Unavailable = [];
        foreach ($coaches as $coach) {
            if ($coach->contract()->value('end_date') < Carbon::now()) {
                $Unavailable[] = $coach;
            }
        }
        $res['UnAvailable_coaches'] = $Unavailable;
        return response()->json($res, 200);
    }

    public function showAllCoaches()
    {
        $coaches = coach::where('gym_id', '=', auth('admin-api')->id())->get();
        foreach ($coaches as $coach) {
            $cont['cont'] = contract::where('coach_id', '=', $coach['id'])->get('salary')->last();
            if ($cont['cont']) {
                $coach['salary'] = $cont['cont']['salary'];
            }

            $res['coaches'][] = $coach;
        }

        return response()->json($res, 200);
    }

    public function update(Request $request, admin $admin)
    {
        //
    }
}
