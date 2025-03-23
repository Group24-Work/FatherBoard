<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Tag;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Product;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tag::all();
        return json_encode($data);
    }

    public function tagPage()
    {
        $data = Tag::all()->map(function($x)
    {
        return ["Name"=>$x->Name, "ID"=>$x->id];
    });


        return view("admin.tags", ["tags"=>$data]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = request()->input("Name");

        if (!Tag::where("Name",$name)->exists())
        {
            Tag::create(["Name"=>$name]);
            return response()->json(['message'=>'Created tag'], 201);
        }
        return response()->json(['message'=>'This name has already been taken'],409);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }


    private static function data_productsFormat($data)
     {
        // dd($data);
         $filtered_details = $data->map(function ($x)
         {
            $rev = Review::where("product_id",operator: $x["id"])->selectRaw(" AVG(rating) as avg_rating")->first()["avg_rating"];

             $image = $x["id"] > 25 ? 1 : $x["id"];
             return ["ID"=>$x["id"],"Title"=>$x["Title"], "Description"=>$x["Description"], "Manufacturer"=>$x["Manufacturer"],"Price"=> $x->price()->first()["price"], "Image"=>$image, "tags"=>$x->tags->pluck('name')->toArray()
             , "avgReview"=>$rev];
         });
         return $filtered_details;
     }


    public function questionnaire()
    {
    $tags = Tag::all();

    return view("questionnaire", ["tags" => $tags]);
    }
public function processQuestionnaire(Request $request){

    // $selectedTags = json_decode($request->input('selected_tags'), true);
    $questionResponses = json_decode($request->input('question_responses'), true);

    // dd($selectedTags);

    // dd($questionResponses);
    //above should grab the tags from a request and store as a json(array)

    $showingAllCategories =[
        'usage'=> false,
        'ram'=> false,
        'storage' =>false
    ];

    

    foreach($questionResponses as $response){
        if(isset($response['isSpecial']) && $response['isSpecial']){
            if(stripos($response['questionText'], 'use your PC for') !== false){
                $showAllCategories['usage']= true;
            } elseif(stripos($response['questionText'], 'RAM do you need') !== false){
                $showAllCategories['ram']=true;
            }elseif(stripos($response['questionText'], 'storage would you like')!==false){
                $showAllCategories['storage'] =true;
            }
        }
    }
    $allTags = [];

    foreach($questionResponses as $response){
        $allTags = array_merge($allTags, $response["selectedTags"]);
        // dd($response["selectedTags"]);

        // if(isset($response['isSpecial']) && $response['isSpecial']){
        //     if(stripos($response['questionText'], 'use your PC for') !== false){
        //         $showAllCategories['usage']= true;
        //     } elseif(stripos($response['questionText'], 'RAM do you need') !== false){
        //         $showAllCategories['ram']=true;
        //     }elseif(stripos($response['questionText'], 'storage would you like')!==false){
        //         $showAllCategories['storage'] =true;
        //     }
        // }
    }
    // dd($allTags);
    $res = Product
    ::join("product_tag", "products.id","=","product_tag.product_id")
    ->join("tags","tags.id","=","product_tag.tag_id")
    ->groupBy("products.id")
    ->select("products.id")
    ->whereIn("tags.Name", $allTags) // Filters only products with these tags
    // ->get(["products.id","tags.Name"])->toArray();
    ->get(["product.id"]);

    $productIds = $res->pluck('id')->toArray();

    $products = Product::whereIn('id', $productIds)->get();

    $productFormat = self::data_productsFormat($products);
    session([
        'questionnaire_results' => $productFormat, 
    ]);
    // return json_encode($res);
// session([
//     'questionnaire_tags'=>$selectedTags,
//     'question_responses'=>$questionResponses,
//     'show_all_categories'=>$showAllCategories
// ]);


    return redirect()->route('questionnaire.results');

    }

    public function showResults()
    {
        $data = session('questionnaire_results', []);
        // dd($data);
        return view("questionnaire_results", ["data"=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name = $request->input("Name");

        // validator::make()
        $tag = Tag::find($id);
        if ($tag)
        {
            $tag->update(["Name"=>$name]);
            return response()->json(['message'=>"Updated successfully"], 200);
        }
        return response()->json(['message'=>"Not updated"], 409);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::destroy($id);
    }

    public function displayResults(){
        $selectedTags = session('questionnaire_tags',[]);
        $questionResponses = session('question_responses',[]);
        $showAllCategories = session('show_all_categories',[]);

        $products = collect();
//use
        if(isset($showAllCategories['usage']) && $showAllCategories['usage']) {
            $usageProducts = \App\Models\Product::whereHas('tags',function($query){
                $query->whereIn('name',['gaming','office','rendering']);
            })->get();

        $products = $products->merge($usageProducts);
        } else{
            $usageTags = array_intersect($selectedTags, ['gaming','office','rendering']);
            if (!empty($usageTags)){
                $usageProducts = \App\Models\Product::whereHas('tags', function($query) use ($usageTags){
                    $query->whereIn('name',$usageTags);

                })->get();
                $products = $products->merge($usageProducts);
            }
        }
//ram
if(isset($showAllCategories['ram']) && $showAllCategories['ram']) {
    $ramProducts = \App\Models\Product::whereHas('tags',function($query){
        $query->whereIn('name',['16GB','32GB','64GB']);
    })->get();

$products = $products->merge($ramProducts);
} else{
    $ramTags = array_intersect($selectedTags, ['16GB','32GB','64GB']);
    if (!empty($ramTags)){
        $ramProducts = \App\Models\Product::whereHas('tags', function($query) use ($ramTags){
            $query->whereIn('name',$ramTags);

        })->get();
        $products = $products->merge($ramProducts);
    }
}
//storage
if(isset($showAllCategories['storage']) && $showAllCategories['storage']) {
    $storageProducts = \App\Models\Product::whereHas('tags',function($query){
        $query->whereIn('name',['gaming','office','rendering']);
    })->get();

$products = $products->merge($storageProducts);
} else{
    $storageTags = array_intersect($selectedTags, ['gaming','office','rendering']);
    if (!empty($storageTags)){
        $storageProducts = \App\Models\Product::whereHas('tags', function($query) use ($storageTags){
            $query->whereIn('name',$storageTags);

        })->get();
        $products = $products->merge($storageProducts);
    }
}
$formattedProducts = $products->map(function($product){
    $rev = Review::where("product_id",$product->id)->selectRaw("AVG(rating) as avg_rating")->first()["avg_rating"] ?? 0;
    $image = $product->id >25 ? 1: $product->id;
    return[
        "ID"=>$product->id,
        "Title"=>$product->Title,
        "Description"=>$product->Description,
        "Manufacturer"=>$product->Manufacturer,
        "Price"=> $product->price()->first()["price"] ?? 0,
        "image" => $image,
        "tags" => $product->tags->pluck('name')->toArray(),
        "avgReview"=>$rev
    ];
});

return view('questionnaire.results',[
    'products' => $products,
    'selectedTags' => $selectedTags,
    'showAllCategories' => $showAllCategories
]);
    }

}
