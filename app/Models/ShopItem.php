<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
	use HasFactory;

	protected $table = "items";

    protected $fillable = [
		'item_name',
		'price',
		'stock'
	];

    public function images() 
    {
        return $this->hasMany('\App\Models\ItemImages', 'item_id');
	}
	
	public function variants() 
	{
		return $this->hasMany("\App\Models\ItemVariant", "item_id");
    }

    public function cartItem() 
    {
        return $this->hasMany("\App\Models\CartItem", "item_id", "id");
    }
}
