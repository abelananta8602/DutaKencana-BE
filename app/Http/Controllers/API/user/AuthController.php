<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:20'],


        ]);
        $validateData['role_id'] = 2;
        $validateData['password'] = Hash::make($request->password);
        $userData = User::create($validateData);
        $accessToken = $userData->createToken('authToken')->accessToken;

        return response()->json(['user' => $userData, 'access_token' => $accessToken], 201);
    }

    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validateData)) {
            $userData = Auth::user();
            $accessToken = $userData->createToken('authToken')->accessToken;

            return response()->json(['user' => $userData, 'access_token' => $accessToken], 200);
        }
        return response()->json(['message' => 'Incorrect email or password'], 422);
    }
}
