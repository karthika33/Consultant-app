<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
    {
        return view('index'); // Make sure your index.blade.php exists in resources/views
    }
}
