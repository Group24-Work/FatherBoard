<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function giveAdminHub()
    {
        return view('admin_hub');
    }

    public function giveRevenue()
    {

        // Get the first and last order dates

        $firstOrderDate = DB::table('orders')
            ->selectRaw('MIN(DATE(created_at)) as first_date')
            ->value('first_date');
        
        $lastOrderDate = DB::table('orders')
            ->selectRaw('MAX(DATE(created_at)) as last_date')
            ->value('last_date');
        
        // Compute @h (start of the week) and @max (end of the week)
        $h = DB::selectOne("SELECT DATE_SUB(?, INTERVAL WEEKDAY(?) DAY) as h", [$firstOrderDate, $firstOrderDate])->h;
        $max = DB::selectOne("SELECT DATE_ADD(?, INTERVAL (6 - WEEKDAY(?)) DAY) as max_date", [$lastOrderDate, $lastOrderDate])->max_date;
        
        $val= DB::select("with recursive tan as
(
select ? as dt
union all
select DATE_ADD(dt, INTERVAL 1 DAY)
from tan
where dt < ? 
)

select * from tan
left join (
select 
DATE(orders.created_at) as order_date, SUM(product_prices.price * order_details.quantity) as total_sales
from orders
inner join order_details
ON orders.id = order_details.order_id
inner join products
ON order_details.products_id = products.id
inner join product_prices
ON product_prices.product_id = products.id
GROUP BY DATE(orders.created_at)
) x
on tan.dt = x.order_date

",[$h,$max]);
        // Verify the computed values
        // dump($val); // For debugging
        $coll = collect($val);

        $filtered = $coll->map(function ($x)
        {
            return ["total_sales"=>$x->total_sales ? (int)$x->total_sales : 0, "date"=>$x->dt];
        });

        $format = $filtered->flatten();
        


    return json_encode($filtered);


    }

    public function giveSpecificRevenue($id)
    {
        return $id;
    }
}
