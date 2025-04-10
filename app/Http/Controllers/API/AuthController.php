<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function signup(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string'
            ]
        );
        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validateUser->errors()
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json([
            'status' => true,
            'message' => "User registered successfully",
            'user' => $user,
        ], 200);
    }

    public function login(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|string'
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validateUser->errors()
            ], 401);
        }
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        } else {
            $user = auth()->user();
            return response()->json([
                'status' => true,
                'message' => 'login successful',
                'user' => $user,
                'token' => $user->createToken('API Token')->plainTextToken,
                'token_type' => 'Bearer',
            ], 200);
        }

    }

    public function logout(Request $request)
    {
        //$user =  request()->user();
        $user = auth()->user();
        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully'
            ], 200);
        }
    }
    public function getUser(Request $request)
    {
    
            $users = User::all();
            return response()->json($users);

    }
    public function update(Request $request, $id){
        
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $user->update($request->all());
            return response()->json(['message' => 'User updated successfully'], 200);

    }

    public function delete($id)
    {
        if (auth()->check()) {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
    