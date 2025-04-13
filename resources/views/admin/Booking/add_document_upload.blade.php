@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')

<main>
    <div class="container-fluid px-4">
        <div class="container mt-4">
            <h5>Upload Documents for Booking #{{ $booking->booking_id }}</h5>
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <p class="mb-4">Number of Guests: {{ $booking->total_on_guest }}</p>

                    <form action="{{ route('add_document_upload_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                        @for($i = 0; $i < $booking->total_on_guest; $i++)
                        <div class="guest-document mb-4 p-3 border rounded">
                            <h5>Guest {{ $i+1 }}</h5>

                            <div class="form-group">
                                <label>Guest Name</label>
                                <input type="text" name="guest_names[]" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Document Type</label>
                                <select name="document_types[]" class="form-control" required>
                                    @foreach(App\Models\Document::DOCUMENT_TYPES as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Front Side (Required)</label>
                                        
                                        <div class="upload-options mb-2">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary active upload-file-btn" data-guest="{{ $i }}" data-side="front">
                                                    <i class="fas fa-upload"></i> Upload
                                                </button>
                                                <button type="button" class="btn btn-outline-primary use-camera-btn" data-guest="{{ $i }}" data-side="front">
                                                    <i class="fas fa-camera"></i> Camera
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <input type="file" name="front_files[]" class="form-control-file file-input front-file-input" data-guest="{{ $i }}" required style="display: none;">
                                        <input type="hidden" name="front_crop_data[]" class="crop-data" data-guest="{{ $i }}" data-side="front">
                                        <input type="hidden" name="front_compress[]" value="0" class="compress-input" data-guest="{{ $i }}" data-side="front">
                                        
                                        <div class="camera-preview mt-2" id="front-camera-preview-{{ $i }}" style="display: none;">
                                            <video class="camera-video" autoplay playsinline style="max-width: 100%; background: #000;"></video>
                                            <div class="camera-controls mt-2">
                                                <button type="button" class="btn btn-sm btn-primary capture-btn" data-guest="{{ $i }}" data-side="front">Capture</button>
                                                <button type="button" class="btn btn-sm btn-danger stop-camera-btn" data-guest="{{ $i }}" data-side="front">Stop</button>
                                            </div>
                                            <canvas class="camera-canvas" style="display: none;"></canvas>
                                        </div>
                                        
                                        <div class="image-preview mt-2">
                                            <img id="front-preview-{{ $i }}" src="#" alt="Front side preview" class="img-thumbnail preview-image" style="display: none; max-height: 200px;">
                                            <div class="image-options mt-2" style="display: none;">
                                                <button type="button" class="btn btn-sm btn-outline-primary crop-btn" data-guest="{{ $i }}" data-side="front">
                                                    <i class="fas fa-crop"></i> Crop
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary compress-btn" data-guest="{{ $i }}" data-side="front">
                                                    <i class="fas fa-compress-alt"></i> Compress
                                                </button>
                                            </div>
                                            <div class="cropper-container mt-2" style="display: none;">
                                                <button type="button" class="btn btn-sm btn-info apply-crop-btn" data-guest="{{ $i }}" data-side="front">Apply Crop</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Back Side (Optional)</label>
                                        
                                        <div class="upload-options mb-2">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary active upload-file-btn" data-guest="{{ $i }}" data-side="back">
                                                    <i class="fas fa-upload"></i> Upload
                                                </button>
                                                <button type="button" class="btn btn-outline-primary use-camera-btn" data-guest="{{ $i }}" data-side="back">
                                                    <i class="fas fa-camera"></i> Camera
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <input type="file" name="back_files[]" class="form-control-file file-input back-file-input" data-guest="{{ $i }}" style="display: none;">
                                        <input type="hidden" name="back_crop_data[]" class="crop-data" data-guest="{{ $i }}" data-side="back">
                                        <input type="hidden" name="back_compress[]" value="0" class="compress-input" data-guest="{{ $i }}" data-side="back">
                                        
                                        <div class="camera-preview mt-2" id="back-camera-preview-{{ $i }}" style="display: none;">
                                            <video class="camera-video" autoplay playsinline style="max-width: 100%; background: #000;"></video>
                                            <div class="camera-controls mt-2">
                                                <button type="button" class="btn btn-sm btn-primary capture-btn" data-guest="{{ $i }}" data-side="back">Capture</button>
                                                <button type="button" class="btn btn-sm btn-danger stop-camera-btn" data-guest="{{ $i }}" data-side="back">Stop</button>
                                            </div>
                                            <canvas class="camera-canvas" style="display: none;"></canvas>
                                        </div>
                                        
                                        <div class="image-preview mt-2">
                                            <img id="back-preview-{{ $i }}" src="#" alt="Back side preview" class="img-thumbnail preview-image" style="display: none; max-height: 200px;">
                                            <div class="image-options mt-2" style="display: none;">
                                                <button type="button" class="btn btn-sm btn-outline-primary crop-btn" data-guest="{{ $i }}" data-side="back">
                                                    <i class="fas fa-crop"></i> Crop
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary compress-btn" data-guest="{{ $i }}" data-side="back">
                                                    <i class="fas fa-compress-alt"></i> Compress
                                                </button>
                                            </div>
                                            <div class="cropper-container mt-2" style="display: none;">
                                                <button type="button" class="btn btn-sm btn-info apply-crop-btn" data-guest="{{ $i }}" data-side="back">Apply Crop</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor

                        <button type="submit" class="btn btn-primary">Upload Documents</button>
                        <a href="{{ route('allroom') }}" class="btn btn-secondary btn-md">
                            <i class="fas fa-times me-2"></i> Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<style>
    .cropper-container {
        margin-bottom: 15px;
    }
    .camera-preview {
        margin-bottom: 15px;
    }
    .image-options {
        display: flex;
        gap: 5px;
    }
    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize croppers and streams objects
        const croppers = {};
        const streams = {};
        
        // Switch between upload options
        document.querySelectorAll('.upload-file-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const guestIndex = this.dataset.guest;
                const side = this.dataset.side;
                
                // Update active state
                document.querySelectorAll(`.upload-file-btn[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(b => {
                    b.classList.add('active');
                });
                document.querySelectorAll(`.use-camera-btn[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(b => {
                    b.classList.remove('active');
                });
                
                // Show file input
                document.querySelector(`.${side}-file-input[data-guest="${guestIndex}"]`).style.display = 'block';
                
                // Hide camera preview
                document.getElementById(`${side}-camera-preview-${guestIndex}`).style.display = 'none';
                
                // Stop camera if running
                stopCamera(guestIndex, side);
            });
        });
        
        document.querySelectorAll('.use-camera-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const guestIndex = this.dataset.guest;
                const side = this.dataset.side;
                
                // Update active state
                document.querySelectorAll(`.use-camera-btn[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(b => {
                    b.classList.add('active');
                });
                document.querySelectorAll(`.upload-file-btn[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(b => {
                    b.classList.remove('active');
                });
                
                // Hide file input
                document.querySelector(`.${side}-file-input[data-guest="${guestIndex}"]`).style.display = 'none';
                
                // Show camera preview
                document.getElementById(`${side}-camera-preview-${guestIndex}`).style.display = 'block';
                
                // Start camera
                startCamera(guestIndex, side);
            });
        });
        
        // Camera functions
        function startCamera(guestIndex, side) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {
                    const streamKey = `${guestIndex}-${side}`;
                    streams[streamKey] = stream;
                    
                    const video = document.querySelector(`#${side}-camera-preview-${guestIndex} .camera-video`);
                    video.srcObject = stream;
                    
                    // Hide image options if shown
                    document.querySelectorAll(`.image-options[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(el => {
                        el.style.display = 'none';
                    });
                })
                .catch(function(err) {
                    console.error("Camera error: ", err);
                    alert("Could not access the camera. Please check permissions.");
                });
        }
        
        function stopCamera(guestIndex, side) {
            const streamKey = `${guestIndex}-${side}`;
            if (streams[streamKey]) {
                streams[streamKey].getTracks().forEach(function(track) {
                    track.stop();
                });
                
                const video = document.querySelector(`#${side}-camera-preview-${guestIndex} .camera-video`);
                if (video) video.srcObject = null;
                
                delete streams[streamKey];
            }
        }
        
        // Capture photo from camera
        document.querySelectorAll('.capture-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const guestIndex = this.dataset.guest;
                const side = this.dataset.side;
                
                const video = document.querySelector(`#${side}-camera-preview-${guestIndex} .camera-video`);
                const canvas = document.querySelector(`#${side}-camera-preview-${guestIndex} .camera-canvas`);
                
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                
                const imageData = canvas.toDataURL('image/jpeg');
                const previewImage = document.querySelector(`#${side}-preview-${guestIndex}`);
                
                previewImage.src = imageData;
                previewImage.style.display = 'block';
                
                // Show image options
                document.querySelectorAll(`.image-options[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(el => {
                    el.style.display = 'flex';
                });
                
                // Create a blob from the canvas and set it as the file input
                canvas.toBlob(function(blob) {
                    const file = new File([blob], `${side}-capture-${guestIndex}.jpg`, { type: 'image/jpeg' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    
                    const fileInput = document.querySelector(`.${side}-file-input[data-guest="${guestIndex}"]`);
                    fileInput.files = dataTransfer.files;
                    
                    // Trigger change event to handle preview
                    const event = new Event('change');
                    fileInput.dispatchEvent(event);
                }, 'image/jpeg');
                
                // Stop camera after capture
                stopCamera(guestIndex, side);
                document.getElementById(`${side}-camera-preview-${guestIndex}`).style.display = 'none';
                
                // Switch back to upload button
                document.querySelector(`.upload-file-btn[data-guest="${guestIndex}"][data-side="${side}"]`).click();
            });
        });
        
        // Stop camera button
        document.querySelectorAll('.stop-camera-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const guestIndex = this.dataset.guest;
                const side = this.dataset.side;
                
                stopCamera(guestIndex, side);
                document.getElementById(`${side}-camera-preview-${guestIndex}`).style.display = 'none';
                
                // Switch back to upload button
                document.querySelector(`.upload-file-btn[data-guest="${guestIndex}"][data-side="${side}"]`).click();
            });
        });
        
        // File input change handler
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;
                
                const guestIndex = this.dataset.guest;
                const isFront = this.classList.contains('front-file-input');
                const side = isFront ? 'front' : 'back';
                const previewId = `${side}-preview-${guestIndex}`;
                const previewElement = document.getElementById(previewId);
                
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        previewElement.src = e.target.result;
                        previewElement.style.display = 'block';
                        
                        // Show image options
                        document.querySelectorAll(`.image-options[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(el => {
                            el.style.display = 'flex';
                        });
                    }
                    
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    // Show PDF icon for PDF files
                    previewElement.src = "{{ asset('images/pdf-icon.png') }}";
                    previewElement.style.display = 'block';
                    
                    // Hide image options for PDF
                    document.querySelectorAll(`.image-options[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(el => {
                        el.style.display = 'none';
                    });
                }
            });
        });
        
        // Crop button handler
        document.querySelectorAll('.crop-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const guestIndex = this.dataset.guest;
                const side = this.dataset.side;
                const previewId = `${side}-preview-${guestIndex}`;
                const image = document.getElementById(previewId);
                
                if (!image.src || image.src === '#') return;
                
                // Destroy previous cropper if exists
                const cropperKey = `${guestIndex}-${side}`;
                if (croppers[cropperKey]) {
                    croppers[cropperKey].destroy();
                }
                
                // Initialize cropper
                croppers[cropperKey] = new Cropper(image, {
                    aspectRatio: NaN, // Free ratio
                    viewMode: 1,
                    autoCropArea: 0.8,
                    responsive: true,
                    guides: true
                });
                
                // Show cropper controls
                document.querySelectorAll(`.cropper-container[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(el => {
                    el.style.display = 'block';
                });
            });
        });
        
        // Apply crop handler
        document.querySelectorAll('.apply-crop-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const guestIndex = this.dataset.guest;
                const side = this.dataset.side;
                const cropperKey = `${guestIndex}-${side}`;
                
                if (croppers[cropperKey]) {
                    const canvas = croppers[cropperKey].getCroppedCanvas();
                    const previewId = `${side}-preview-${guestIndex}`;
                    document.getElementById(previewId).src = canvas.toDataURL('image/jpeg');
                    
                    // Store crop data
                    const cropData = croppers[cropperKey].getData();
                    document.querySelector(`.crop-data[data-guest="${guestIndex}"][data-side="${side}"]`).value = JSON.stringify(cropData);
                    
                    // Update file input with cropped image
                    canvas.toBlob(function(blob) {
                        const file = new File([blob], `${side}-cropped-${guestIndex}.jpg`, { type: 'image/jpeg' });
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        
                        const fileInput = document.querySelector(`.${side}-file-input[data-guest="${guestIndex}"]`);
                        fileInput.files = dataTransfer.files;
                    }, 'image/jpeg');
                    
                    // Destroy cropper
                    croppers[cropperKey].destroy();
                    delete croppers[cropperKey];
                    
                    // Hide cropper controls
                    document.querySelectorAll(`.cropper-container[data-guest="${guestIndex}"][data-side="${side}"]`).forEach(el => {
                        el.style.display = 'none';
                    });
                }
            });
        });
        
        // Compress button handler
        document.querySelectorAll('.compress-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const guestIndex = this.dataset.guest;
                const side = this.dataset.side;
                const previewId = `${side}-preview-${guestIndex}`;
                const image = document.getElementById(previewId);
                
                if (!image.src || image.src === '#') return;
                
                // Set compress flag
                document.querySelector(`.compress-input[data-guest="${guestIndex}"][data-side="${side}"]`).value = '1';
                
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                
                // Set canvas dimensions (reduce by 50%)
                canvas.width = image.naturalWidth * 0.5;
                canvas.height = image.naturalHeight * 0.5;
                
                // Draw compressed image
                ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
                
                // Update preview
                image.src = canvas.toDataURL('image/jpeg', 0.7);
                
                // Update file input with compressed image
                canvas.toBlob(function(blob) {
                    const file = new File([blob], `${side}-compressed-${guestIndex}.jpg`, { type: 'image/jpeg' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    
                    const fileInput = document.querySelector(`.${side}-file-input[data-guest="${guestIndex}"]`);
                    fileInput.files = dataTransfer.files;
                }, 'image/jpeg', 0.7);
            });
        });
        
        // Clean up cameras when leaving page
        window.addEventListener('beforeunload', function() {
            for (const streamKey in streams) {
                if (streams[streamKey]) {
                    streams[streamKey].getTracks().forEach(track => track.stop());
                }
            }
        });
    });
</script>
@endpush

@endsection