<?php

namespace Database\Seeders;

use App\Models\CustomerInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(string $email, string $password, string $firstName, string $lastName): void
    {
        CustomerInformation::create(["Email"=>$email, "Password"=>$password, "First Name"=>$firstName, "Last Name"=>$lastName, "Admin"=>true]);
    }
}
