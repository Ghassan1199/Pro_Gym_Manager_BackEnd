<?php

namespace App\Http\Controllers;

use App\Models\coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\gym;
use App\Models\qualifications;
use App\Models\contract;

class CoachController extends Controller
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
    public function store(Request $request, coach $coach)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users',
            'birthday' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'salary' => 'required'
        ]);

        if ($validator->fails()) {
            $msg = [$validator->errors()->all()];
            return response(['msg' => $msg], 400);
        }
        $coach->first_name = $request->first_name;
        $coach->last_name = $request->last_name;
        $coach->password = $request->password;
        $coach->email = $request->email;
        $coach->birthday = $request->birthday;
        $coach->gym_id = gym::where('admin_id', '=', auth('admin-api')->id())->value('admin_id');
        $coach->save();

        return response($coach, 200);
    }

    public function create_qual(Request $request){
        $qual=$request;
        $coach=coach::find($request->id);
        $coach->qualifications()->create([
            'title'=>$qual->title,
        ]);

        return response($qual,200);
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
            return response(['msg' => $msg], 400);
        }

        $coach = coach::find($request->coach_id);

        $cont = [
            'coach_id' => $request->coach_id,
            'salary' => $request->salary,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];

        $coach->contract()->create($cont);

        return response($cont, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function show(coach $coach)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coach $coach)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function destroy(coach $coach)
    {
        //
    }
}
