<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
	use HasFactory;

	protected $table = "items";

    protected $fillable = [
		'item_id',
		'item_name',
		'price',
		'stock'
	];
}
