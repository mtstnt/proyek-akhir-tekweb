<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemImages extends Model
{
    use HasFactory;

	protected $table = 'item_images';

	public $timestamps = false;
	
	public function images()
	{
		return $this->belongsTo("App\Models\ShopItem", "id");
	}
}












