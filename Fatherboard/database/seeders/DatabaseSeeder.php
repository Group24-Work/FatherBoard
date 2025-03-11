<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // Details for the admin account
    static $adminCred= ["email"=>"Fatherboard@gmail.com", "password"=>"fatherpass123" ,"firstName"=>"Father","lastName"=>"board"];
    static $tagCollection = ["Blue", "Green", "Yellow", "Magneta"];

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

        $this->call(TagSeeder::class, parameters : ["tags"=>static::$tagCollection]);

        $groupedTags = Tag::all()->groupBy("Name");

        Product::all()->each(function ($x)
        {
            $x->stock()->create(["Stock"=>200]);
            $x->tags()->attach(Tag::all()->random(rand(1,3))->pluck("id")->toArray());
        });
        
    }
}
