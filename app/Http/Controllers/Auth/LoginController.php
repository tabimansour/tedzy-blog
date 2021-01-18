<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }

    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // validate
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        // login user
        if(!auth()->attempt($request->only('username', 'password'), $request->remember)) {
            return back()->with('status', 'Incorrect username or password!');
        } else {
            return redirect()->route('dashboard');
        }
    }
}
