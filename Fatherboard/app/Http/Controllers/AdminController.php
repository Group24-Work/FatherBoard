<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use App\Models\CustomerInformation;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Tag;
class AdminController extends Controller
{
    public function giveAdminHub()
    {
        if (AuthController::loggedIn_withAdmin())
        {
            return view('admin_hub');
        }
        else
        {
            // $controller = new HomeController();
            return redirect()->route("home");
        }
    }


 

    public function getFirstSale($productID = -1)
    {
        if ($productID == -1)
        {
            $productID = request()->input("id");

        }

        DB::select("CALL findRange ( ?, @low, @high ) ", [$productID]);

        $res = DB::select("select @low as low, @high as high");
        return $res[0];
    }
    public function giveRevenue()
    {


        $first = self::getFirstSale();
        // $startDate = now()->subDays(7)->format("Y-m-d");
        // $curDate = now()->format("Y-m-d");

        $data = file_get_contents("php://input");
        $decodedData = json_decode($data, true);

        $startDate = $decodedData["startDate"] ?? null;
        $endDate = $decodedData["endDate"] ?? null;
        $productID = $decodedData["productID"] ?? null;
        if ($startDate == null || $endDate == null)
        {
            $startDate = $first->low;
            $endDate = $first->high;

        }

        $params = [$startDate,$endDate,-1];
        DB::statement("TRUNCATE TABLE tbl_revListing;");
        DB::statement("CALL revenueListing ( ?, ?, ?)", $params);

        $results = DB::table('tbl_revListing')->get();

 

        $coll = collect($results);

        $filtered = $coll->map(function ($x)
        {
            return ["total_sales"=>$x->total_sales ? (int)$x->total_sales : 0, "date"=>$x->dt];
        });

        $format = $filtered->flatten();
        


    return json_encode($filtered);


    }

    public function dateCreation($start, $end)
    {
        $dates = [];

        try
        {
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

        }
        catch(InvalidFormatException $ex)
        {
            return response()->json(['message'=>"Error with date parsing"], 400);
        }
        $dateDay = $startDate;

        while ($dateDay <= $endDate)
        {
            array_push($dates, $dateDay->toDateString());
            $dateDay->addDay();
        }
        return $dates;

    }
    public function giveOrders()
    {
        $days = self::dateCreation(now()->subDays(7)->format("Y-m-d"), "2025-03-25");

        $daysCollection = collect($days);
        // dd($days);

        $resByDate = DB::table("orders")
    ->join("order_details", "orders.id", "=", "order_details.order_id")
    ->selectRaw("DATE(order_details.created_at) as cDate, SUM(quantity) as total_quantity")
    ->groupBy("cDate")
    ->get()->keyBy("cDate");

        $resTotal = DB::table("orders")
        ->join("order_details", "orders.id", "=", "order_details.order_id")
        ->selectRaw(" SUM(quantity) as total_quantity")
        ->get();


        $result = [];
        $daysCollection->each(function($x) use($resByDate, &$result)
        {
            $result[] = ["date"=>$x,
             "quantity" =>$resByDate->has($x) ? $resByDate[$x]->total_quantity : 0
            ];
        });


    }

    public  function giveCategoryRevenue()
    { 

        $startDate = request()->input("startDate") ?? null;
        $endDate = request()->input("endDate") ?? null;
        $first = self::getFirstSale();

        // dd(request());
        if ($startDate == null || $endDate == null)
        {
            // dd(request());
            $startDate = $first->low;
            $endDate = $first->high;
        }

        $days = self::dateCreation($startDate, $endDate);

        $daysCollection = collect($days);

        // Get products by category
        $productsCat = DB::table("orders")
        ->join("order_details", "order_details.order_id","=","orders.id")
        ->join("products", "products.id","=","order_details.products_id")
        ->join("product_prices", "product_prices.product_id","=","products.id")
        ->selectRaw("Type, SUM(quantity*price) as total_revenue, DATE(order_details.created_at) as created")
        ->groupBy("Type", "created")
        ->get();


        $revByCat_all = [];
        foreach ($days as $day)
        {
            $revByCat = [
                "day"=>$day,
                "categories"=>[]
            ];

            $sameDay = $productsCat->where("created", $day);
            foreach($sameDay as $sday)
            {
                $revByCat["categories"][$sday->Type] = $sday->total_revenue;
            }
            $revByCat_all[] = $revByCat;
        }
        $result = [];
        return $revByCat_all;
    }


