<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
class HomeController extends Controller
{
    public  function giveHome()
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

        $topProduct = self::returnTopProduct();
        if ($topProduct==null)
        {


            $topProduct = Product::inRandomOrder()->first();

        }
        //return view('home', ['topproduct' => $topProduct]);

        $secondProduct = self::returnSecondProduct();
        if ($secondProduct==null)
        {
            $secondProduct = Product::inRandomOrder()->first();

        }

        $thirdProduct = self::returnThirdProduct();
        if ($thirdProduct==null)
        {
            $thirdProduct = Product::inRandomOrder()->first();

        }


        return view('home', ['topproduct' => $topProduct, 'secondproduct' => $secondProduct, 'thirdproduct' => $thirdProduct]);
        


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

    public function findSecondProduct () {
        $secondreview = Review::orderby("rating","desc")->first();

        if (!$secondreview) {
            return "No reviews found.";
        }

        $secondproduct = Product::find($secondreview->product_id);
        if(!$secondproduct) {

            return "No products or reviews found.";
        }

        return view('home', ['secondproduct' => $secondproduct]);
        
       

    }


    public function returnSecondProduct() {
        $secondreview = Review::orderby("rating","desc")->skip(1)->first();

        if (!$secondreview) {
            return null;
        }

        $secondproduct = Product::find($secondreview->product_id);
        if(!$secondproduct) {

            return null;
        }
        return $secondproduct;
       

    }

    public function findThirdProduct () {
        $thirdreview = Review::orderby("rating","desc")->first();

        if (!$thirdreview) {
            return "No reviews found.";
        }

        $thirdproduct = Product::find($thirdreview->product_id);
        if(!$thirdproduct) {

            return "No products or reviews found.";
        }

        return view('home', ['thirdproduct' => $thirdproduct]);
        
       

    }


    public function returnThirdProduct() {
        $thirdreview = Review::orderby("rating","desc")->skip(2)->first();

        if (!$thirdreview) {
            return null;
        }

        $thirdproduct = Product::find($thirdreview->product_id);
        if(!$thirdproduct) {

            return null;
        }
        return $thirdproduct;
       

    }



}
