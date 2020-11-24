<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	use HasFactory;
	
	protected $table = "carts";

    protected $fillable = [
		'cart_id',
		'user_id',
	];
}
