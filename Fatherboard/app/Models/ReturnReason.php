<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnReason extends Model
{
    protected $fillable = ["reason"];

    public function ReturnedOrder()
    {
        return $this->hasMany(ReturnedOrder::class);
    }

}
