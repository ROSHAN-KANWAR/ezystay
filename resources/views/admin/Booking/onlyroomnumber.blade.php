@extends('admin.layout.app')
@section('title') Create Booking @endsection
@section('dashboard')
<main>
    <div class="container-fluid px-2 mt-2">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('booking_stores') }}" method="POST">
            @csrf
            
            <!-- 1. Room Selection Section -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Room Selection</h4>
                </div>
                <div class="d-flex mt-2 px-1">
                            <span class="badge bg-success me-2">Available</span>
                            <span class="badge bg-danger me-2">Occupied</span>
                            
                            <span class="badge bg-warning me-2">Maintenance</span>
                        </div>
                <div class="card-body">
                    <div class="row">

                        @foreach($availableRooms as $type => $rooms)
                        <div class="col-md-4 mb-3">
                            <h5>{{ ucfirst($type) }}</h5>
                            <div class="d-flex flex-wrap">
                                @foreach($rooms as $room)
                                @if($room->status === 'available')
        <!-- Available Room (Clickable) -->
        <a href="{{route('getroomid' ,$room->id)}}">   <button 
                            type="button" 
                            class="btn btn-sm m-1 room-pill btn-success"
                            style="width: 60px; height: 40px; padding: 0;"
                        >
                         {{ $room->room_no }}
                       
                        </button> </a>
                        @endif
                        @if($room->status === 'occupied')
    <!-- Occupied Room (Checkout Button) -->
    <a href="{{route('checkout_roomid' ,$room->id)}}">  
        <button type="button"  class="btn btn-sm m-1 room-pill btn-danger" style="width: 60px; height: 40px; padding: 0;" >
            {{ $room->room_no }}
        </button>
        </a>
@endif

 @if($room->status === 'maintenance')
 <button 
    type="button" 
    class="btn btn-sm m-1 room-pill btn-warning"
    style="width: 60px; height: 40px; padding: 0; cursor: not-allowed;"
>
    {{ $room->room_no }}
</button>
                        @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
</main>

@endsection
@push('scripts')
<script>
function confirmSubmit(){
    if(confirm('Are you sure you want to checkout this room')){
   document.getElementById('mycheckoutform').submit();
    }
}
</script>
@endpush