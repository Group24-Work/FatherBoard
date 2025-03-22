<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Utility\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
class ProductController extends Controller
{





     private static function data_productsFormat($data)
     {
         $filtered_details = $data->map(function ($x)
         {
            $rev = Review::where("product_id",operator: $x["id"])->selectRaw(" AVG(rating) as avg_rating")->first()["avg_rating"];

             $image = $x["id"] > 25 ? 1 : $x["id"];
             return ["ID"=>$x["id"],"Title"=>$x["Title"], "Description"=>$x["Description"], "Manufacturer"=>$x["Manufacturer"],"Price"=> $x->price()->first()["price"], "Image"=>$image, "tags"=>$x->tags->pluck('name')->toArray()
             , "avgReview"=>$rev];
         });
         return $filtered_details;
     }

     public function giveAllProductType()
     {
         return Product::all()->pluck("Type")->unique();
     }


    public function index(Request $rq)
    {
        $search = request("search");
        $prices = request("prices");


        // category filtering
        $category = explode(',', $rq->query('category', ''));
        $filteredCat = [];

        // $validTypes = Product::distinct()->pluck('type');

        // foreach ($category as $x)
        // {
        //     if ($validTypes->contains(strtoupper($x)))
        //     {
        //         array_push($filteredCat,$x);
        //     }
        // }
        // dd($filteredCat);

        $originalProd = Product::with('tags')->whereRaw("1=1");

        $validCategories = Product::distinct()->pluck('type')->map(fn ($x) => strtolower($x))->toArray();

        foreach ($category as $cat)
        {
            if (in_array(strtolower($cat),$validCategories))
            {
                array_push($filteredCat, $cat);
            };
        }

        $category_obj = $originalProd->where(function($query) use ($category, $filteredCat) {
            foreach ($filteredCat as $x) {
                $query->orWhere("type", $x);
            }
        });
        //questionnaire
        $selectedTags = $rq->input('tags',[]);
        if (!empty($selectedTags)){
            $originalProd = $originalProd->whereHas('tags', function($q) use ($selectedTags){
                $q->whereIn('name',$selectedTags);
            });
        }
        // dd($category_obj->get());

        // Price Filtering
        $priceM = Product::whereRaw("1=1");
        if (strlen($prices) > 0)
        {
        $prices = explode(',', $rq->query("prices", ''));



        foreach ($prices as $pri) {
        $priceM = $priceM->orWhereHas("price", function($q) use ($pri)
        {


            $reg = "/(<=|>=)(\d+)(?:-(<=|>=)(\d+))?/";
            $matches = [];
            $curData = [];
            preg_match($reg, $pri, $matches);
            // dd($matches);

                // $x->price$matches[1],$matches[2])->get()

            if (count($matches)==5)
            {
                for($i =1; $i<3;$i++)
                {


                    $q->where("price",$matches[$i*2-1],$matches[$i*2]);
                }
            }
            else if ((count($matches) == 3))
            {

                $q->where("price",$matches[1],$matches[2]);

            }
            else
            {
                // $q->where("price",">=","1000");
            }

            }
            );


        }

    }
    else
        {
            $priceM = Product::whereRaw("1=1");
        }

    $all = $category_obj->get()->intersect($priceM->get());

    if ($search == null) {
        $send_data = ProductController::data_productsFormat($all);
        return view("products", ["data" => $send_data]);


    } else {
        $queryString = sprintf("Title REGEXP '.*%s.*'", $search);
        // $data = Product::whereRaw($queryString)->get();
        // $subQ = Product::fromSub($all, "sub")->whereRaw($queryString);
        $subQ = $all->intersect(Product::whereRaw($queryString)->get());
        // dd($subQ->ddRawSql());
        $send_data = ProductController::data_productsFormat($subQ);

        return view("products", ["data" => $send_data]);
    }


    }



