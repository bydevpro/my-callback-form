<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    //
    public function login(Request $request) 
{
    $formFields = $request->only(['email', 'password']);
    $user = User::where('email', $request->email)->first();

    if (! $user) {
        return redirect(route('user.login'))->withErrors([
            'password' => 'Ошибка!Проверьте данные и повторите ввод.'
        ]);
    }
    
    if (Auth::attempt($formFields)) {
        if($user->isManager === 'yes')
    {
        return redirect()->intended(route('user.admin'));
    }
    else
    {
        return redirect()->intended(route('user.callback'));
    }
    }

    return redirect(route('user.login'))->withErrors([
        'email' => 'Ошибка!Проверьте данные и повторите ввод.'
    ]);
}

}
