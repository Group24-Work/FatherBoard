<?php

namespace Database\Factories;

use App\Models\CustomerInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

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
}
