<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Tag;
use App\Models\RedactionMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PublicController extends Controller
{
    /**
     * Senior Note: Constructor membagikan data global ke semua view.
     * Ini memastikan Navbar (Kategori) dan Footer selalu terisi data.
     */
    public function __construct()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        $categories = Category::withCount(['episodes' => function ($query) {
            $query->where('is_published', true);
        }])
            ->orderBy('episodes_count', 'desc')
            ->get();

        $popularTags = Tag::withCount('episodes')
            ->orderBy('episodes_count', 'desc')
            ->take(12)
            ->get();

        View::share('settings', $settings);
        View::share('categories', $categories);
        View::share('popularTags', $popularTags);
    }

   /**
 * Menampilkan halaman depan (Home).
 */
public function index()
{
    // Ambil koleksi headline (Maksimal 5 untuk slider)
    $headlines = Episode::with(['category', 'author'])
        ->where('is_published', true)
        ->where('is_headline', true)
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->take(5)
        ->get();

    $breakingNews = Episode::where('is_published', true)
        ->where('is_breaking', true)
        ->latest('published_at')
        ->take(5)
        ->get();

    $trendingNews = Episode::where('is_published', true)
        ->orderBy('views', 'desc')
        ->take(5)
        ->get();

    // Ambil berita terbaru, kecualikan berita yang sudah masuk di slider headline
    $latestEpisodes = Episode::with(['category', 'author'])
        ->where('is_published', true)
        ->where('published_at', '<=', now())
        ->when($headlines->isNotEmpty(), function($q) use ($headlines) {
            return $q->whereNotIn('id', $headlines->pluck('id'));
        })
        ->latest('published_at')
        ->take(12)
        ->get();

    $partners = Partner::where('is_active', true)->orderBy('sort_order')->get();

    // Pastikan variabel dikirim sebagai 'headlines' (jamak) sesuai kode di blade
    return view('welcome', compact('headlines', 'breakingNews', 'latestEpisodes', 'trendingNews', 'partners'));
}

    /**
     * Menampilkan detail Berita / Episode.
     */
    public function show($slug)
    {
        $episode = Episode::with(['category', 'speakers', 'tags', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $episode->increment('views');

        // Deteksi platform video untuk embed otomatis
        $videoData = $this->detectVideoPlatform($episode->link);

        $relatedEpisodes = Episode::where('category_id', $episode->category_id)
            ->where('id', '!=', $episode->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('episodes.show', compact('episode', 'relatedEpisodes', 'videoData'));
    }

    /**
     * Fitur Indeks Berita: Mencari berita berdasarkan tanggal tertentu.
     */
    public function indeks(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));

        $episodes = Episode::with(['category', 'author'])
            ->whereDate('published_at', $date)
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(20);

        return view('pages.indeks', compact('episodes', 'date'));
    }

    /**
     * Menangani arsip kategori.
     */
    public function category(Category $category)
    {
        $episodes = Episode::with(['category', 'author'])
            ->where('category_id', $category->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(12);

        return view('category.show', compact('category', 'episodes'));
    }

    /**
     * Menangani arsip tagar.
     */
    public function tag(Tag $tag)
    {
        $episodes = $tag->episodes()
            ->with(['category', 'author'])
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(12);

        return view('tag.show', compact('tag', 'episodes'));
    }

    /**
     * Halaman Pencarian.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $episodes = Episode::with(['category', 'author'])
            ->where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        // Tulis 'query' sebagai string, bukan $query
        return view('search', compact('episodes', 'query'));
    }

    /**
     * Halaman Dinamis & Informasi Publik.
     */
    public function redaksi()
    {
        $members = RedactionMember::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('group');
        return view('pages.redaksi', compact('members'));
    }

    public function pedoman()
    {
        return view('pages.pedoman');
    }
    public function tentang()
    {
        return view('pages.tentang');
    }
    public function kontak()
    {
        return view('pages.kontak');
    }
    public function karir()
    {
        return view('pages.karir');
    }

    /**
     * Fitur Tambahan Senior: Citizen Journalism & Legal
     */
    public function suaraWarga()
    {
        return view('pages.suara-warga');
    }
    public function disclaimer()
    {
        return view('pages.disclaimer');
    }
    public function iklan()
    {
        return view('pages.iklan');
    }

    /**
     * Helper: Deteksi Platform Video.
     */
    private function detectVideoPlatform($videoLink)
    {
        if (!$videoLink) return null;
        $videoData = ['id' => null, 'platform' => 'youtube'];
        if (str_contains($videoLink, 'youtube.com/shorts/')) {
            $parts = explode('/shorts/', $videoLink);
            $videoData['id'] = explode('?', $parts[1] ?? '')[0];
        } elseif (str_contains($videoLink, 'v=')) {
            parse_str(parse_url($videoLink, PHP_URL_QUERY), $query);
            $videoData['id'] = $query['v'] ?? null;
        } elseif (str_contains($videoLink, 'youtu.be/')) {
            $videoData['id'] = substr(parse_url($videoLink, PHP_URL_PATH), 1);
        }
        return $videoData;
    }
}
