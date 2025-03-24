<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CustomerInformation;
use Illuminate\Support\Facades\DB;
USE App\Models\Product;

class CustomerController extends Controller
{

    private function userOrders($id)
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

        return $orders;
    }
    
    public function giveUserOrders($id)
    {
        return json_encode(self::userOrders($id));
    }

    public function destroy($id)
    {
        $user = CustomerInformation::find($id);

        if ($user->count() >1)
        {
        CustomerInformation::destroy($id);
        }
        else
        {
            return response()->json(['Message'=>"User does not exist"], 400);
  
        }

        return response()->json(['Message'=>"User deleted"], 200);
    }
}
