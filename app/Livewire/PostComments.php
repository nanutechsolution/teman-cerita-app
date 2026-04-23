<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\User;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class PostComments extends Component
{
    use WithRateLimiting;
    public $post;
    public $name, $email, $body; // Tambahkan $email di sini

    protected $rules = [
        'name'  => 'required|min:3|max:50',
        'email' => 'required|email', // Validasi format email
        'body'  => 'required|min:5',
    ];

    public function save()
    {
        $this->rateLimit(2);
        $this->validate();

        $this->post->comments()->create([
            'name'  => strip_tags($this->name),
            'email' => filter_var($this->email, FILTER_SANITIZE_EMAIL),
            'body'  => strip_tags($this->body),
            'is_approved' => false, // Set false agar tidak langsung tampil (Moderasi)
        ]);

        $this->reset(['name', 'email', 'body']);
        $admins = User::all();

        Notification::make()
            ->title('Komentar Baru!')
            ->icon('heroicon-o-chat-bubble-left-right')
            ->body("{$this->name} mengomentari berita: {$this->post->title}")
            ->actions([
                Action::make('view')
                    ->label('Lihat Komentar')
                    ->url(fn() => "/admin/comments"),
                Action::make('markAsRead')
                    ->label('Tandai Dibaca')
                    ->color('gray')
                    ->markAsRead(),
            ])
            ->sendToDatabase($admins);

        $this->reset(['name', 'email', 'body']);
        session()->flash('message', 'Komentar terkirim dan menunggu moderasi.');
    }

    public function render()
    {
        return view('livewire.post-comments', [
            'comments' => $this->post->comments()->where('is_approved', true)->latest()->get()
        ]);
    }
}
