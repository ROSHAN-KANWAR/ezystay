@extends('admin.layout.app')
@section('title')
Update Room
@endsection
@section('dashboard')

<main>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-danger">
        {{ session('success') }}
    </div>
@endif
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Update Room</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('update_done_room',$room->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Room Number -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="room_no" class="form-label">Room Number*</label>
                                <input type="text" class="form-control @error('room_no') is-invalid @enderror" 
                                       id="room_no" name="room_no" value="{{ old('room_no', $room->room_no) }}" required>
                                @error('room_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Floor - Dynamic from Model -->
                            <div class="col-md-6">
                                <label for="floor" class="form-label">Floor*</label>
                                <select class="form-select @error('floor') is-invalid @enderror" id="floor" name="floor" required>
                                    <option value="">Select Floor</option>
                                
                                        <option value="floor 1" @if($room->floor == 'floor 1') selected @endif> Floor 1 </option>
                                        <option value="floor 2" @if($room->floor == 'floor 2') selected @endif> Floor 2 </option>
                                        <option value="floor 3" @if($room->floor == 'floor 3') selected @endif> Floor 3 </option>
                                        
                                </select>
                                @error('floor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                
                            <!-- Status -->
                         
                        <!-- Price and Capacity -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price per Night (₹)*</label>
                                <div class="input-group">
                                    <span class="input-group-text">₹ </span>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price', $room->price) }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="capacity" class="form-label">Capacity*</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                                       id="capacity" name="capacity" value="{{ old('capacity', $room->capacity) }}" min="1" >
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
         <!-- Floor - Dynamic from Model -->
                    <div class="row">
                    <div class="col-md-6">
                                                    <label for="status" class="form-label">Status*</label>
                                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                        <option value="">Select Floor</option>
                                                    
                                                            <option value="available" @if($room->status == 'available') selected @endif> Available</option>
                                                            <option value="occupied" @if($room->status == 'occupied') selected @endif>Occupied</option>
                                                            <option value="maintenance" @if($room->status == 'maintenance') selected @endif>Maintenance</option>
                                                         
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="type" class="form-label">Type*</label>
                                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                                        <option value="">Select Floor</option>
                                                    
                                                            <option value="single" @if($room->type == 'single') selected @endif>single</option>
                                                            <option value="double" @if($room->type == 'double') selected @endif>double</option>
                                                            <option value="suite" @if($room->type == 'suite') selected @endif>suite</option>
                                                            <option value="deluxe" @if($room->type == 'deluxe') selected @endif>deluxe</option>
                                                           
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>          
                    </div>
                
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $room->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <!-- Form Actions -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2">
                                <i class="bi bi-save"></i> Update Room
                            </button>
                            <a href="" class="btn btn-secondary">
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
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
@endpush
</main>
        
@endsection