<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run($tags): void
    {
        $tagCollection = ["Blue", "Green", "Yellow", "Magneta"];

        foreach ($tagCollection as $tag)
        {
            Tag::create(["Name"=>$tag]);
        }

    }
}
