<div>
    <style>
        .editor-card {
            background: #fff;
            border: 1px solid #d4d4d4;
            border-radius: 12px;
            overflow: hidden;
        }

        .editor-title-input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            background: transparent;
            font-family: 'Poppins', sans-serif;
        }

        .editor-title-input::placeholder {
            color: #b0b0b0;
        }

        .editor-category-select {
            width: 100%;
            padding: 9px 12px 9px 14px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #1a1a1a;
            background: #f8f9fa;
            outline: none;
        }

        .editor-category-select:focus {
            border-color: #16423c;
        }

        .editor-header-card {
            padding: 28px 32px 20px;
            border-bottom: 1px solid #e8e8e8;
        }

        .editor-meta-row {
            display: flex;
            gap: 12px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .editor-meta-input {
            flex: 1;
            min-width: 180px;
        }

        .editor-cover-section {
            padding: 16px 32px;
            border-bottom: 1px solid #e8e8e8;
        }

        .cover-upload {
            border: 2px dashed #d4d4d4;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s;
            position: relative;
            overflow: hidden;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cover-upload:hover {
            border-color: #16423c;
            background: #f7fdfb;
        }

        .cover-upload.has-image {
            border-style: solid;
        }

        .cover-upload img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .cover-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            padding: 24px 20px;
            color: #6b7280;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
        }

        .cover-remove {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(0,0,0,0.55);
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            line-height: 1;
        }

        .cover-remove:hover {
            background: #dc3545;
        }

        .fi-fo-rich-editor {
            border-radius: 0 !important;
            box-shadow: none !important;
        }

        .fi-fo-rich-editor-toolbar {
            background: #16423c !important;
            padding: 6px 8px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2px;
            border-radius: 0 !important;
        }

        .fi-fo-rich-editor-tool {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: transparent !important;
            color: #fff !important;
            outline: none !important;
            outline-offset: 0 !important;
            box-shadow: none !important;
            border: none !important;
            -webkit-tap-highlight-color: transparent;
        }

        .fi-fo-rich-editor-tool:where(:focus, :focus-visible, :active) {
            background: transparent !important;
            color: #fff !important;
            outline: none !important;
            outline-offset: 0 !important;
            box-shadow: none !important;
            border: none !important;
        }

        .fi-fo-rich-editor-tool:hover {
            background: #b45309 !important;
            color: #fff !important;
        }

        .fi-fo-rich-editor-tool.fi-active {
            background: rgba(234, 179, 8, 0.5) !important;
            color: #f59e0b !important;
        }

        .fi-fo-rich-editor-tool svg {
            width: 18px;
            height: 18px;
        }

        .fi-fo-rich-editor-toolbar-group + .fi-fo-rich-editor-toolbar-group {
            border-left: 1px solid rgba(255,255,255,0.15);
            margin-left: 6px;
            padding-left: 6px;
        }

        .fi-fo-rich-editor-content {
            min-height: 480px;
            max-height: 65vh;
            background: #fff;
            padding: 32px;
            font-size: 16px;
            line-height: 1.8;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .fi-fo-rich-editor-content .tiptap.ProseMirror,
        .fi-fo-rich-editor-content .ProseMirror {
            flex: 1;
            min-height: 0;
            outline: none !important;
        }

        .fi-fo-rich-editor-content a {
            color: #2563eb !important;
            text-decoration: underline !important;
            cursor: pointer !important;
        }

        .fi-fo-rich-editor-content a:hover {
            color: #1d4ed8 !important;
        }

        .editor-footer {
            padding: 14px 24px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            border-top: 1px solid #e8e8e8;
        }

        .btn-publish {
            background: #16423c;
            color: #fff;
            padding: 10px 28px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(22,66,60,0.3);
        }

        .btn-publish:hover {
            background: #1e5a50;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(22,66,60,0.35);
        }

        .fi-fo-rich-editor-main {
            border-radius: 0 !important;
        }

        .fi-modal .fi-modal-content {
            padding: 1.5rem !important;
        }

        .fi-modal .fi-modal-header {
            padding: 1.25rem 1.5rem 0 !important;
        }

        .fi-modal .fi-modal-footer {
            padding: 1rem 1.5rem 1.5rem !important;
        }

        .fi-modal .fi-modal-footer .fi-btn {
            padding: 0.625rem 1.25rem !important;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .fi-modal .fi-modal-footer .fi-btn.fi-color-primary {
            background: #16423c !important;
            color: #fff !important;
            border: none !important;
        }

        .fi-modal .fi-modal-footer .fi-btn.fi-color-primary:hover {
            background: #1e5a50 !important;
        }

        .fi-modal .fi-modal-footer .fi-btn:not(.fi-color-primary) {
            background: #fff !important;
            color: #374151 !important;
            border: 1px solid #d1d5db !important;
        }

        .fi-modal .fi-modal-footer .fi-btn:not(.fi-color-primary):hover {
            background: #f9fafb !important;
        }

        .fi-modal .fi-input-wrapper {
            width: 100%;
        }

    </style>

    <div class="editor-card">
        <div class="editor-header-card">
            <input
                type="text"
                wire:model="data.title"
                placeholder="Judul Postingan..."
                autocomplete="off"
                class="editor-title-input"
            >
            <div class="editor-meta-row">
                <div class="editor-meta-input">
                    <select wire:model="data.category_id" class="editor-category-select">
                        <option value="">Pilih kategori...</option>
                        @foreach (\App\Models\Category::orderBy('name')->get() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="editor-cover-section">
            <div
                class="cover-upload {{ $thumbnail || ($post && $post->media) ? 'has-image' : '' }}"
                x-data
                x-on:click="$refs.thumbnailInput.click()"
            >
                @if ($thumbnail)
                    <img src="{{ $thumbnail->temporaryUrl() }}" alt="Preview">
                    <button type="button" class="cover-remove" wire:click="$set('thumbnail', null)" x-on:click.stop>&times;</button>
                @elseif ($post && $post->media)
                    <img src="{{ route('media.download', $post->media) }}" alt="Current thumbnail">
                    <button type="button" class="cover-remove" wire:click="removeThumbnail" x-on:click.stop>&times;</button>
                @else
                    <div class="cover-placeholder">
                        <span>Upload gambar sampul (klik atau seret gambar)</span>
                    </div>
                @endif
                <input type="file" x-ref="thumbnailInput" wire:model="thumbnail" accept="image/*" style="display:none">
            </div>
        </div>

        <div style="width: 100%;">
            {{ $this->form }}
        </div>

        <div class="editor-footer">
            <button type="button" wire:click="save" class="btn-publish">
                {{ $post ? 'Perbarui' : 'Terbitkan' }}
            </button>
        </div>
    </div>

    @if ($this instanceof \Filament\Actions\Contracts\HasActions)
        <x-filament-actions::modals />
    @endif
</div>
