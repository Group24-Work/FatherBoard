<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AuthController;
use App\Models\order_details;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\AddressInformation;
use PhpParser\NodeVisitor\FirstFindingVisitor;
use Symfony\Component\Console\Input\Input;

class CheckoutController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AuthController = new AuthController;//Not sure if this works, attempts to check if the user is logged in.
        if(($user = $AuthController->loggedIn()) == false){
            return view('login');
        }
        $basket=session()->get('basket',[]);

        $basketDetails = [];
        foreach ($basket as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $basketDetails[] = [
                    'product_id' => $product->id,
                    'name' => $product->Title,
                    'price' => $product->Price->price,
                    'quantity' => $item['quantity'],
                ];
            }
        }
        return view('checkout',compact('basketDetails'));
    }
    public function process(Request $request)
    {
        $existingAddress = AddressInformation::where([
            'Address Line' =>$request->input('Address_Line_1'),
            'Country'=>$request->input('Country'),
            'PostCode'=>$request->input('Postcode'),
            'City'=>$request->input('City')
        ])->first();
        if($existingAddress== null){
            $address = AddressInformation::create([
                'Address Line' =>$request->input('Address_Line_1'),
                'Country'=>$request->input('Country'),
                'PostCode'=>$request->input('Postcode'),
                'City'=>$request->input('City')
            ]);
        }
        else
        {
            $address = $existingAddress;
        }
        $basket=session()->get('basket',[]);

            $basketDetails = [];
            foreach ($basket as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $basketDetails[] = [
                        'product_id' => $product->id,
                        'name' => $product->Title,
                        'price' => $product->Price->price,
                        'quantity' => $item['quantity'],
                    ];
                }
            }
            $AuthController = new AuthController;
            if(($user = $AuthController->loggedIn()) == false){//Redirects to login if the user doesn't have an account
                return redirect('/login');
            }
            if ($AuthController->isRestricted($user["id"]))
            {
                return redirect("/restricted");
            }
            $recentOrder = Orders::latest('id')->first();
            $nextOrderNumber = 1;
            if ($recentOrder && !is_null($recentOrder->order_number)) {
                $nextOrderNumber = (int)$recentOrder->order_number + 1;
            }
            $orderNumber = str_pad($nextOrderNumber, 9, '0', STR_PAD_LEFT);
            
            
        $order = Orders::create([
            'customer_id'=> $user['id'],
            'address_id'=>$address['id'],
            'order_status' => 'Pending',
            'order_number' => $orderNumber,
        ]);


        foreach ($basketDetails as $item)
        {
            order_details::create([
                'order_id'=> $order->id,
                'products_id'=>$item['product_id'],
                'quantity'=>$item['quantity'],
            ]);
        }
        session()->forget('basket'); //Removes basket data after checkout finishes(?)

        return redirect()->route('checkout_success', $orderNumber);    }
    public function success($orderNumber)
{  
    return view('checkout_success', ['orderNumber' => $orderNumber]);
}
    
    }    
    
