<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    /** @use HasFactory<\Database\Factories\OrdersFactory> */
    use HasFactory;
    protected $fillable = ['order_id','order_status','customer_id', 'address_id', 'order_number'];
    public function order_details()//Establishes many to many relationship with Product model through order_details pivot
    {
        return $this->hasMany(order_details::class, "order_id");
    }

    public function customer()
    {
        return $this->belongsTo(CustomerInformation::class, "customer_id");
    }
    public function returnedOrder()
    {
        return $this->hasOne(ReturnedOrder::class);
    }
    public function getRouteKeyName()
{
    return 'id';
}
}
