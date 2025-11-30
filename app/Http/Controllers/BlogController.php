<?php

// app/Http/Controllers/BlogController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function showPost1()
    {
        return view('blog.post1');
    }
}
