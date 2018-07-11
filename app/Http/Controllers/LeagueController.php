<?php

namespace App\Http\Controllers;

use App\League;
use Illuminate\Http\Request;
use App\Http\Resources\leaguelist;

use Illuminate\Support\Facades\Auth;
use Validator;

class LeagueController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues=League::all();

        return leaguelist::collection($leagues);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'official' => 'required|exists:users,id',
            'start' => 'date|after:today',
            'end' => 'date|after:start'
            

        ]);

        if ($validator->fails()){
            return response()->json(['error'=> $validator->errors()], 401);
        }

        $name = $request->input('name');
        $official = $request->input('official');
        $start = $request->input('start');
        $end = $request->input('end');

        $league = new League;

        $league->name = $name;
        $league->official_id = $official;
        $league->start = $start;
        $league->end = $end;
        //$success['token'] = $user->createToken('GymApp')->accessToken;
        $sucess['id'] = null;
        $succes['name'] = $name;

        if($league->save()){
            $success['id'] = $league->id;
           return response()->json(['success' => $success],$this->successStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function edit(League $league)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, League $league)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function destroy(League $league)
    {
        //
    }
}
