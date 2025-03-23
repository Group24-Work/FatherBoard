<?php

namespace Database\Factories;

use App\Models\CustomerInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\AddressInformation;
use App\Models\RestrictedUsers;

/**
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CustomerInformation::class;
    public function definition(): array
    {
        return [
            "Email"=>fake()->email(),
            "First Name"=>fake()->firstName(),
            "Last Name"=>fake()->lastName(),
            "Password"=>fake()->password()
        ];
    }

    public function hasAddr(int $num)
    {
        return $this->has(AddressInformation::factory($num), 'address');
    }

    public function restriction()
    {
        return $this->has(RestrictedUsers::factory(), "restriction");
    }

    public function admin()
    {
        $this->state(fn ($attr) => ["Admin"=>true]);
    }
}
