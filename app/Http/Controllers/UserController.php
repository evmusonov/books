<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function signIn()
    {
        return view('user.signin');
    }

    public function messages()
    {
        return [
            'email.required' => 'E-mail обязателен для заполнения',
            'email.exists' => 'E-mail не найден',
            'password.required'  => 'Пароль обязателен для заполнения',
        ];
    }

    public function login()
    {
        $validatedData = request()->all();

        $validator = Validator::make(
            request()->all(),
            [
                'email'    => 'required|email:rfc,dns|exists:users',
                'password' => 'required',
                'remember' => 'required'
            ],
            $this->messages()
        );

        if (!$validator->fails()) {
            if (!password_verify($validatedData['password'], User::getPasswordHash($validatedData['email']))) {
                return back()->with('passwordError', 'Неверный пароль')->withInput();
            }

            $user = User::where([
                ['email', $validatedData['email']],
                ['password', User::getPasswordHash($validatedData['email'])]
            ])->first();
            if ($user) {
                $auth = Auth::loginUsingId($user->id,isset($validatedData['remember']) ? true : false);
                if ($auth) {
                    return redirect('/');
                }
            } else {
                return back()->with('emailError', 'Пользователь с таким E-mail адресом не существует')->withInput();;
            }
        } else {
            return back()->withErrors($validator)->withInput();
        }
    }

    public function signUp()
    {
        return view('user.signup');
    }

    public function register()
    {
        $validatedData = request()->validate([
            'email'                 => 'required|email:rfc,dns|unique:App\User,email',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $validatedData['password'] = password_hash($validatedData['password'], PASSWORD_BCRYPT);
        User::create($validatedData);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
