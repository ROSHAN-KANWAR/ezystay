@extends('Layout.app')
@section('title')
Secure Login
@endsection
@section('main-section')
    <div id="welcome"></div>
   
    <div  class=" vh-100 container-fluid d-flex justify-content-center align-items-center">
    <div class="card shadow-lg w-100 " style="max-width: 480px;">
        <div class="card-body">
            <div class="text-center">
                <h1 class="card-title h3">Welcome in Ezystay !</h1>
                <i class="fab fa-laravel"></i>
                <p class="card-text text-muted">Exclusive Access - Login Here</p>
            </div>
            <span>
            @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
            </span>
            <div class="mt-4">
                <form action="{{route('login_data')}}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark btn-lg">Login </button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
   @endsection