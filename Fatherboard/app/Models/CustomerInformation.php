<?php

namespace App\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use App\Models\RestrictedUsers;
class CustomerInformation extends Model
{
    use HasFactory;

    protected $fillable = ["Email","Password", "First Name", "Last Name", "Admin"];


    protected static function boot()
    {
        parent::boot();

        static::created(function ($customer) {
            RestrictedUsers::create([
                'customer_information_id' => $customer->id,
                // 'Restricted' => false, No need as it will be restricted by default
            ]);
        });
    }


    public function setPasswordAttribute($value)
    {
        
        $this->attributes['Password'] = Hash::make($value);  //hashes passwords when registered
    }

    public function address()
    {
        return $this->belongsToMany(AddressInformation::class, "address_customer");
    }

    public function restriction()
    {
        return $this->hasOne(RestrictedUsers::class);
    }
    public static function newFactory()
    {
        return CustomerFactory::new();
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, "customer_id");
    }
}
