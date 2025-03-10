<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function giveAdminHub()
    {
        return view('admin_hub');
    }
}
