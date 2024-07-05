<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Usercontroller extends Controller
{
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginemail' => 'required|email',
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(['email' => $incomingFields['loginemail'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect("/");
        }

        return back()->withErrors([
            'loginemail' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect("/");
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', Rule::unique('users', 'name')],
            'lastname' => 'required',
            'birthday' => 'required|date',
            'cin' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required',
            'role' => 'required',
            'phonenumber'=>'required',
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }
}
