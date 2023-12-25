<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email_address' => 'required|email|max:100',
            'email' => 'required|email|unique:users|max:150',
            'password' => 'required|string|max:100',
        ]);
        // For example, set the role to 'admin' if a specific condition is met
        $data['role'] = $request->input('is_admin') ? 'admin' : 'user';
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json(['user' => $user], 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'string|max:100',
            'email_address' => 'email|max:100',
            'email' => 'email|unique:users|max:150',
            'password' => 'string|max:100',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json(['user' => $user]);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = $request->user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function currentUser()
    {
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
