export default function () {
    const { Node, mergeAttributes } = window.FilamentRichEditor.tiptap.core;

    return Node.create({
        name: 'fileEmbed',
        group: 'block',
        atom: true,
        draggable: true,

        addAttributes() {
            return {
                fileId: { default: null },
                fileName: { default: '' },
                fileUrl: { default: '' },
                mimeType: { default: '' },
            };
        },

        parseHTML() {
            return [{
                tag: 'div[data-type="file-embed"]',
                getAttrs: (el) => ({
                    fileId: el.getAttribute('data-file-id'),
                    fileName: el.getAttribute('data-file-name'),
                    fileUrl: el.getAttribute('data-file-url'),
                    mimeType: el.getAttribute('data-mime-type'),
                }),
            }];
        },

        renderHTML({ node, HTMLAttributes }) {
            const icon = getFileIcon(node.attrs.mimeType);
            const typeLabel = getFileTypeLabel(node.attrs.mimeType);
            const bgColor = getFileBgColor(node.attrs.mimeType);
            return [
                'div',
                mergeAttributes(HTMLAttributes, {
                    'data-type': 'file-embed',
                    'data-file-id': node.attrs.fileId,
                    'data-file-name': node.attrs.fileName,
                    'data-file-url': node.attrs.fileUrl,
                    'data-mime-type': node.attrs.mimeType,
                    style: 'border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;margin:8px 0;cursor:default;user-select:none;display:flex;align-items:stretch;',
                    contenteditable: 'false',
                }),
                ['div', { style: `display:flex;align-items:center;justify-content:center;width:64px;background:${bgColor};font-size:28px;flex-shrink:0;` }, icon],
                ['div', { style: 'flex:1;padding:12px 16px;min-width:0;background:#fff;' },
                    ['div', { style: 'font-weight:600;font-size:14px;color:#111827;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;' }, node.attrs.fileName],
                    ['div', { style: 'font-size:12px;color:#6b7280;margin-top:2px;' }, typeLabel],
                ],
            ];
        },
    });
}

function getFileIcon(mimeType) {
    if (!mimeType) return '📄';
    if (mimeType.includes('pdf')) return '📕';
    if (mimeType.includes('word') || mimeType.includes('document')) return '📘';
    if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return '📗';
    if (mimeType.includes('presentation') || mimeType.includes('powerpoint')) return '📙';
    return '📄';
}

function getFileTypeLabel(mimeType) {
    if (!mimeType) return 'File';
    if (mimeType.includes('pdf')) return 'PDF Document';
    if (mimeType.includes('word') || mimeType.includes('document')) return 'Word Document';
    if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'Spreadsheet';
    if (mimeType.includes('presentation') || mimeType.includes('powerpoint')) return 'Presentation';
    if (mimeType.includes('zip') || mimeType.includes('rar') || mimeType.includes('compressed')) return 'Archive';
    return 'File';
}

function getFileBgColor(mimeType) {
    if (!mimeType) return '#f3f4f6';
    if (mimeType.includes('pdf')) return '#fef2f2';
    if (mimeType.includes('word') || mimeType.includes('document')) return '#eff6ff';
    if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return '#f0fdf4';
    if (mimeType.includes('presentation') || mimeType.includes('powerpoint')) return '#fefce8';
    return '#f3f4f6';
}
