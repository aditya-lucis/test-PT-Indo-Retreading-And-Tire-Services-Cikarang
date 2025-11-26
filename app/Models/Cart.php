<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "carts";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['customer_id'];
}
