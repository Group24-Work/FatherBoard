<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // Details for the admin account
    static $adminCred= ["email"=>"Fatherboard@gmail.com", "password"=>"fatherpass123" ,"firstName"=>"Father","lastName"=>"board"];

    public function run()  : void
    {
        // User::factory(10)->create();""

        

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        


        $this->call(CustomerSeeder::class, parameters:['userAmount'=>15,'addressPerUser'=>3]);
        $this->call(ProductSeeder::class, parameters:["amount"=>100]);
        $this->call(AdminSeeder::class, parameters:static::$adminCred);
    }
}
