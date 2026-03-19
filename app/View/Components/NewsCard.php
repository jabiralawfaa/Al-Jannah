<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsCard extends Component
{
    public $image;
    public $tags;
    public $title;
    public $url;

    public function __construct($image = null, $tags = [], $title = 'Judul Berita', $url = '#')
    {
        $this->image = $image ?? 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80';
        $this->tags = $tags;
        $this->title = $title;
        $this->url = $url;
    }

    public function render(): View|Closure|string
    {
        return view('components.news-card');
    }
}
