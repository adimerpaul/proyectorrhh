<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request){
        if (!Auth::attempt($request->all())){
            return response()->json(["res"=>"Usuario no exitente"],400);
        }
        $user=User::where('email',$request->email)->firstOrFail();
        $token=$user->createToken("laravel")->plainTextToken;
        return response()->json(["token"=>$token,'user'=>$user]);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['res'=>'salido exitosamente'],200);
    }
}
