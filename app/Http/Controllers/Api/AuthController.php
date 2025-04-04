<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token' =>$token
        ]);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|string|email',
            'password'=> 'required|string' 
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],422);
        }

        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([ 'error'=>'Thông tin đăng nhập không chính xác'],401);
        }
        $token =$user->createToken('MyApp')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token
        ]
        );
    }

    public function logout(Request $request)
    {   
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'Đăng xuất thành công'
        ]);

    }
}
