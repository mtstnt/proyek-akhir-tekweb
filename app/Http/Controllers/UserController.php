<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function profile() 
    {
		return view("user/profile", [
			'title' => "Profile: " . Auth::user()->first_name . " " . Auth::user()->last_name,
		]);
    }

    public function history() 
    {
        
        return view("user/history", [
            'title' => "History: " . Auth::user()->first_name . " " . Auth::user()->last_name,
        ]);
    }

    public function viewCart() 
    {
        $cartItems = Cart::all()->where("user_id", "=", Auth::user()->id)->get("id");
        return view("user/cart", [
            'title' => "Cart: " . Auth::user()->first_name . " " . Auth::user()->last_name,
            'cart_items' => $cartItems
        ]);        
    }

    
}
