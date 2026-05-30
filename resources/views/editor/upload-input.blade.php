<style>
    .editor-upload-zone {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 32px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        min-height: 160px;
        background: #f9fafb;
    }
    .editor-upload-zone:hover {
        border-color: #16423c;
        background: rgba(22, 66, 60, 0.03);
    }
    .editor-upload-zone.dragover {
        border-color: #16423c;
        background: rgba(22, 66, 60, 0.06);
        transform: scale(1.01);
    }
    .editor-upload-zone-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background: rgba(22, 66, 60, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #16423c;
        transition: transform 0.3s ease;
    }
    .editor-upload-zone:hover .editor-upload-zone-icon {
        transform: translateY(-3px);
    }
    .editor-upload-zone-text {
        text-align: center;
    }
    .editor-upload-zone-text p {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
        margin: 0;
    }
    .editor-upload-zone-text span {
        color: #16423c;
        font-weight: 600;
        text-decoration: underline;
        text-underline-offset: 2px;
    }
    .editor-upload-hint {
        font-size: 12px;
        color: #9ca3af;
    }
    .editor-upload-file-input {
        position: absolute;
        inset: 0;
        cursor: pointer;
        opacity: 0;
    }
    .editor-preview-box {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
    }
    .editor-preview-image-wrap {
        width: 100%;
        height: 170px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: repeating-conic-gradient(#e5e7eb 0% 25%, transparent 0% 50%);
        background-size: 16px 16px;
        overflow: hidden;
    }
    .editor-preview-image-wrap img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .editor-preview-info {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border-top: 1px solid #e5e7eb;
    }
    .editor-preview-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(22, 66, 60, 0.1);
        color: #16423c;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .editor-preview-text {
        flex: 1;
        min-width: 0;
    }
    .editor-preview-name {
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0;
    }
    .editor-preview-size {
        font-size: 11px;
        color: #6b7280;
        margin-top: 2px;
    }
    .editor-preview-status {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .editor-preview-remove {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 8px;
        border: none;
        background: transparent;
        color: #9ca3af;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .editor-preview-remove:hover {
        background: #fef2f2;
        color: #dc2626;
    }

    @keyframes editor-spin {
        to { transform: rotate(360deg); }
    }
    .editor-spinner {
        animation: editor-spin 1s linear infinite;
    }
</style>

<div x-data="{
    isUploading: false,
    uploadSuccess: false,
    uploadError: '',
    fileName: '',
    fileSizeText: '',
    filePreviewUrl: '',
    isDragOver: false,
    altText: '',

    uploadFile(file) {
        if (!file) return;
        this.isUploading = true;
        this.uploadSuccess = false;
        this.uploadError = '';
        this.isDragOver = false;

        const formData = new FormData();
        formData.append('file', file);

        fetch('{{ $route }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(res => { if (!res.ok) throw new Error('HTTP ' + res.status); return res.json(); })
        .then(data => {
            if (data.success) {
                this.fileName = data.file.nama_file;
                this.uploadSuccess = true;
                document.getElementById('fi-uploaded-file-json').value = JSON.stringify(data.file);
                document.getElementById('fi-uploaded-file-json').dispatchEvent(new Event('input', { bubbles: true }));
            } else {
                this.uploadError = 'Upload gagal';
            }
        })
        .catch(err => { this.uploadError = 'Upload error: ' + err.message; })
        .finally(() => { this.isUploading = false; });
    },

    handleFileSelect(event) {
        const file = event.target.files[0];
        if (!file) return;
        this.prepareAndUpload(file);
        event.target.value = '';
    },

    handleDrop(event) {
        event.preventDefault();
        this.isDragOver = false;
        const file = event.dataTransfer.files[0];
        if (!file) return;
        this.prepareAndUpload(file);
    },

    prepareAndUpload(file) {
        this.fileName = file.name;
        this.fileSizeText = this.formatSize(file.size);
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => { this.filePreviewUrl = e.target.result; };
            reader.readAsDataURL(file);
        }
        this.uploadFile(file);
    },

    formatSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(2) + ' MB';
    },

    resetForm() {
        this.fileName = '';
        this.fileSizeText = '';
        this.filePreviewUrl = '';
        this.uploadSuccess = false;
        this.uploadError = '';
        document.getElementById('fi-uploaded-file-json').value = '';
        document.getElementById('fi-uploaded-file-json').dispatchEvent(new Event('input', { bubbles: true }));
    }
}">
    <!-- DROP ZONE -->
    <div x-show="!fileName"
         @dragover.prevent="isDragOver = true"
         @dragenter.prevent="isDragOver = true"
         @dragleave.prevent="isDragOver = false"
         @drop.prevent="handleDrop"
         :class="{ dragover: isDragOver }"
         class="editor-upload-zone">

        <div class="editor-upload-zone-icon">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" />
            </svg>
        </div>

        <div class="editor-upload-zone-text">
            <p>Seret & lepas file di sini</p>
            <p>atau <span>klik untuk memilih file</span></p>
        </div>

        <div class="editor-upload-hint">
            {{ str_contains($accept, 'image/') ? 'PNG, JPG, GIF, WEBP, SVG' : 'Semua format file' }}
        </div>

        <input type="file" accept="{{ $accept }}" @change="handleFileSelect" :disabled="isUploading" class="editor-upload-file-input" />
    </div>

    <!-- PREVIEW -->
    <div x-show="fileName" class="editor-preview-box">
        <div x-show="filePreviewUrl" class="editor-preview-image-wrap">
            <img :src="filePreviewUrl" />
        </div>

        <div class="editor-preview-info">
            <div class="editor-preview-icon">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <div class="editor-preview-text">
                <p class="editor-preview-name" x-text="fileName"></p>
                <p class="editor-preview-size" x-text="fileSizeText"></p>
            </div>
            <div class="editor-preview-status">
                <svg x-show="isUploading && !uploadSuccess && !uploadError" class="editor-spinner" width="18" height="18" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="#16423c" stroke-width="4" />
                    <path class="opacity-75" fill="#16423c" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                </svg>
                <svg x-show="uploadSuccess" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#22c55e" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <svg x-show="uploadError && !isUploading" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <button x-show="!isUploading" @click="resetForm" class="editor-preview-remove">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="uploadError" style="border-top:1px solid #e5e7eb;padding:8px 16px;font-size:13px;color:#dc2626;" x-text="uploadError"></div>
    </div>

    <!-- NAMA FILE -->
    <div x-show="fileName" style="display:flex;flex-direction:column;gap:6px;">
        <label style="font-size:13px;font-weight:600;color:#6b7280;">{{ $isImage ? 'Nama Gambar' : 'Nama File' }}</label>
        <input type="text" x-model="altText" maxlength="80" placeholder="Masukkan {{ $isImage ? 'nama gambar' : 'nama file' }}..."
               @input="document.getElementById('fi-alt-text').value = $el.value; document.getElementById('fi-alt-text').dispatchEvent(new Event('input', {bubbles:true}))"
               style="width:100%;background:#f9fafb;border:1.5px solid #d1d5db;border-radius:10px;padding:11px 14px;font-size:14px;color:#111827;outline:none;transition:border-color 0.2s;"
               @@focus="$el.style.borderColor='#16423c'"
               @@blur="$el.style.borderColor='#d1d5db'" />
    </div>
</div>
