<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ProductFactory;

use App\Models\ProductPrice;
class Product extends Model
{
    use HasFactory;
    public $fillable = ["Title","Description", "Manufacturer", "Type"];


    public static function newFactory()
    {
        return ProductFactory::new();
    }

    public function price()
    {
        return $this->hasOne(ProductPrice::class);
    }

    public function reviews()
    {
        return $this->hasOne(Review::class);
    }
    public function stock()
    {
        return $this->hasOne(ProductStock::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    protected $casts = [
        'price' =>'float',
    ];
}
