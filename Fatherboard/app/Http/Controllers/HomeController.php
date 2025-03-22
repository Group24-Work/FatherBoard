<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
class HomeController extends Controller
{
    public static function giveHome()
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
        return view("home",["data"=>$product]);
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
}
