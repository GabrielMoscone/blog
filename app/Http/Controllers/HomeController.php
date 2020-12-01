<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Category;
use App\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();


        $posts = Post::where('active', true)->orderBy('id', 'DESC')->take(3)->get();

        return view('home', [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
