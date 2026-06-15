<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\PostReaction as PostReactionModel;

class PostReaction extends Component
{
    public Post $post;
    public $likesCount = 0;
    public $dislikesCount = 0;
    public $userReaction = null; // 'like' atau 'dislike' atau null

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadReactions();
    }

    public function loadReactions()
    {
        // Hitung total
        $this->likesCount = PostReactionModel::where('post_id', $this->post->id)->where('type', 'like')->count();
        $this->dislikesCount = PostReactionModel::where('post_id', $this->post->id)->where('type', 'dislike')->count();

        // Cek apakah user ini sudah pernah klik (berdasarkan IP / User ID)
        $reaction = PostReactionModel::where('post_id', $this->post->id)
            ->where(function ($query) {
                $query->where('ip_address', request()->ip());
                if (auth()->check()) {
                    $query->orWhere('user_id', auth()->id());
                }
            })->first();

        if ($reaction) {
            $this->userReaction = $reaction->type;
        }
    }

    public function react($type)
    {
        // Pastikan tipenya hanya 'like' atau 'dislike'
        if (!in_array($type, ['like', 'dislike'])) return;

        // Cari riwayat reaksi user ini
        $reaction = PostReactionModel::where('post_id', $this->post->id)
            ->where(function ($query) {
                $query->where('ip_address', request()->ip());
                if (auth()->check()) {
                    $query->orWhere('user_id', auth()->id());
                }
            })->first();

        if ($reaction) {
            // Jika diklik tombol yang sama, maka batalkan (Toggle Off)
            if ($reaction->type === $type) {
                $reaction->delete();
                $this->userReaction = null;
            } else {
                // Jika ganti pilihan (Awalnya Like jadi Dislike)
                $reaction->update(['type' => $type]);
                $this->userReaction = $type;
            }
        } else {
            // Jika belum pernah bereaksi, buat baru
            PostReactionModel::create([
                'post_id' => $this->post->id,
                'ip_address' => request()->ip(),
                'user_id' => auth()->id(),
                'type' => $type,
            ]);
            $this->userReaction = $type;
        }

        // Refresh angka counter
        $this->loadReactions();
    }

    public function render()
    {
        return view('livewire.post-reaction');
    }
}
