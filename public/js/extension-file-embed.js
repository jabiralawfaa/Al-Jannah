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
            const icon = this.getFileIcon(node.attrs.mimeType);
            return [
                'div',
                mergeAttributes(HTMLAttributes, {
                    'data-type': 'file-embed',
                    'data-file-id': node.attrs.fileId,
                    'data-file-name': node.attrs.fileName,
                    'data-file-url': node.attrs.fileUrl,
                    'data-mime-type': node.attrs.mimeType,
                    class: 'file-embed',
                    contenteditable: 'false',
                }),
                ['div', { class: 'file-embed-icon' }, icon],
                ['div', { class: 'file-embed-name' }, node.attrs.fileName],
            ];
        },

        getFileIcon(mimeType) {
            if (!mimeType) return '📄';
            if (mimeType.includes('pdf')) return '📕';
            if (mimeType.includes('word') || mimeType.includes('document')) return '📘';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return '📗';
            if (mimeType.includes('presentation') || mimeType.includes('powerpoint')) return '📙';
            return '📄';
        },
    });
}
