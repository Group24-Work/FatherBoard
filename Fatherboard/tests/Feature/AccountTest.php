<?php
namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use App\Models\BasketItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\CustomerInformation;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\ProductSeeder;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Depends;
use App\Http\Controllers\BasketController;
use App\Models\RestrictedUsers;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class AccountTest extends TestCase
{
    use RefreshDatabase; // Refresh database before each test

    public function setUp(): void
    {
        parent::setUp();
        
        // Seed the database with the required data
        $this->seed(DatabaseSeeder::class);
        
        // Optionally check if products are seeded
        // dd(Product::all()->toArray());
    }

    

    public static function adminAccountProvider()
    {
        return [["Fatherboard@gmail.com", "fatherpass123", true]];
    }

    #[DataProvider("accountProvider")]
    public function testCredentials($email, $password)
    {
        // Create a user with credentials
        $user = CustomerInformation::factory()->create([
            'Email' => $email,
            'Password' => $password,
        ]);

        // Try logging in
        $response = $this->post("/_login", [
            "email" => $email,
            "password" => $password
        ]);

        // Check if redirection to home page occurs
        $response->assertRedirect("home");
    }


    public static function accountProvider()
    {
        return [
            ["cyanide@gmail.com", "password123"],
            ["droptech@gmail.com", "password123"]
        ];
    }

    #[DataProvider("accountProvider")]
    public function testCheckEncryption($email, $password)
    {
        $user = CustomerInformation::factory()->create(["Email"=>$email, "Password"=>$password]);

        $this->assertNotEquals($user->Password, $password);

        $this->assertTrue(Hash::check($password, $user->Password));
    }
    public function testAddToBasket()
    {
        // Admin Credentials
        $email = "Fatherboard@gmail.com";
        $password = "fatherpass123";
        

        // Log in the user
        $response = $this->post("/_login", [
            "email" => $email,
            "password" => $password
        ]);


        // Add product to basket
        $productId = Product::first()["id"]; 
        $response = $this->post("/basket/add", [
            'product_id' => $productId,
            'quantity' => 2
        ]);


        $user = CustomerInformation::where("Email",$email)->first();
        $this->assertDatabaseHas(BasketItem::class, ["customer_information_id"=>$user->id, "product_id"=>$productId]);;
        return  ["product_id"=>$productId, "customer_information_id"=>$user->id];
    }


    #[Depends("testAddToBasket")]
    public function testRemoveBasket($arr)
    {

        $prod_id = $arr["product_id"];
        $customer_id = $arr["customer_information_id"];
        $url = "/basket/remove";

        $this->post($url, ["product_id"=>$prod_id]);

        $this->assertDatabaseMissing(BasketItem::class, ["customer_information_id"=>$customer_id, "product_id"=>$prod_id]);
    }


    public function testRemoveIllegalItem_Basket()
    {
        $url = "/basket/remove";
        
        $response = $this->post($url, ["product_id" => 9999]);
        
        // Assert that the session has an error message
        $response->assertSessionHasErrors();
        
      
        $response->assertSessionHasErrors(['product_id' => 'The selected product is not in your basket.']);
        
    
        $response->assertRedirect('/basket'); // Assuming it redirects back to basket
    }


    #[DataProvider("adminAccountProvider")]
    public function testCheckAdminUser($email, $password)
    {
        // Log in the admin user
        $response = $this->post("/_login", [
            "email" => $email,
            "password" => $password
        ]);

        // Assert that the user is redirected to the home page
        $response->assertRedirect("/home");
    }


    public function test_update_customer_restriction_with_valid_data()
    {
        $customer = CustomerInformation::factory()->create();

    

        $response = $this->postJson("/restrict/update/{$customer->id}", [
            'new_value' => 1
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'Message' => 'Updated the quality'
                ]);

        // Assert the database was updated correctly
        $this->assertDatabaseHas('restricted_users', [
            'customer_information_id' => $customer->id,
            'Restricted' => 1
        ]);
    }

    public function test_delete_valid_customer()
    {
        $customer = CustomerInformation::factory()->create();


        $response = $this->postJson("/account/destroy/{$customer->id}");


        $response->assertStatus(200)
        ->assertJson([
            'Message' => 'User deleted'
        ]);

    }

    public function test_delete_invalid_customer()
    {
        // Test how the system reacts to an invalid user id
        $invalidUserID = 9999;
        $response = $this->postJson("/account/destroy/{$invalidUserID}");


        $response->assertStatus(400)
        ->assertJson([
            'Message' => 'User does not exist'
        ]);

    }



    public function test_store_prevents_duplicate_tag_names()
    {
        Tag::create(['Name' => 'Existing Tag']);

        $response = $this->putJson('/tags/create', [
            'Name' => 'Existing Tag'
        ]);

        $response->assertStatus(409)
                ->assertJson([
                    'message' => 'This name has already been taken'
                ]);

        $this->assertEquals(1, Tag::where('Name', 'Existing Tag')->count());
    }

    public function test_store_with_empty_tag_name()
    {
        $response = $this->putJson('/tags/create', [
            'Name' => ''
        ]);

        $response->assertStatus(400);
    }

    public function test_admin_can_access_admin_hub()
{
            $adminUser = CustomerInformation::factory()->create([
                'Password' => "password",
                "Email"=>"sanica",
                'Admin' => false
            ]);
            
            $this->withSession([
                'email' => $adminUser->Email,
                'password' => "password",
            ]);
            $response = $this->get('/admin');
            
            $response->assertStatus(200);
            $response->assertViewIs('admin_hub');
    }
        public function test_non_admin_can_access_admin_hub()
        {
                $nonAdminUser = CustomerInformation::factory()->create([
                    'Password' => "password",
                    'Admin' => false
                ]);
                
                $this->withSession([
                    'email' => $nonAdminUser->email,
                    'password' => "haha",
                ]);
                
                $response = $this->get('/admin');
                
                $response->assertStatus(300);
                $response->assertViewIs('home');
        }
}
