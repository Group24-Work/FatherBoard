<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Product;

class QuestionnaireController extends Controller
{
    public function filter(Request $req)
    {
        $tags = $req->input("tags");


        // Acquire all product that has matching tags
        $res = Product
        ::join("product_tag", "products.id","=","product_tag.product_id")
        ->join("tags", "product_tag.tag_id","=","tags.id")
        ->whereIn("Name", $tags)  // Add WHERE Name IN ("Green", "Blue")
        ->groupBy("Name", "products.id")
        ->select("products.id", "Name")
        ->orderBy("products.id")
        ->get(["Name","products.id"])->toArray();


        return json_encode($res);
    }
}
