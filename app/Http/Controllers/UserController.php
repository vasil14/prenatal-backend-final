<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    //Store new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'lastName' => ['required', 'min:3'],
            'birthday' => ['required'],
            'gender' => ['required'],
            'password' => [
                'required',
                'min:6'
            ]
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        // Generating new Token
        $token = $user->createToken('PersonalAccessToken')->plainTextToken;


        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response(compact('user', 'token'));
    }
}
