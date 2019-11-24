<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:60',
            'email' => 'email|required',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('email', $request->email)->first();
        if (!is_null($user)) {
            return response()->json(
                [
                    'response' => 'error',
                    'error' => 'Sorry, this email is already registered'
                ],
                400
            );
        }

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        );

        $user = User::create($data);
        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['data' => $user, 'access_token' => $token], 201);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(
                [
                    'response' => 'error',
                    'error' => 'Sorry, Invalid credentials'
                ],
                400
            );
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->accessToken;

        return response()->json(
            [
                'response' => 'success',
                'success' => 'User are logged in successfully',
                'data' => $user,
                'access_token' => $token
            ],
            200
        );
    }
}
