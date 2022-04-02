<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * xxxx
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($attr)) {
            return response()->json([
                'status' => 'wrong',
                'message' => 'Invalid login details'
            ], 401);
        }

        $token = Auth::user()->createToken(Auth::id())->plainTextToken;
        $user = auth()->user();

        $response = [
            'status' => 'success',
            'message' => 'Login successfully',
            'token' => $token,
            'name' => $user->name
            ];

        return response()->json($response,200);
    }

    /**
     * xxxxx
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:60',
            'email' => 'required|string|email|max:150|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken($user->id)->plainTextToken;

        $response = [
            'status' => 'success',
            'message' => 'Register successfully',
            'token' => $token,
            'name' => $user->name
        ];

        return response()->json($response,200);
    }

    /**
     * xxxxx
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        $response = [
            'status' => 'success',
            'message' => 'Logged out'
        ];

        return response()->json($response,200);
    }

    /**
     * xxxx
     *
     * @return \Illuminate\Http\Response
     */
    public function recovery()
    {
        //
    }
}
