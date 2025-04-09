@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')


<main>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Room</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('store') }}" method="POST">
                        @csrf

                        <!-- Room Number -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="room_no" class="form-label">Room Number*</label>
                                <input type="text" class="form-control @error('room_no') is-invalid @enderror" 
                                       id="room_no" name="room_no" value="{{ old('room_no') }}" required>
                                @error('room_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Floor - Dynamic from Model -->
                            <div class="col-md-6">
                                <label for="floor" class="form-label">Floor*</label>
                                <select class="form-select @error('floor') is-invalid @enderror" id="floor" name="floor" required>
                                    <option value="">Select Floor</option>
                                    @foreach($floorOptions as $floor)
                                        <option value="{{ $floor }}" {{ old('floor') == $floor ? 'selected' : '' }}>
                                            Floor {{ $floor }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('floor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Room Type - Dynamic from Model -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="type" class="form-label">Room Type*</label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    @foreach($typeOptions as $value => $label)
                                        <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status - Dynamic from Model -->
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status*</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    @foreach($statusOptions as $value => $label)
                                        <option value="{{ $value }}" {{ old('status', 'available') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Price and Capacity -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price per Night (₹)*</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="capacity" class="form-label">Capacity*</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                                       id="capacity" name="capacity" value="{{ old('capacity') }}" min="1">
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2">
                                <i class="bi bi-save"></i> Save Room
                            </button>
                            <a href="{{ route('allroom') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    .card-header {
        padding: 1rem 1.5rem;
    }
    .form-label {
        font-weight: 500;
    }
</style>
@endpush
</main>
        
   @endsection
        
   