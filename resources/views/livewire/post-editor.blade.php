<div>
    <style>
        .editor-title-input {
            width: 100%;
            padding: 14px 18px;
            background-color: #fff;
            border: 2px solid #d9d9d9;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
            color: #000;
            outline: none;
            transition: border-color 0.2s;
        }

        .editor-title-input:focus {
            border-color: #16423c;
            box-shadow: 0 0 0 3px rgba(22, 66, 60, 0.1);
        }

        .fi-fo-select-native select.fi-select-input {
            width: 100%;
            padding: 14px 18px;
            background-color: #fff;
            border: 2px solid #d9d9d9;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            color: #2b2b2b;
            outline: none;
            transition: border-color 0.2s;
        }

        .fi-fo-select-native select.fi-select-input:focus {
            border-color: #16423c;
            box-shadow: 0 0 0 3px rgba(22, 66, 60, 0.1);
        }

        .fi-fo-file-upload {
            border: 2px dashed #d9d9d9;
            border-radius: 12px;
            padding: 24px;
            background: #fafafa;
            margin-top: 8px;
        }

        .editor-actions {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            justify-content: flex-end;
        }

        .btn-save {
            background-color: #16423c;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 32px;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
        }

        .btn-save:hover {
            background-color: #1d554d;
        }

        .fi-sc-form {
            width: 100%;
        }
    </style>

    <div style="width: 100%;">
        {{ $this->form }}
    </div>

    <div class="editor-actions">
        <button type="button" wire:click="save" class="btn-save">
            {{ $post ? 'Perbarui' : 'Terbitkan' }}
        </button>
    </div>
</div>
