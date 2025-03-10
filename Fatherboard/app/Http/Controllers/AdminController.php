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

        while ($dateDay < $endDate)
        {
            array_push($dates, $dateDay->toDateString());
            $dateDay->addDay();
        }
        return $dates;

    }
    public function giveOrders()
    {
        $days = self::dateCreation(now()->format("Y-m-d"), "2025-04-25");

        // dd($days);

        $resByDate = DB::table("orders")
    ->join("order_details", "orders.id", "=", "order_details.order_id")
    ->selectRaw("DATE(order_details.created_at) as cDate, SUM(quantity) as total_quantity")
    ->groupBy("cDate")
    ->get();

        $resTotal = DB::table("orders")
        ->join("order_details", "orders.id", "=", "order_details.order_id")
        ->selectRaw(" SUM(quantity) as total_quantity")
        ->get();


dd($resTotal);
    }
}
