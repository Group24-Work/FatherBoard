<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('forgot-password');
    }
}
