<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function profile() 
	{
		if (!Auth::check()) {
			return redirect()->route('auth/login');
		}

		return view("user/profile", [
			'title' => "Profile: " . Auth::user()->first_name . " " . Auth::user()->last_name,
		]);
	}
}
