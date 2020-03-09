<?php

namespace App\Http\Controllers;

use App\Components\Functions;
use App\Mail\UserRegistration;
use App\Mail\UserResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $validatedData = request()->all();

        $validator = Validator::make(
            request()->all(),
            [
                'email'                 => 'required|email:rfc,dns|unique:App\User,email',
                'password'              => 'required|confirmed',
                'password_confirmation' => 'required'
            ],
            $this->messages()
        );

        if (!$validator->fails()) {
            $explodedEmail = explode('@', $validatedData['email']);
            $login = reset($explodedEmail);
            $emailToken = password_hash($validatedData['email'], PASSWORD_BCRYPT);

            $validatedData['password'] = password_hash($validatedData['password'], PASSWORD_BCRYPT);
            $validatedData['login'] = $login;
            $validatedData['email_verify_token'] = $emailToken;

            $user = User::create($validatedData);

            Mail::to($validatedData['email'])->send(new UserRegistration($user));

            return redirect('/');
        } else {
            return back()->withErrors($validator)->withInput();
        }
    }

    /**
     * TODO Notifications
     */
    public function emailConfirmation()
    {
        $token = \request()->get('token');
        if ($token) {
            $user = User::where('email_verify_token', $token)->first();
            if ($user && empty($user->email_verified_at)) {
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->save();

                return redirect('/')->with('emailConfirm', 'E-mail подтвержден');
            }
        }

        return redirect('/')->with('emailConfirm', 'Не удалось подтвердить E-mail, обратитесь в тех. поддержкку');
    }

    public function profile($login)
    {
        $user = User::where('login', $login)->first();
        if ($user) {
            return view('user.profile', ['user' => $user]);
        } else {
            return redirect('/');
        }
    }

    public function resetPassword()
    {
        if (\request()->has('email')) {
            $email = request()->get('email');
            $user = User::where('email', $email)->first();
            if ($user) {
                $newPassword = Functions::generatePassword();

                $user->password = password_hash($newPassword, PASSWORD_BCRYPT);
                $user->save();

                Mail::to($email)->send(new UserResetPassword($user));

                return true;
            }
        }

        return false;
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
