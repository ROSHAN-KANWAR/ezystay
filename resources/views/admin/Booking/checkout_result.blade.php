@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')


<main>
    <div class="container-fluid">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="container">
    <h3 class="mt-2">Review Booking Details</h3>
    <div class="card">
        <div class="card-header">Booking Information</div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Booking ID:</th>
                    <td>{{ $booking->booking_id }}</td>
                </tr>
                <tr>
                    <th>Guest Name:</th>
                    <td>{{ $booking->name }}</td>
                </tr>
                <tr>
                    <th>Room Number:</th>
                    <td>{{ $booking->room->room_no }}</td>
                </tr>
                <tr>
                    <th>Room Type:</th>
                    <td>{{ $booking->room->type }}</td>
                </tr>
                <tr>
                    <th>Check-In Date:</th>
                    <td>{{ $booking->check_in_date }}</td>
                </tr>
                <tr>
                    <th>Check-Out Date:</th>
                    <td>{{ $booking->check_out_date}}</td>
                </tr>
                <tr>
                    <th>Total Amount:</th>
                    <td>(₹){{$booking->net_amount, 2 }}</td>
                </tr>
                @if(!$booking->document_verified)
                <tr class="text-danger">
                    <th>Document Status:</th>
                    <td>Not Verified - Please verify documents before checkout</td>
                </tr>
                @endif
            </table>

            <form method="POST" action="{{route('checkout_com', $booking->booking_id)}}">
                @csrf
                <button type="submit" class="btn btn-success" @if(!$booking->document_verified) disabled @endif>
                    Complete Checkout
                </button>
                <a href="{{route('newbooking')}}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<!-- Hidden form field -->

                    </div>
                </main>
        
   @endsection