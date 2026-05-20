<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Media;
use App\Models\Post;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Component;

class PostEditor extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data = [];
    public ?Post $post = null;

    public function mount($post = null): void
    {
        $this->post = $post;

        if ($post) {
            $this->form->fill([
                'title' => $post->title,
                'category_id' => $post->category_id,
            ]);
        } else {
            $this->form->fill();
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->hiddenLabel()
                    ->placeholder('Tulis Judul Artikel Disini')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1)
                    ->extraInputAttributes(['class' => 'editor-title-input']),
                Select::make('category_id')
                    ->hiddenLabel()
                    ->placeholder('Pilih Kategori')
                    ->options(Category::pluck('name', 'id'))
                    ->native(true)
                    ->columnSpan(1),
                FileUpload::make('thumbnail')
                    ->hiddenLabel()
                    ->image()
                    ->disk('public')
                    ->directory('thumbnails')
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth(400)
                    ->imageResizeTargetHeight(300)
                    ->imageResizeUpscale(false)
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $this->form->validate();

        $data = $this->form->getState();
        $data['slug'] = Str::slug($data['title']);
        $data['status'] = 'draft';

        if (isset($data['thumbnail']) && is_string($data['thumbnail'])) {
            $media = Media::create([
                'file_path' => $data['thumbnail'],
                'file_name' => basename($data['thumbnail']),
                'mime_type' => 'image/jpeg',
            ]);
            $data['media_id'] = $media->id;
        }
        unset($data['thumbnail']);

        if ($this->post) {
            $this->post->update($data);
            session()->flash('success', 'Postingan berhasil diperbarui.');
        } else {
            Post::create($data);
            session()->flash('success', 'Postingan berhasil dibuat.');
        }

        $this->redirect(route('adminweb.posts'), navigate: false);
    }

    public function render()
    {
        return view('livewire.post-editor');
    }
}
