<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ReturnedOrder extends Model
{
    use HasFactory;
    protected $fillable = ["order_id","reason"];

    public function order(){
        return $this->belongsTo(Orders::class);
    }


}