    public function giveRegisteredUsers()
    {
  

       
        $startDate = request()->input("startDate") ?? null;
        $endDate = request()->input("endDate")?? null;

        if (!strtotime($startDate))
        {
            $startDate = null;
            $endDate = null;
        }

        if (!strtotime($endDate))
        {
            $startDate = null;
            $endDate = null;
        }

        $results = [];

        if ($startDate == null || $endDate == null)
        {
            $resTotal = DB::table("customer_information")->selectRaw("COUNT(*) as registered")
        ->get();
        $results = $resTotal;

        }
        else
        {
        $days = self::dateCreation($startDate, $endDate);
        $daysCollection = collect($days);

        $res = DB::table("customer_information")->selectRaw("DATE(created_at) as created, COUNT(*) as registered")
        ->groupBy("created")->get()
        ->keyBy("created");



        foreach($daysCollection as $day)
        {
            $results[] = ["date"=>$day, "registered"=>$res->has($day) ? $res[$day]->registered : 0];
        }
        }
        return $results;
    }

    public function giveRegisteredUsers_time()
    {

        $startDate = request()->input("startDate") ?? null;
        $endDate = request()->input("endDate") ?? null;


        DB::statement("DROP TEMPORARY TABLE IF EXISTS timeUs;");
        DB::statement("CREATE TEMPORARY TABLE IF NOT EXISTS timeUs (dates DATE);");
        DB::statement("INSERT INTO timeUs (dates) VALUES (DATE(?));", [$startDate]);


        $query = "
        WITH RECURSIVE ask (c) AS (
            SELECT dates FROM timeUs
            UNION ALL
            SELECT DATE_ADD(c, INTERVAL 1 DAY)
            FROM ask
            WHERE c < ?
        ) 
        SELECT 
            a.c AS created,
            COUNT(ci.id) OVER (ORDER BY a.c ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS cumulative_registrations
        FROM ask a
        LEFT JOIN customer_information ci
        ON DATE(ci.created_at) = a.c
    ";
    
    // 3. Execute Query and Get Results
    $res = DB::select($query, [$endDate]);

//         $res = DB::table("customer_information")->selectRaw("DATE(created_at) as created ,sum(COUNT(*)) over (partition by created) as cumulative_registrations
// ")        ->groupBy("created")
// ->get()->keyBy("created");    


    

        $res = collect($res)->keyBy("created");

        $days = self::dateCreation($startDate, $endDate);

        $daysCollection = collect($days);

        $resultTable =[];
        foreach($daysCollection as $day)
        {
            $resultTable[] = ["created"=>$day, "cumulative_registrations"=>$res->has($day) ? $res[$day]->cumulative_registrations : 0];
        }

        

        return json_encode($resultTable);
    }

    public function giveProducts()
    {
        if (AuthController::loggedIn_withAdmin())
        {
            $products = Product::with(["price", "stock", "tags"])->get();

            $filteredProducts = $products->map(function($y)
            {
                return ["id"=>$y["id"],
                    "Tags"=>$y["tags"],
                    "Title"=>$y["Title"], 
                "Description"=>$y["Description"],
                "Price"=>$y["Price"],
            "Stock"=>$y["Stock"]->Stock ?? 0];
            });
    
            $allTags = Tag::all();
            // dd($filteredProducts);
            
            // dd($filteredProducts);
            // $products
            return view("admin.products", ["products"=>$filteredProducts, "tags"=>$allTags]);        }
        else
        {
            // $controller = new HomeController();
            return redirect()->route("home");
        }
    


    }

    // Returns all accounts from a given email in the format listed below
    // id,
    // First Name
    // Last Name
    // Email
    public function findUser()
    {
        $email = request()->input("email") ?? null;
        $res =DB::table("customer_information")
        ->join("restricted_users", "restricted_users.customer_information_id","=","customer_information.id")
        ->where("Email", "LIKE", "$email%")
        ->get(["customer_information.id", "First Name", "Last Name", "Email", "Restricted"]);
        // dd($res);

        return json_encode($res);
    }

    public function giveUserOrders($id)
    {

        $orders = [];

        $user = CustomerInformation::find($id);

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
            $orderProduct = ["price"=>$orderPrice->total_amount, "elements"=>[]];

            foreach ($details as $x)
            {
                // dd(Product::where("id",$x["products_id"])->first());
                 $product = Product::where("id",$x["products_id"])->first();
                 array_push($orderProduct["elements"], $product["Title"]);

            }
            array_push($orders, $orderProduct);


        }

        return json_encode($orders);
    }
}
