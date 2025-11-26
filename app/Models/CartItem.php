<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "cart_items";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price_at_time'];
}
