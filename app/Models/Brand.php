<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'detail',
        'image',
        'price',
        'product_id',
    ];
    public function product()
{
    return $this->belongsTo(\App\Models\Product::class);
}
}
