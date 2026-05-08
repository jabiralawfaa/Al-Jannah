<div class="modal-overlay" id="{{ $id }}">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">{{ $title }}</h3>
            <button class="modal-close" onclick="closeModal('{{ $id }}')">&times;</button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        @if(isset($footer))
            <div class="modal-footer">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.add('active');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('active');
}
</script>
