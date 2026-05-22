<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Media;
use App\Models\Post;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostEditor extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;
    use WithFileUploads;

    public array $data = [];
    public ?Post $post = null;
    public $thumbnail = null;

    protected function rules()
    {
        return [
            'data.title' => 'required|string|max:255',
            'data.category_id' => 'nullable|exists:categories,id',
            'data.content' => 'required|string',
            'thumbnail' => 'nullable|image|max:10240',
        ];
    }

    public function mount($post = null): void
    {
        $this->post = $post;

        if ($post) {
            $this->post->load('media');
            $this->form->fill([
                'content' => $post->content,
            ]);
            $this->data['title'] = $post->title;
            $this->data['category_id'] = $post->category_id;
        }
    }

    public function removeThumbnail()
    {
        $this->thumbnail = null;
        if ($this->post && $this->post->media) {
            $this->data['media_id'] = null;
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                RichEditor::make('content')
                    ->hiddenLabel()
                    ->required()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link', 'h2', 'h3', 'h4', 'alignStart', 'alignCenter', 'alignEnd', 'blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                        ['pickImage', 'pickFile', 'table', 'tableAddColumnBefore', 'tableAddColumnAfter', 'tableDeleteColumn', 'tableAddRowBefore', 'tableAddRowAfter', 'tableDeleteRow', 'tableMergeCells', 'tableSplitCell', 'tableToggleHeaderRow', 'tableToggleHeaderCell', 'tableDelete'],
                        ['undo', 'redo'],
                    ])
                    ->floatingToolbars([]),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $this->validate();

        $data = $this->data;
        $data['slug'] = Str::slug($data['title']);
        $data['status'] = 'draft';

        if ($this->thumbnail) {
            $storedName = \App\Services\FileRenamer::rename($this->thumbnail->getClientOriginalName());
            $path = $this->thumbnail->storeAs('thumbnails', $storedName, 'public');
            $media = Media::create([
                'file_path' => $path,
                'file_name' => $this->thumbnail->getClientOriginalName(),
                'mime_type' => $this->thumbnail->getMimeType(),
            ]);
            $data['media_id'] = $media->id;
        } elseif (!isset($data['media_id'])) {
            $data['media_id'] = null;
        }

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
