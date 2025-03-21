<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

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

    public function questionnaire()
    {
    $tags = Tag::all();

    return view("questionnaire", ["tags" => $tags]);
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
}
