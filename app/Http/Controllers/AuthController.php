<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\VarDumper\Dumper\esc;

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
		return redirect()->route('auth/login');
	}

	public function checkRegister() 
	{

	}

	public function logout() 
	{
		Auth::logout();
		return redirect()->back();
	}
}