    // Filter by interesection of category, price and search
    public static function indexSpecific(Request $rq)
    {
        $user_cat = $rq->input("category");
        $user_price = $rq->input("price");

        $search = $rq->input("params");



        $curData = Product::whereRaw("1=0");
        // if ((count($user_cat) == 0) && (count($user_price) ==0))
        // {
        //     return json_encode(Product::query()->get());

        // };
        if (count($user_price) > 0)
        {
        foreach($user_price as $cond)
        {


            $curData = $curData->orWhereHas("price",function ($q) use ($cond) {
                foreach($cond as $x)
                {
                $exp = explode(" ",$x );

                if (count($exp) > 1)
                {
                $q->where("price", $exp[0], $exp[1]);
                }

                else
                {
                    $q->where("price",">=",$exp[0]);
                }


                };
                });
            }
        }
        else
        {
            $curData = Product::whereRaw("1=1");

        }

        $query2 = Product::whereRaw("1=1");
        if (count($user_cat) == 0)
        {
        // $query2 = Product::where("Type",$user_cat);
        }
        else if (count($user_cat) >=1)
        {
            $query2 = Product::where(function ($x) use ($user_cat){

                foreach ($user_cat as $category)
                {
                    $x->orWhere("Type","=",$category);
                };
            });

        }
        // $combinedQuery = $curData->union($query2);

        $intersect_combined = $curData->get()->intersect($query2->get());

        $queryString = sprintf("description REGEXP '.*%s.*'", $search);
        $data = Product::whereRaw($queryString);


        // $finalQuery = Product::fromSub($combinedQuery, 'sub')->whereRaw("description REGEXP ?", [".*{$search}.*"]);

        $intersect_final = $intersect_combined->intersect($data->get());


        // Formatting data
        $send_data = ProductController::data_productsFormat($intersect_final);

        return json_encode($send_data);

    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('product',["product"=>$product]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view ('request', ["request"=>$request]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        $curRating = DB::table("reviews")->where("product_id",$id)->select(DB::raw("avg(rating) as avg_rating"))->first();
        $image = "rtx2070.png";
        $amountStar = Utility::numberClosest($curRating->avg_rating, [1,2,3,4,5]);
        if ($id <=25)
        {
            $image = $id . ".jpg";
        }
        else
        {
            $image = "rtx2070.png";

        }
        return view('product',["product"=>$product,"image"=>$image, "rating"=>$curRating->avg_rating, "amount"=>$amountStar]);
    }

    // Changes stock of a given item to any number
    public function changeStock(int $id, Request $rq)
    {
        $newStock = $rq->input("new_stock");

        if ($newStock > 0)
        {
            Product::find($id)->stock->Stock = $newStock;
        }
    }
    private function p_giveTags(int $id)
    {
        return Product::find($id)->tags()->get();
    }

    public function giveTags(int $id)
    {
        return json_encode($this->p_giveTags($id)->pluck("Name"));
    }

    public function addTag(int $id, Request $req)
    {
        $tagID = $req->input(key: "tag_id");
        $product = Product::find($id);
        $product->load('tags');
        DB::enableQueryLog();
        $product->tags()->syncWithoutDetaching($tagID);
        dd(DB::getQueryLog());
        // return json_encode(Product::find($id));
    }

    public function removeTag(int $id, Request $req)
    {
        $tagID = $req->input(key: "tag_id");
        $product = Product::find($id);
        $product->load('tags');
        DB::enableQueryLog();
        $product->tags()->detach($tagID);
        // dd(DB::getQueryLog());
    }
    /**
     * Show the form for editing the specified resource.
     */

    public function updateStock(int $id, Request $req)
    {
        $newStock = $req->input("new_stock");
        Product::find($id)->stock()->first()->update(["Stock"=>$newStock]);
    }
    public function edit(Product $product)
    {
        return view('product', ["product"=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        return view('product', ["reqest"=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return view('product', ["product"=>$product]);
    }
}
