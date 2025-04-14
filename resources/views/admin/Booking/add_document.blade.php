@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')


<main>
    <div class="container-fluid px-4">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="row">
    <h4  class="text-center mt-4">Add Yours Document Id`s</h4>
</div>
<!-- search form -->
<form method="post" action="" class="my-4">
    @csrf
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex flex-row align-items-center">
                        <div class="flex-grow-1 me-3">
                            <label for="searchInput" class="form-label fw-bold mb-1">
                                Search by Booking ID
                            </label>
                            <div class="input-group">
                                <input type="text" 
                                       name="booking_id" 
                                       id="searchInput" 
                                       class="form-control" 
                                       placeholder="Enter booking ID" 
                                       required>
                            </div>
                        </div>
                        
                        <div class="flex-shrink-0 align-self-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-search me-2"></i>Search
                            </button>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!--end search form -->


                    </div>
                </main>
        
   @endsection
        
   