<div>
    <input type="hidden" name="{{ $outputName }}" id="hidden_{{ $outputName }}">

    <!-- Cropper Modal -->
    <div class="modal fade" id="cropperModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Image</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center"
                    style="background: white; min-height: 400px;">
                    <img id="imageToCrop" src=""
                        style="max-width: 100%; max-height: 100%; object-fit: contain;" />
                </div>
                <div class="modal-footer justify-content-between flex-wrap">
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-outline-primary" id="zoomIn"><i
                                class="fas fa-search-plus"></i></button>
                        <button class="btn btn-outline-primary" id="zoomOut"><i
                                class="fas fa-search-minus"></i></button>
                        <button class="btn btn-outline-warning" id="rotateLeft"><i
                                class="fas fa-rotate-left"></i></button>
                        <button class="btn btn-outline-warning" id="rotateRight"><i
                                class="fas fa-rotate-right"></i></button>
                        <button class="btn btn-outline-secondary" id="flipHorizontal"><i
                                class="fas fa-arrows-left-right"></i></button>
                        <button class="btn btn-outline-secondary" id="dragMode"><i class="fas fa-hand"></i></button>
                        <button class="btn btn-outline-danger" id="resetCrop"><i class="fas fa-undo"></i></button>
                    </div>
                    <div>
                        <button class="btn btn-success" id="cropBtn">Crop & Save</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" id="cancelBtn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <!-- Bootstrap CDN only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <!-- Internal Package CSS -->
        <link href="{{ asset('vendor/image-cropper/css/cropper.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
        <!-- Bootstrap JS CDN only -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Internal Package JS -->
        <script src="{{ asset('vendor/image-cropper/js/cropper.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let cropper;
                const input = document.getElementById('{{ $inputId }}');
                const modal = new bootstrap.Modal(document.getElementById('cropperModal'));
                const image = document.getElementById('imageToCrop');
                const preview = document.getElementById('{{ $previewId }}');
                const hiddenInput = document.getElementById('hidden_{{ $outputName }}');

                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                    const maxSize = 2 * 1024 * 1024;

                    if (!allowedTypes.includes(file.type)) {
                        alert('Only JPG, PNG, JPEG, WEBP images allowed.');
                        input.value = '';
                        return;
                    }

                    if (file.size > maxSize) {
                        alert('Image must be less than 2MB.');
                        input.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(event) {
                        image.src = event.target.result;
                        modal.show();
                    };
                    reader.readAsDataURL(file);
                });

                document.getElementById('cropperModal').addEventListener('shown.bs.modal', function() {
                    cropper = new Cropper(image, {
                        aspectRatio: {{ $ratio }},
                        viewMode: 1,
                        autoCropArea: 1,
                        responsive: true
                    });
                });

                document.getElementById('cropperModal').addEventListener('hidden.bs.modal', function() {
                    if (cropper) {
                        cropper.destroy();
                        cropper = null;
                    }
                    input.value = '';
                });

                document.getElementById('cropBtn').addEventListener('click', function() {
                    if (cropper) {
                        const canvas = cropper.getCroppedCanvas();
                        const base64 = canvas.toDataURL('image/jpeg');
                        preview.src = base64;
                        hiddenInput.value = base64;
                        modal.hide();
                    }
                });

                document.getElementById('cancelBtn').addEventListener('click', function() {
                    input.value = '';
                    modal.hide();
                });

                document.getElementById('zoomIn').onclick = () => cropper?.zoom(0.1);
                document.getElementById('zoomOut').onclick = () => cropper?.zoom(-0.1);
                document.getElementById('rotateLeft').onclick = () => cropper?.rotate(-45);
                document.getElementById('rotateRight').onclick = () => cropper?.rotate(45);
                document.getElementById('flipHorizontal').onclick = () => {
                    const scaleX = cropper.getData().scaleX || 1;
                    cropper.scaleX(-scaleX);
                };
                document.getElementById('dragMode').onclick = () => cropper.setDragMode('move');
                document.getElementById('resetCrop').onclick = () => cropper.reset();
            });
        </script>
    @endpush
</div>
