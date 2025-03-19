<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ProductPriceFactory;
use Database\Seeders\OrdersSeeder;

class ReturnedOrder extends Model
{
    use HasFactory;
    protected $fillable = ["order_id","return_reason_id"];

    public function order(){
        return $this->belongsTo(Orders::class);
    }

    public function reason()
    {
        return $this->hasMany(ReturnReason::class);
    }

}
