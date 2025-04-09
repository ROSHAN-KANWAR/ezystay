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
                                        <input type="file" name="front_files[]" class="form-control-file file-input" required>
                                        <div class="image-preview mt-2">
                                            <img id="front-preview-{{ $i }}" src="#" alt="Front side preview" class="img-thumbnail" style="display: none; max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Back Side (Optional)</label>
                                        <input type="file" name="back_files[]" class="form-control-file file-input">
                                        <div class="image-preview mt-2">
                                            <img id="back-preview-{{ $i }}" src="#" alt="Back side preview" class="img-thumbnail" style="display: none; max-height: 200px;">
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview functionality
        const fileInputs = document.querySelectorAll('.file-input');
        
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;
                
                const previewId = e.target.name.includes('front') 
                    ? `front-preview-${getIndex(e.target)}` 
                    : `back-preview-${getIndex(e.target)}`;
                    
                const previewElement = document.getElementById(previewId);
                
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        previewElement.src = e.target.result;
                        previewElement.style.display = 'block';
                    }
                    
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    // Show PDF icon for PDF files
                    previewElement.src = "{{ asset('images/pdf-icon.png') }}";
                    previewElement.style.display = 'block';
                }
            });
        });
        
        function getIndex(element) {
            // Get the index from the closest guest-document div
            const guestDiv = element.closest('.guest-document');
            const allGuests = document.querySelectorAll('.guest-document');
            return Array.from(allGuests).indexOf(guestDiv);
        }
    });
</script>
@endpush

@endsection