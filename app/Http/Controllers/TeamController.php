<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Team;

use App\Player;
use Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams= Team::all();
        return response()->json($teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        //Do not need this function
//        // it is used to display the form
//        //  we are just working on the back end
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'team_name'=>'required',
            'uname'=>'required|unique:teams',
            'coach_name'=>'required'
        ]);
        if($validator->fails()){
            $response = array('response'=>$validator->messages(),'success'=>false);
            return $response;
        }else{
            //Create teams
            $team= new Team;
            $team->team_name= $request->input('team_name');
            $team->uname= $request->input('uname');
            $team->phone= $request->input('phone');
            $team->email= $request->input('email');
            $team->gender= $request->input('gender');
            $team->coach_name= $request->input('coach_name');
            $team->constituency= $request->input('constituency');
            $team->photo= $request->input('photo');
            $team->save();

            return response()->json($team);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $team_id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teams= Team::find($id);
        return response()->json($teams);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $team_id
     * @return \Illuminate\Http\Response
     */
//    public function edit($team_id)
//    {
//        //Do not need this function
//        // it is used to display the edit form
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $team_id
     * @return \Illuminate\Http\Response
     */
    //POST..._method = PUT IN postman api
    public function update(Request $request, $team_id)
    {
        $validator = Validator::make($request->all(),[
            'team_name'=>'required',
            'uname'=>'required',
            'coach_name'=>'required'


        ]);
        if($validator->fails()){
            $response = array('response'=>$validator->messages(),'success'=>false);
            return $response;
        }else{
            //Find teams
            $team= Team::find($team_id);
            $team->team_name= $request->input('team_name');
            $team->uname= $request->input('uname');
            $team->phone= $request->input('phone');
            $team->email= $request->input('email');
            $team->gender= $request->input('gender');
            $team->coach_name= $request->input('coach_name');
            $team->constituency= $request->input('constituency');
            $team->photo= $request->input('photo');
            $team->save();

            return response()->json($team);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $team_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($team_id)
    {
        if($team= Team::find($team_id)){
            $team->delete();

            $response = array('response'=>'Team Deleted','success' => true);
            return $response;
        }else{
            $response2 = array('response'=>'Team Does not exist','success' => true);
            return $response2;

        }
    }
}
