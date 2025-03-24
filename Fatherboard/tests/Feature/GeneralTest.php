<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Database\Seeders\DatabaseSeeder;

use App\Models\Product;

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
    public function test_contact_us()
    {

        $response = $this->get("/contact");
        $response->assertStatus(200);
    }

    public function test_product_page()
    {
        $response = $this->get("/products");
        $response->assertStatus(200);
    }


    public function testProductPageShowsCorrectInformation()
{
        $product = Product::factory()->create([
            'id' => 5,
            'Title' => 'Test Product',
            'Description' => 'This is a test product description'
        ]);

        $response = $this->get('/product/5');

        $response->assertStatus(200);

        // Assert the view has the correct product data
        $response->assertViewHas('product', function ($viewProduct) use ($product) {
            return $viewProduct->id === $product->id;
        });

        $response->assertSee($product->Title);
    }


}
