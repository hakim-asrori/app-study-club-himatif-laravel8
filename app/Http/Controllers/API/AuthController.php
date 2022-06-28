<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'min:6|required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 403);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Auth::attempt($request->all())) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login success!',
                    'data' => $user
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Password wrong!'
                ], 403);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not found!'
            ], 403);
        }
    }

    public function registration(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
            'category' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 403);
        }

        $user = User::create([
            'id_class' => 1,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => 3,
            'id_category' => $request->category,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registration success!',
            'data' => $user
        ], 201);
    }
}
