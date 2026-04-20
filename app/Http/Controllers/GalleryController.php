<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
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
