<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use function Pest\Laravel\get;

class HomeController extends Controller
{
    //
    public function index()
    {
        $breakingNews = Post::published()
            ->latest() // sorteer op de nieuwste eerst
            ->take(6) // Haal de eerste 6 af
            ->with(['author', 'photo', 'categories']) // laat de auteur, photo en categories zien
            ->get();


        $categories = Category::whereHas('posts')->get();

        return view('frontend.home', compact('breakingNews', 'categories'));
    }
}
