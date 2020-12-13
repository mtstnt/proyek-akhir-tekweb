<?php


namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	use HasFactory;
	
    protected $table = "carts_list";

    public $timestamps = false;

	public function cartItems() 
	{
		$this->hasMany("\App\Models\CartItem", "cart_id");
	}
}
