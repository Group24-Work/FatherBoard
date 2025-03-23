<?php

namespace Database\Factories;

use App\Models\RestrictedUsers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RestrictedUsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = RestrictedUsers::class;
    public function definition(): array
    {
        return [
            "Restricted"=>false
        ];
    }
}
