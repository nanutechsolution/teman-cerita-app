<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::where('is_published', true)->latest()->get();
        $categories = Category::all();
        $galleries = Gallery::where('is_published', true)->get();

        return response()->view('sitemap', [
            'posts' => $posts,
            'categories' => $categories,
            'galleries' => $galleries,
        ])->header('Content-Type', 'text/xml');
    }
}