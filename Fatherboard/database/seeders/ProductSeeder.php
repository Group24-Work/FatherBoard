<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //  public function __construct($amount)
    //  {
    //     Product::factory()->count($amount)->create();

    //  }
    public function run(int $amount=80): void
    {
        Product::factory()->count($amount)->create();
    }
}
