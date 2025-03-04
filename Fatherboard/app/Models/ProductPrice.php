<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Database\Factories\ProductPriceFactory;

class ProductPrice extends Model
{
    use HasFactory;
    protected $fillable = ["price", "product_id"];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public static function newFactory()
    {
        return ProductPriceFactory::new();
    }
}
