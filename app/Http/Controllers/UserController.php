<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'=>'required',
            'c_password' => 'required|same:password',
            'type'=>'required'

        ]);

        if ($validator->fails()){
            return response()->json(['error'=> $validator->errors()], 401);
        }

        $password = bcrypt($request->input('password'));
        $email = $request->input('email');
        $name = $request->input('name');
        $type = $request->input('type');

        $user = new User;

        $user->name = $name;
        $user->password = $password;
        $user->email = $email;
        $user->type = $type;
        //$success['token'] = $user->createToken('GymApp')->accessToken;
        $success['id'] = null;
        $success['name'] = $name;

        if($user->save()){
            $sucess['id'] = $user->id;
           return response()->json(['data' => $success],$this->successStatus);
        }
    }

    public function login(Request $request){
        
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {

            $user=Auth::user();

            //$success['token'] = $user->createToken('GymApp')->accessToken;
            $sucess['login'] = "true";
            $success['id'] = $user->id;
            $success['type'] = $user->type;

            return response()->json(['data'=>$success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

}
