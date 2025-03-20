<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return json_encode(ContactForm::all());
    }

    public function indexPage()
    {
        $data = ContactForm::all();
        return view("admin.messages",["messages"=>$data]);
    }
    /**
     * Show the form for creating a new resource.
     */

    public function respond(int $id, Request $req)
    {
        $response_message = $req->input("response_message");

        $response_subject = "Fatherboard Answer";
        $pythonScript = base_path('resources/python/generalEmail.py');
        $contact = ContactForm::where("id",$id)->firstOrFail();
        $email = $contact["Email"];

        
    
        $command = "/usr/bin/python3 " . escapeshellarg($pythonScript) . " '" . escapeshellarg($email) . "' " . escapeshellarg($response_subject) . " " . escapeshellarg($response_message);

        $res = shell_exec($command . " 2>&1");

        return response()->json(["Command"=>$command, "Message"=>$res], 200);
    
        // dd($response_message);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->input("Name");
        ContactForm::create(["Name"=>$id]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    
        $acc = ContactForm::find($id);
        return json_encode($acc);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ContactForm::destroy($id);
    }
}
