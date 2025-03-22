<?php

namespace App\Http\Controllers;

use App\Models\order_details;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Models\AddressInformation;
use App\Models\ContactForm;
use App\Models\CustomerInformation;
use Faker\Provider\ar_EG\Address;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

    public static function pageSettings()
    {

        if ($user = AuthController::loggedIn())
        {
            $addr = $user->address;
            $orders = [];


            $adminStatus = $user["Admin"];
            // dd($user);

            $filteredUser =collect([$user])->map(function($y)
            {
                return ["FirstName"=>$y["First Name"], "LastName"=>$y["Last Name"], "Email"=>$y["Email"], "Password"=>self::getPass(), "Admin"=>$y["Admin"]];
            })->get(0);

            // dd($user->address);


            if ($user["Admin"])
            {

                
                foreach ($user->orders as $x)
                {
                    $orderPrice = DB::table('order_details')
                    ->join('products', 'order_details.products_id', '=', 'products.id')
                    ->join('product_prices', 'products.id', '=', 'product_prices.product_id')
                    ->where('order_details.order_id', $x["id"])
                    ->select(
                
                        DB::raw('SUM(product_prices.price * order_details.quantity) as total_amount')
                    )->first();

                    $details = $x->order_details->all();

                    $orderProduct = ["price"=>$orderPrice->total_amount, "elements"=>[], "order_number"=>$x->order_number];

                    foreach ($details as $x)
                    {
                        // dd(Product::where("id",$x["products_id"])->first());
                         $product = Product::where("id",$x["products_id"])->first();
                         array_push($orderProduct["elements"], $product["Title"]);

                    }
                    array_push($orders, $orderProduct);
            };
            return view('settings', ["addr"=>$addr, "user"=>$filteredUser, "messages"=>ContactForm::all(), "items"=>$orders]);


            }
            else
            {
                $orders = [];


                foreach ($user->orders as $x)
                {
                    $orderPrice = DB::table('order_details')
                    ->join('products', 'order_details.products_id', '=', 'products.id')
                    ->join('product_prices', 'products.id', '=', 'product_prices.product_id')
                    ->where('order_details.order_id', $x["id"])
                    ->select(
                
                        DB::raw('SUM(product_prices.price * order_details.quantity) as total_amount')
                    )->first();

                    $details = $x->order_details->all();
                    $orderProduct = ["price"=>$orderPrice->total_amount, "elements"=>[],"order_number"=>$x->order_number];

                    foreach ($details as $x)
                    {
                        // dd(Product::where("id",$x["products_id"])->first());
                         $product = Product::where("id",$x["products_id"])->first();
                         array_push($orderProduct["elements"], $product["Title"]);

                    }
                    array_push($orders, $orderProduct);


                }
                return view('settings', ["addr"=>$addr, "user"=>$filteredUser, "messages"=>ContactForm::all(), "items"=>$orders,]);
            }

        }
        else
        {
            return redirect("./login");
        }
    }

    public static function showAddress()
    {
        if ($user = AuthController::loggedIn())
        {
            $addr = $user->address;

            return json_encode($addr);
        }
        return json_encode("");
    }

    private static function getPass()
    {
        $form = AuthController::whichLog();
        $password = null;

        if ($form == "cookie")
        {
            $password = $_COOKIE["password"];
        }
        else if ($form == "session")
        {
            AuthController::enableSession();
            $password = $_SESSION["password"];

        }
        return $password;
    }
    public static function showPersonal()
    {

        $password = self::getPass() ?? null;
        if ($user = AuthController::loggedIn())
        {
            $addr = $user->toArray();
            $addr["Password"] = $password;
            return json_encode($addr);
        }



        return json_encode("");
    }

    public static function updatePersonal()
    {
        if ($user = AuthController::loggedIn())
        {
        $updated = request("personal_text");
        $version = request("version");

        $data = [$version=>$updated];

        $form = AuthController::whichLog();

        if ($version == "Password")
        {
            $data = [$version=>Hash::make($updated)];

        }
        CustomerInformation::where("id",$user["id"])->update($data);

        if ($version == "Password")
        {
        if ($form == "cookie")
        {
            $length = time() + 60*60*24*30;

            // setcookie("email", $updated, $length, path: "/");
            setcookie("password", $updated, $length, "/");

        }
        if ($form == "session")
        {
            AuthController::enableSession();
            $_SESSION["password"] = $updated;
        }
    }
    if ($version == "Email")
        {
        if ($form == "cookie")
        {
            $length = time() + 60*60*24*30;

            setcookie("email", $updated, $length, "/");

        }
        if ($form == "session")
        {
            AuthController::enableSession();
            $_SESSION["email"] = $updated;
        }
    }
    return json_encode(["conn"=>true]);

        }



    }
    public static function addAddress($id, $Country, $City, $AddrLine, $postCode)
{
    $cust = CustomerInformation::find($id);
    $addr = AddressInformation::create(["Country"=>$Country, "City"=>$City, "Address Line"=>$AddrLine, "PostCode"=>$postCode]);
    $cust->address()->attach($addr);
    return $addr;
}

