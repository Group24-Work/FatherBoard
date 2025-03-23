<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestrictedUsers extends Model
{
    use HasFactory;
    protected $fillable = ['Restricted', 'customer_information_id'];


    public function user()
    {
        return $this->belongsTo(CustomerInformation::class);
    }
}
