<?php

namespace App\Http\Controllers;

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

	public function checkLogin(Request $request) 
	{

	}

	public function checkRegister() 
	{

	}
}
