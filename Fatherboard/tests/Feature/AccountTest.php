<?php
namespace Tests\Feature;

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

    public static function accountProvider()
    {
        return [
            ["cyanide@gmail.com", "password123"],
            ["droptech@gmail.com", "password123"]
        ];
    }

    public static function adminAccountProvider()
    {
        return [["Fatherboard@gmail.com", "fatherpass123", true]];
    }

    #[DataProvider("accountProvider")]
    public function testCredentials($email, $password)
    {
        // Create a user with the provided credentials
        $user = CustomerInformation::factory()->create([
            'Email' => $email,
            'Password' => $password,
        ]);

        // Attempt to log in
        $response = $this->post("/_login", [
            "email" => $email,
            "password" => $password
        ]);

        // Check if redirection to home page occurs
        $response->assertRedirect("home");
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
}
