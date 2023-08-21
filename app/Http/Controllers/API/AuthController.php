<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'work' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'work' => $request->work,
        ])->assignRole('user');

        $token = $user->createToken('AuthApp')->plainTextToken;

        return response()->json(['token' => $token, 'token_type' => 'Bearer', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
//            $token = Auth::user()->createToken('AuthApp')->accessToken;
            // retrieve latest user from credentials
            $user = User::where('email', $request->email)->first();

            //displaying token for issue
            $token = $user->createToken('AuthApp')->plainTextToken;
            return response()->json(['access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
