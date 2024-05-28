<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id=4
        ];

        $user = User::create($userData);
        $token = $user->createToken('user_token')->plainTextToken;

        return response([
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function Login(LoginRequest $request)
    {
        $request->validated();

        $user = User::whereEmail($request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => 'Invalid credential'
            ], 422);
        }

        $token = $user->createToken('user_token')->plainTextToken;

        return response([
            'token' => $token,
            'user' => $user
        ], 200);
    }

    public function user()
    {
        return response()->json(auth()->user());
    }

    public function show()
    {
        $user = User::all();

        return response([
            'message' => 'List User',
            'user' => $user
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response([
            'message' => 'User has been logged out'
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return response([
            'message' => 'User has been deleted'
        ]);
    }

    public function edit(EditRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id = 4;
        $user->save();

        return response([
            'message' => 'User has been updated',
            'user' => $user
        ]);
    }

    public function editUsername(EditRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);
        $user->name = $request->name;
        $user->save();

        return response([
            'message' => 'Username has been updated',
            'user' => $user
        ]);
    }

    public function editEmail(EditRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);
        $user->email = $request->email;
        $user->save();

        return response([
            'message' => 'Email has been updated',
            'user' => $user
        ]);
    }

    public function editPassword(EditRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return response([
            'message' => 'Password has been updated',
            'user' => $user
        ]);
    }
}
