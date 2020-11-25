<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function profile() 
	{
		$user = new User();
		$result = $user->joinCart()->where('user.id', '=', Auth::user()->id)->get(['*']);
		dd($result);

		return view("user/profile", [
			'title' => "Profile: " . Auth::user()->first_name . " " . Auth::user()->last_name,
		]);
	}
}
