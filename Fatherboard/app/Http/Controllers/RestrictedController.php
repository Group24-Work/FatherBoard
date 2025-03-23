<?php

namespace App\Http\Controllers;

use App\Models\CustomerInformation;
use Illuminate\Http\Request;

class RestrictedController extends Controller
{
    public function show($id)
    {
        $user = CustomerInformation::findOrFail($id);

        $restricted = $user->first()->restriction()->first()["Restricted"];
        
        return json_encode($restricted);
    }

    public function update($id, Request $req)
    {

        $newValue = $req->input("new_value");
        $user = CustomerInformation::findOrFail($id);

        if (($newValue >= 0) && ($newValue <=1) )
        {
            $restricted = $user->first()->restriction()->first()->updateOrFail(["Restricted"=>$newValue]);

            return response()->json(["Message"=>"Updated the quality"], 200);
        }

        return response()->json(["Message"=>"Failed updating user"], 400);


    }
}
