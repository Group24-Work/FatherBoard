<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function giveAdminHub()
    {
        return view('admin_hub');
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

        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

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

    // Returns all accounts from a given email in the format listed below
    // id,
    // First Name
    // Last Name
    // Email
    public function findUser()
    {
        $email = request()->input("email") ?? null;
        $res =DB::table("customer_information")->where("Email", "LIKE", "$email%")->get(["id", "First Name", "Last Name", "Email"]);
        return json_encode($res);
    }
}
