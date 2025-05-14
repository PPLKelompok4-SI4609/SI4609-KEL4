<?php

namespace App\Events;

namespace App\Events;

use App\Models\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewArticlePublished implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $article;
    public $notifications;

    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->notifications = [
            [
                'title' => 'Artikel baru dipublikasikan: ' . $this->article->title,
                'link' => url('/articles/' . $this->article->id),
            ]
        ];
    }

    public function broadcastOn()
    {
        return new Channel('articles'); // Pastikan channel ini sesuai
    }
}
