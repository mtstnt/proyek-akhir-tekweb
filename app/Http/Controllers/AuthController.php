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
		foreach ($datas as $k => $d) {
			$d = str_replace(' ', '', $d);
			$d = htmlentities($d);
		}

		$attemptData = [
			'email' => $datas['input-email'],
			'password' => $datas['input-password']
		];

		if (Auth::attempt($attemptData)) {
			if (Auth::user()->role == 1) {
				return redirect()->route('admin');
			}
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

		$datas = request()->only('input-fname', 'input-lname', 'input-email', 'input-password', 'confirm-password');
		foreach ($datas as $k => $d) {
			$d = str_replace(' ', '', $d);
			$d = htmlentities($d);
		}

		if (!preg_match('/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $datas['input-email'])) {
			request()->session()->flash("error", "Invalid email address given!");
			return redirect()->route('auth/register');
		}

		if ($datas['confirm-password'] != $datas['input-password']) {
			request()->session()->flash("error", "Password and password confirmation doesn't match!");
			return redirect()->route('auth/register');
		}

		if (strlen($datas['input-password']) < 5 || strlen($datas['input-password']) >= 15) {
			request()->session()->flash("error", "Password length must be more than 5 and less than 16 characters");
			return redirect()->route('auth/register');
		}

		$newUser = new User([
			'first_name' => $datas['input-fname'],
			'last_name' => $datas['input-lname'],
			'email' => $datas['input-email'],
			'password' => bcrypt($datas['input-password']),
			'role' => 0
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
				session()->flash("error", "Failed to login as Admin");
				return redirect('/auth/login');
			}
			return redirect()->route("admin");
		} else {
			$user = User::all()->take(1)->first();

			if (!Auth::attempt([
				'email' => $user->email,
				'password' => "12345"
			])) {
				session()->flash("error", "Failed to login as Guest User. Please consult an Admin.");
				return redirect('/auth/login');
			}
			
			return redirect()->route("main");
		}

	}
}
