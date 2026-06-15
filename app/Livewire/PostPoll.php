<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\RateLimiter;

class PostPoll extends Component
{
    public Post $post;
    public $selectedOption;
    public $hasVoted = false;
    public $totalVotes = 0;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->checkIfVoted();
        $this->calculateTotalVotes();
    }

    public function checkIfVoted()
    {
        if (!$this->post->poll) return;

        // 1. Cek dari Cookie (Mengatasi masalah IP WiFi bersama / kantor)
        $cookieName = 'voted_poll_' . $this->post->poll->id;
        if (request()->cookie($cookieName)) {
            $this->hasVoted = true;
            return;
        }

        // 2. Cek dari Database (IP & User)
        $this->hasVoted = PollVote::where('poll_id', $this->post->poll->id)
            ->where(function ($query) {
                $query->where('ip_address', request()->ip());
                if (auth()->check()) {
                    $query->orWhere('user_id', auth()->id());
                }
            })->exists();
    }

    public function calculateTotalVotes()
    {
        if ($this->post->poll) {
            $this->totalVotes = $this->post->poll->options->sum('votes_count');
        }
    }

    public function vote()
    {
        // Cegah eksekusi jika sudah vote atau poll tidak ada
        if ($this->hasVoted || !$this->post->poll) return;

        $this->validate([
            'selectedOption' => 'required'
        ]);

        // PROTEKSI 1: Rate Limiting (Mencegah Bot Spam dari IP yang sama)
        // Maksimal 1 request per menit per IP untuk poll ini
        $throttleKey = 'vote_poll_' . $this->post->poll->id . '_' . request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 1)) {
            $this->addError('vote', 'Terlalu banyak permintaan. Sistem mendeteksi spam.');
            return;
        }
        RateLimiter::hit($throttleKey, 60);

        try {
            // PROTEKSI 2: Database Transaction (Mencegah data cacat / Race Condition)
            DB::transaction(function () {

                // Ambil opsi dengan Lock untuk mencegah modifikasi berbarengan
                $option = PollOption::where('poll_id', $this->post->poll->id)
                    ->lockForUpdate() // Mengunci baris ini di DB sementara waktu
                    ->findOrFail($this->selectedOption);

                // Double Check di dalam transaksi DB
                $alreadyVoted = PollVote::where('poll_id', $this->post->poll->id)
                    ->where(function ($query) {
                        $query->where('ip_address', request()->ip());
                        if (auth()->check()) {
                            $query->orWhere('user_id', auth()->id());
                        }
                    })->exists();

                if ($alreadyVoted) {
                    return false; // Batalkan transaksi secara diam-diam
                }

                // Simpan Riwayat
                PollVote::create([
                    'poll_id' => $this->post->poll->id,
                    'poll_option_id' => $option->id,
                    'ip_address' => request()->ip(),
                    'user_id' => auth()->id(),
                ]);

                // Tambah Counter
                $option->increment('votes_count');
            });

            // PROTEKSI 3: Tanamkan Cookie di Browser pengguna (Berlaku 1 Tahun)
            $cookieName = 'voted_poll_' . $this->post->poll->id;
            Cookie::queue($cookieName, true, 525600);

            // Update UI
            $this->hasVoted = true;
            $this->post->load('poll.options');
            $this->calculateTotalVotes();
        } catch (\Exception $e) {
            // Jika ada yang error (seperti koneksi DB terputus), tampilkan pesan
            $this->addError('vote', 'Terjadi kesalahan sistem, suara gagal direkam.');
            // \Log::error('Poll Vote Error: ' . $e->getMessage()); // Opsional untuk log
        }
    }

    public function render()
    {
        return view('livewire.post-poll');
    }
}
