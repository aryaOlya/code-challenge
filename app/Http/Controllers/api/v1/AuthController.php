<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\LoginRequest;
use App\Http\Requests\api\v1\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function register(RegisterRequest $request)
    {
        $user = User::query()->create([
            "name"=>$request->name,
            "phone_number"=>$request->phone_number,
            "password"=>$request->password,
            "passConf"=>$request->passConf
        ]);

        $token = $user->createToken('myApp')->plainTextToken;

        return $this->success(["user"=>$user,"token"=>$token],201,'user '.$user->name.' created successfully!');
    }

    public function login(LoginRequest $request)
    {
        $user = User::query()->where('name',$request->name)->first();
        if (!$user){
            return $this::error(401,'user not found');
        }

        if (Hash::check($user->password,$request->password)){
            return $this::error(401,'incorrect password');
        };

        $token = $user->createToken('myApp')->plainTextToken;

        return $this::success(['user'=>$user,'token'=>$token],201,'user '.$user->name.' logged in successfully!');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this::success(null,200,'logout');
    }
}




























