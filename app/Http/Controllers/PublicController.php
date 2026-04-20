<?php

namespace App\Http\Controllers;

use App\Models\AdPackage;
use App\Models\Post; // Menggunakan Post alih-alih Episode
use App\Models\Partner;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Contact;
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

    /**
     * Menampilkan halaman depan (Home).
     */
    public function index()
    {
        $focusCategorySlug = \App\Models\Setting::where('key', 'home_focus_category')->value('value') ?? 'peristiwa';
        // 2. Cari kategorinya
        $focusCategory = \App\Models\Category::where('slug', $focusCategorySlug)->first();
        $focusPosts = collect();
        // 3. Ambil beritanya
        if ($focusCategory) {
            $focusPosts = Post::with(['category', 'author'])
                ->where('category_id', $focusCategory->id)
                ->where('is_published', true)
                ->where('published_at', '<=', now())
                ->latest('published_at')
                ->take(5)
                ->get();
        }
        // Ambil koleksi headline (Maksimal 5 untuk slider)
        $headlines = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->where('is_headline', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(5)
            ->get();

        $breakingNews = Post::where('is_published', true)
            ->where('is_breaking', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        $trendingNews = Post::where('is_published', true)
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // Ambil berita terbaru, kecualikan berita yang sudah masuk di slider headline
        $latestPosts = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->when($headlines->isNotEmpty(), function ($q) use ($headlines) {
                return $q->whereNotIn('id', $headlines->pluck('id'));
            })
            ->latest('published_at')
            ->take(12)
            ->get();

        $partners = Partner::where('is_active', true)->orderBy('sort_order')->get();

        // Mengganti latestEpisodes menjadi latestPosts
        return view('welcome', compact('headlines', 'breakingNews', 'latestPosts', 'trendingNews', 'partners', 'focusPosts', 'focusCategory'));
    }

    /**
     * Menampilkan detail Berita / Post.
     */
    public function show($slug)
    {
        $post = Post::with(['category', 'speakers', 'tags', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Catatan Senior: Untuk ke depannya saat trafik tinggi, pindahkan increment ini menggunakan Redis + Job/Scheduler
        $post->increment('views');

        // Deteksi platform video untuk embed otomatis
        $videoData = $this->detectVideoPlatform($post->link);

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->take(4)
            ->get();

        // Mengarahkan view ke folder posts/
        return view('episodes.show', compact('post', 'relatedPosts', 'videoData'));
    }

    /**
     * Fitur Indeks Berita: Mencari berita berdasarkan tanggal tertentu.
     */
    public function indeks(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));

        $posts = Post::with(['category', 'author'])
            ->whereDate('published_at', $date)
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(20);

        return view('pages.indeks', compact('posts', 'date'));
    }

    /**
     * Menangani arsip kategori.
     */
    public function category(Category $category)
    {
        $posts = Post::with(['category', 'author'])
            ->where('category_id', $category->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(12);

        return view('category.show', compact('category', 'posts'));
    }

    /**
     * Menangani arsip tagar.
     */
    public function tag(Tag $tag)
    {
        $posts = $tag->posts()
            ->with(['category', 'author'])
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(12);

        return view('tag.show', compact('tag', 'posts'));
    }

    /**
     * Halaman Pencarian.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $posts = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('search', compact('posts', 'query'));
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
        $careers = \App\Models\Career::where('is_active', true)->orderBy('sort_order')->get();
        return view('pages.karir', compact('careers'));
    }

    public function page($slug)
    {
        $page = \App\Models\Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.show', compact('page'));
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
        $adPackages = AdPackage::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();
        return view('pages.disclaimer', compact('adPackages'));
    }
    public function iklan()
    {
        $adPackages = AdPackage::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.iklan', compact('adPackages'));
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


    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Simpan ke database atau kirim email
        Contact::create($validated);

        return redirect()->route('kontak')->with('success', 'Pesan Anda telah terkirim. Terima kasih!');
    }
    public function categoriesIndex()
    {
        $categories = Category::withCount(['posts' => function ($query) {
            $query->where('is_published', true);
        }])->get();

        return view('pages.categories-index', compact('categories'));
    }
}
