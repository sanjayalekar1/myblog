<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class AuthController extends Controller {
    public function login(Request $request) {
    	$compact = [];

    	if($request->method() == "POST") {
    		$input_list = [
    			'email' => ['bail', 'required', 'email', 'exists:users,email'],
    			'password' => ['bail', 'required']
    		];

    		$validation_list = [
    			'email.required' => 'Please enter your email ID',
    			'email.email' => 'Please enter a valid email ID',
    			'email.exists' => 'This user doesn\'t exists',
    			'password.required' => 'Please enter your password'
    		];

    		Validator::make($request->all(), $input_list, $validation_list)->validate();

    		if(empty($errors)) {
    			$credentials = $request->only('email', 'password');

    			if(Auth::attempt($credentials)) {
    				$request->session()->regenerate();

    				return redirect()->intended('century-admin-panel');
    			}

    			return back()->withErrors([
    				'email' => 'The provided credentials do not match our records.'
    			]);
    		}

    		$compact = [$errors];
    	}

    	return view('admin.login', compact($compact));
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('century-admin-panel/login');
    }
}