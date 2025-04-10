<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        // if($validator->fails()){
        //   return response()->json($validator->errors(), 422);
        // }


        $user = User::create($validator);

        //var_dump($user);

        if ($user) {
            return redirect('/login');
        }

        return response()->json(['message' => 'User registration failed.'], 500);
    }


    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (auth()->attempt($credentials)) {
            return redirect('/dashboard');
        }
    }

    public function dashboard(Request $request)
    {
        if (auth()->check()) {
            $users = User::all();
            dump($users);

            return view('dashboard', compact('users'));
        } else {
            return redirect('/login');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function getUser(Request $request)
    {
        if (auth()->check()) {
            $users = User::all();
            return response()->json($users);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }


    public function delete($id)
    {
        if (auth()->check()) {

            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $user->delete();
             
            return redirect('/dashboard');
            
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->check()) {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $user->update($request->all());

            return redirect('/dashboard');
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

}
