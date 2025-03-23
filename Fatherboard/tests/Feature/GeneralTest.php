<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Database\Seeders\DatabaseSeeder;


trait SeedsTestDatabase
{
    use RefreshDatabase;
    protected function seedDatabase()
    {
    
        $this->seed(DatabaseSeeder::class);
    }
}

class GeneralTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use SeedsTestDatabase, RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();
        $this->seedDatabase();
    }

    public function test_home_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);  

        $response = $this->get('/home');

        $response->assertStatus(200);  

    }

    public function test_about_page()
    {
        $response = $this->get('/about');

        $response->assertStatus(200);  


    }


}
