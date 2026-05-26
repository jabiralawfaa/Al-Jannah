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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        }

        $this->form->fill([
            'content' => $post?->content ?? null,
        ]);

        $this->data['title'] = $post?->title ?? '';
        $this->data['category_id'] = $post?->category_id ?? null;
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
                    ->live()
                    ->preventFileAttachmentPathTampering(fn (): bool => $this->post !== null)
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

        $rawContent = $this->data['content'] ?? '';
        if (is_array($rawContent)) {
            $content = app(\Filament\Forms\Components\RichEditor\RichContentRenderer::class, ['content' => $rawContent])->toUnsafeHtml();
        } else {
            $content = (string) $rawContent;
        }

        if ($content) {
            $content = preg_replace_callback(
                '/<a\s+([^>]*data-file-name="([^"]*)"[^>]*)><\/a>/i',
                fn ($m) => '<a ' . $m[1] . '>' . (strlen($m[2]) ? htmlspecialchars($m[2], ENT_QUOTES, 'UTF-8') : 'Download File') . '</a>',
                $content,
            );

            $content = Str::sanitizeHtml($content);
        }

        $baseSlug = Str::slug($this->data['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Post::where('slug', $slug)->when($this->post, fn ($q) => $q->where('id', '!=', $this->post->id))->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $data = [
            'title' => $this->data['title'],
            'slug' => $slug,
            'content' => $content,
            'category_id' => $this->data['category_id'] ?? null,
            'status' => 'draft',
        ];

        if ($this->thumbnail) {
            try {
                $storedName = \App\Services\FileRenamer::rename($this->thumbnail->getClientOriginalName());
                $path = $this->thumbnail->storeAs('thumbnails', $storedName, 'local');

                $fileSize = Storage::disk('local')->size($path);

                $media = Media::create([
                    'file_path' => $path,
                    'file_name' => $this->thumbnail->getClientOriginalName(),
                    'mime_type' => $this->thumbnail->getMimeType(),
                    'file_size' => $fileSize,
                ]);
                $data['media_id'] = $media->id;
            } catch (\Exception $e) {
                Log::warning('Thumbnail upload failed: ' . $e->getMessage());
            }
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
