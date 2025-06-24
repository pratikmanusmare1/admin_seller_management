<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Yeh yahan add karo!
    protected $fillable = [
        'name',
        'description',
        'seller_id',
    ];

    public function brands()
    {
        return $this->hasMany(\App\Models\Brand::class);
    }
}