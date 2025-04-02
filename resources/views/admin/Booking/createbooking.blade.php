@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')


<main>
                    <div class="container-fluid px-4">
                        <h3 class="mt-4">New Booking Details</h3>

<!-- booking interface codee -->
<!-- View -->

<div class="available-rooms mb-4">
    <h5>Available Rooms:</h5>
    <div class="room-list">
    <div class="available-rooms">
    @foreach($availableRooms as $type => $rooms)
        <div class="room-type-group mb-4">
            <h5>{{ $type }} Rooms</h5>
            <div class="room-list">
                @foreach($rooms as $room)
                    <div class="room-pill" 
                         onclick="selectRoom({{ $room->id }},{{ $room->price }},'{{ $room->type }}','{{ $room->room_no }}')"
                         data-room-id="{{ $room->id }}">
                        {{ $room->room_no }}
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

    </div>
</div>

<!-- Hidden form field -->
<input type="" name="room_id" id="selected_room_id">
<input type="" name="room_price" id="selected_room_price">
<input type="" name="room_type" id="selected_room_type">

@push('scripts')
<script>
function selectRoom(roomId,roomPrice,roomType, roomNo) {
    // Update hidden field
    document.getElementById('selected_room_id').value = roomNo;
    document.getElementById('selected_room_price').value = roomPrice;
    document.getElementById('selected_room_type').value = roomType;
    // Visual feedback
    document.querySelectorAll('.room-pill').forEach(el => {
        el.classList.remove('selected');
    });
    event.target.classList.add('selected');
    
    // Optional: Show room details
    document.getElementById('room-details').innerHTML = `Selected: Room ${roomNo}`;
}
</script>
@endpush
@push('scripts')
<script>
const vk = "roshan"
    </script>
@endpush
                    </div>
                </main>
        
   @endsection
        
   