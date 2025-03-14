<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public $model = Tag::class;

    public function definition($tags) : array
    {
        // $tagCollection = ["Blue", "Green", "Yellow", "Magneta"];

        // return [
        //     "Name"=>$tagCollection[rand(0,sizeof($tagCollection)-1)]
        // ];
    }
}
