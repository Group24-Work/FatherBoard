<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
class HomeController extends Controller
{
    public function giveHome()
    {
        // if (AuthController::loggedIn())
        // {
        //     $product = Product::all();
        //     return view("home",["data"=>$product]);
        // }
        // else
        // {
        //     return redirect("./login");
        // }

        $product = Product::all();
        $topProduct = static::returnTopProduct();
        if ($topProduct==null)
        {
            $topProduct = Product::inRandomOrder()->first();

        }
        return view('home', ['topproduct' => $topProduct]);


    }

    public function topproduct () {
        $topreview = Review::orderby("rating","desc")->first();

        if (!$topreview) {
            return "No reviews found.";
        }

        $topproduct = Product::find($topreview->product_id);
        if(!$topproduct) {

            return "No products or reviews found.";
        }

        return view('home', ['topproduct' => $topproduct]);
        
       

    }


    public function returnTopProduct() {
        $topreview = Review::orderby("rating","desc")->first();

        if (!$topreview) {
            return null;
        }

        $topproduct = Product::find($topreview->product_id);
        if(!$topproduct) {

            return null;
        }
        return $topproduct;
       

    }
}
