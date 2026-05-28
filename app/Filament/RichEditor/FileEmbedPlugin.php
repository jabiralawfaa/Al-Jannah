<?php

namespace App\Filament\RichEditor;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Filament\Forms\Components\RichEditor\Plugins\Contracts\RichContentPlugin;
use Tiptap\Core\Extension;

class FileEmbedPlugin implements RichContentPlugin
{
    public function getTipTapPhpExtensions(): array
    {
        return [];
    }

    public function getTipTapJsExtensions(): array
    {
        return [asset('js/extension-file-embed.js')];
    }

    public function getEditorTools(): array
    {
        return [];
    }

    public function getEditorActions(): array
    {
        return [];
    }
}
