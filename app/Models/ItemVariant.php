<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVariant extends Model
{
	use HasFactory;

	public $timestamps = false;
	
	public function variants() 
	{
		return $this->belongsTo("\App\Models\ShopItem", "id");
	}
}
