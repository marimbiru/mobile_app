<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Validator;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players= Player::all();
        return response()->json($players);
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
            'name'=>'required',
            'email'=>'required|unique:players',
            'player_status'=>'required'
        ]);
        if($validator->fails()){
            $response = array('response'=>$validator->messages(),'success'=>false);
            return $response;
        }else{
            //Create players
            $player= new Player;
            $player->current_team_id= $request->input('current_team_id');
            $player->name= $request->input('name');
            $player->phone= $request->input('phone');
            $player->photo= $request->input('photo');
            $player->birth_certificate= $request->input('birth_certificate');
            $player->email= $request->input('email');
            $player->position= $request->input('position');
            $player->player_status= $request->input('player_status');
            $player->sub_team= $request->input('sub_team');
            $player->date_joined= $request->input('date_joined');
            $player->date_left= $request->input('date_left');
            $player->save();

            return response()->json($player);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $player_id
     * @return \Illuminate\Http\Response
     */
    public function show($player_id)
    {
        $players= Player::find($player_id);
        return response()->json($players);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $player_id
     * @return \Illuminate\Http\Response
     */
//    public function edit($player_id)
//    {
//        //Do not need this function
//        // it is used to display the edit form
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $player_id
     * @return \Illuminate\Http\Response
     */
    //POST..._method = PUT IN postman api
    public function update(Request $request, $player_id)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
              'player_status'=>'required'


        ]);
        if($validator->fails()){
            $response = array('response'=>$validator->messages(),'success'=>false);
            return $response;
        }else{
            //Find players
            $player= Player::find($player_id);
            $player->current_team_id= $request->input('current_team_id');
            $player->name= $request->input('name');
            $player->phone= $request->input('phone');
            $player->photo= $request->input('photo');
            $player->birth_certificate= $request->input('birth_certificate');
            $player->email= $request->input('email');
            $player->position= $request->input('position');
            $player->player_status= $request->input('player_status');
            $player->sub_team= $request->input('sub_team');
            $player->date_joined= $request->input('date_joined');
            $player->date_left= $request->input('date_left');
            $player->save();

            return response()->json($player);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $player_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($player_id)
    {
        if($player= Player::find($player_id)){
        $player->delete();

        $response = array('response'=>'Player Deleted','success' => true);
        return $response;
        }else{
        $response2 = array('response'=>'Player Does not exist','success' => true);
        return $response2;

    }
    }
}
