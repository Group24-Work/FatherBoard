<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = ["Stock", "product_id"];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
