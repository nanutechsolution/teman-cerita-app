<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Setting;
use App\Models\Tag;
use Filament\Schemas\Components\View;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Senior Note: Constructor membagikan data global ke semua view.
     * Ini memastikan Navbar (Kategori) dan Footer selalu terisi data.
     */
    public function __construct()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        // Mengubah relasi episodes menjadi posts
        $categories = Category::withCount(['posts' => function ($query) {}])
            ->get();

        // Mengubah relasi episodes menjadi posts
        $popularTags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(12)
            ->get();

        View::share('settings', $settings);
        View::share('categories', $categories);
        View::share('popularTags', $popularTags);
    }
    public function index()
    {
        $galleries = Gallery::withCount('images')
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(12); // Menampilkan 12 album per halaman

        return view('galleries.index', compact('galleries'));
    }

    public function show($slug)
    {
        $gallery = Gallery::with(['images' => function ($q) {
            $q->orderBy('sort_order', 'asc');
        }])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('galleries.show', compact('gallery'));
    }
}