public static function form_addAddress()
{
    if ($user = AuthController::loggedIn())
    {
        // Validation Work

        // $_POST = json_decode(json: file_get_contents('php://input'), true);

        $id = $user["id"];
        $country = $_POST["Country"];

        $city = $_POST["City"];

        $addrline = $_POST["AddressLine"];

        $postCode = $_POST["PostCode"];

         $addr =  self::addAddress($id,$country,$city,$addrline, $postCode);

         return json_encode($addr);

    }
    return json_encode("sk");
}

public static function form_removeAddress()
{
    if ($user = AuthController::loggedIn())
    {
        $_POST = json_decode(file_get_contents("php://input"),true);
        $user_id = $user["id"];
        $address_id = $_POST["address_id"];

        self::removeAddress($user_id, $address_id);
        return json_encode("");

    }

}


public static function showOrder($id)
{
    if ($user = AuthController::loggedIn())
    {
        // $order_det = $user->orders->find($id)->order_details()->with("product")->get();

        $allOrderDetails = order_details::whereHas("order", function($q) use($id,$user)
        {
            $q->where("customer_id",$user["id"]);
        });

        $order_select = DB::select("
    SELECT * FROM (
        SELECT *, ROW_NUMBER() OVER (PARTITION BY customer_id ORDER BY created_at ASC) AS order_rank
        FROM orders
    ) ranked_orders
    WHERE customer_id = ? and order_rank = ?
", [$user["id"], $id]);


        $orderId = $order_select[0]->id ?? null;

        $order = Orders::find($orderId);

        $products = DB::table('order_details')
    ->join('products', 'order_details.products_id', '=', 'products.id')
    ->join("product_prices", "products.id", "=", "product_prices.product_id") // Join products with order_details on product_id
    ->where('order_details.order_id', $orderId) // Optional: Filter by specific order_id
    ->select('products.id', 'products.Title', "product_prices.price") // Select specific columns from the products table
    ->get();

    

    $x = $products->map(function ($x)
    {
        $imageId = $x->id;
        $imageId = $imageId > 25 ?  1 :  $imageId;
        return ["id"=>$x->id, "Title"=>$x->Title, "price"=>$x->price, "image"=>$imageId];
    });
  

        // $res = order_details::where("order_id",operator: $item)->get() ;

        // $resProd_id = $res->pluck("products_id");

        // $allProducts = Product::whereIn("id", $resProd_id)->get();
    

        // dd($products);
        // $prodCol = $all_order_id::where("order_id",$all_order_id)->get()->map(callback: function ($order) 
        // {
        //     return ["id"=>$order["id"], "title"=>$order["title"]];
        // }


        // $productsArr = [];
        // foreach ($order_det as $order)
        // {
        //     array_push($productsArr, $order->product()->first());
        // }

        return view("order",["data"=>$x, "orders"=>$order]);
        
    }
}

public static function removeAddress($user_id, $address_id)
{
    // AddressInformation::where("customer_information_id",$user_id)::where("address_information_id",$address_id)->delete();

    CustomerInformation::where("id",$user_id)->first()->address->where("id",$address_id)->first()->delete();
}
}
