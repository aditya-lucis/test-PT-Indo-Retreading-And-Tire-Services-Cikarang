<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "products";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name', 'description', 'price', 'stock'];
}
