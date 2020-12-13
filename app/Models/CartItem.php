<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// The cart ITEM HOLDER

class CartItem extends Model
{
	use HasFactory;
	
    protected $table = "carts";

    public $timestamps = false;

	public function cart() 
	{
		return $this->belongsTo("\App\Models\Cart", "cart_id");
	}

	public function user() 
	{
		return $this->belongsTo("\App\Models\User", "cart_id");
    }

    public function item() {
        return $this->belongsTo("\App\Models\ShopItem", "item_id");
    }


}
