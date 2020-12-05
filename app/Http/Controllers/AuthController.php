<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	// Untuk masuk ke AuthController, harus sudah login dulu
	public function login() 
	{
		return view("auth/login", [
			'title' => "Login"
		]);
	}

	public function register() 
	{
		return view("auth/register", [
			'title' => "Register"
		]);
	}

	public function checkLogin() 
	{
		$datas = request()->only('input-email', 'input-password');
		foreach($datas as $k => $d) {
			$d = str_replace(' ', '', $d);
			$d = htmlentities($d);
		}
        
		$attemptData = [
			'email' => $datas['input-email'],
			'password' => $datas['input-password']
		];

		if (Auth::attempt($attemptData)) {
			return redirect()->intended('/');
        }
        session()->flash("error", "Incorrect login credentials!");
		return redirect()->route('auth/login');
	}

	public function checkRegister() 
	{
		if (request()->ajax() || request()->isJson()) {
			return json_encode([
				'status' => 0,
				'message' => 'Undefined access!'
			]);
		}

		$datas = request()->only('input-fname', 'input-lname', 'input-email', 'input-password');
		foreach($datas as $k => $d) {
			$d = str_replace(' ', '', $d);
			$d = htmlentities($d);
		}

		if (!preg_match('/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $datas['input-email'])) {
			request()->session()->flash("error", "Invalid email address given!");
			return redirect()->route('auth/register');
		}

		$newUser = new User([
			'first_name' => $datas['input-fname'],
			'last_name' => $datas['input-lname'],
			'email' => $datas['input-email'],
			'password' => bcrypt($datas['input-password'])
		]);

		if (!$newUser->save()) {
			request()->session()->flash("error", "Account registration failed!");
			return redirect()->route('auth/register');
		}

		if (!Auth::attempt([
			'email' => $datas['input-email'],
			'password' => $datas['input-password']
		])) {
			request()->session()->flash("error", "Error logging in account!");
			return redirect()->route('auth/register');
		}

		return redirect("/");
	}

	public function logout() 
	{
		Auth::logout();
		return redirect('auth/login');
	}

	public function guestLogin($mode) 
	{
		if ($mode == 1) {
			if (!Auth::attempt([
				'email' => "admin@memeail.com",
				'password' => "admin123"
			])) {
				echo "HAHAH";
			}
		} else {
			if (!Auth::attempt([
				'email' => "yolanda.kalim@sudiati.biz",
				'password' => "12345"
			])) {
				echo "HAHAH";
			}
		}
	}
}
