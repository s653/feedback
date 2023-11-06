<?php

namespace App\Services;

use App\Http\Resources\Api\ProfileResource;
use Illuminate\Http\Request;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    public function login($request)
    {
        $creds = $request->only(['email', 'password']);

        if (!auth()->attempt($creds)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }
        $user = auth()->user();

        $token = $user->createToken($request->email ? $request->email : $deviceID)->plainTextToken;
        return response()->json(['message' => 'Logged In Successfully', 'data' => ['user' => new ProfileResource($user), 'token' => $token]]);
    }

    public function register($data)
    {
        $data['password']=bcrypt($data['password']);
        $user=User::create($data);

        $token = $user->createToken($data['email'])->plainTextToken;
        return response()->json(['message' => 'Profile Data', 'data' => ['user' => new ProfileResource($user), 'token' => $token]]);
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $request->user()->currentAccessToken()->delete();
        //$user=$request->user();
        return response()->json(['message' => 'Logged Out Successfully']);
    }

}
